<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Imports\EnquiryImport;
use App\Models\Branch;
use App\Models\Duplicate;
use App\Models\EnquiryType;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToArray;
use App\Imports\EnquiryHeadingImport;
use App\Models\Course;

class ImportExportController extends Controller
{
    protected $duplicates = 0;
    protected $data = [];

    public function index()
    {
        $ListBranch['branch'] = Branch::select('id', 'branch_name')->get();
        $ListEnquiryType['EnquiryType'] = EnquiryType::select('id', 'name')->get();

        return view('ImportData', $ListBranch, $ListEnquiryType);
    }

    public function import(Request $request)
    {
        $branch_id = $request->branch;
        $enquirytype_id = $request->enquirytype;
        $leaddata = $request->leaddata;
        
        if ($request->hasFile('file')) {
            $path1 = $request->file('file')->store('temp');
            $path = storage_path('app') . '/' . $path1;
            $importedData = Excel::toArray(new EnquiryImport($branch_id, $enquirytype_id, $leaddata), $path)[0];

            $count = count($importedData);
            // Create a validator to validate each row of the imported data
        $validator = Validator::make($importedData, [
            '*.mob_no' => 'required|numeric|digits:10',
        ]);
        
       
            // Check for duplicate data in the imported data
            $uniqueData = collect($importedData)->unique(function ($row) use ($leaddata) {
                if ($leaddata === 'LD') {
                    return $row['mob_no'];
                } else {

                    return $row['name'] . '-' . $row['mob_no'];
                }
            })->values()->all();

            // Get all the Enquiry records in the database for the current branch
            $existingData = Enquiry::all();

            // Create an array to store the duplicate data
            $duplicateData = [];

            foreach ($uniqueData as $row) {
                if ($leaddata === 'LD') {
                    // Check if the mobile number already exists in the database
                    $existingRow = $existingData->firstWhere('mob_no', $row['mob_no']);
                } else {
                    // Check if the name and mobile number already exist in the database
                    $existingRow = $existingData->firstWhere('name', $row['name']);
                    if ($existingRow && $existingRow->mob_no === $row['mob_no']) {
                        $duplicateData[] = $row;
                    }
                }
                // This row is unique, insert it into the database
                $insertedData[] = $row;
                if ($existingRow) {
                    $duplicateData[] = $row;
                } else {
                 
                    $CheckCourseExists = Course::select('id')->where('course_name', '=', $row['course'])->get()->toArray();
                    //dd($CheckCourseExists);
                    if (count($CheckCourseExists) > 0) {
                        $PrefferedCourse = '';
                        $CourseId = $CheckCourseExists[0]['id'];
                    } else {
                        $PrefferedCourse = $row['course'];
                        $CourseId = null; 
                    }
                    


                    if (!$CourseId) {
                        // Course does not exist, insert it into the course table
                        $course = Course::create([
                            'course_name' => $row['course'],
                        ]);

                        $CourseId = $course->id;
                    }

                    //     // This row is unique, insert it into the database
                    Enquiry::insert([
                        'name' => $row['name'] ?? '',
                        'mob_no' => $row['mob_no'],
                        'course_id' => $CourseId,
                        'Course' => $PrefferedCourse,
                        'branch_id' => $branch_id,
                        'enq_source' => $enquirytype_id,
                        'leaddata' => $leaddata,
                    ]);
                }
            }

            return view('Excelview', compact('uniqueData', 'count', 'branch_id', 'enquirytype_id', 'duplicateData', 'leaddata'));
        } else {
            return back();
        }
    }

    public function saveData(Request $request)
    {
        $branch_id = $request->branch_id;
        $enquirytype_id = $request->enquirytype_id;
        $leaddata = $request->leaddata;
        $courseData = Course::pluck('id', 'course_name');
        $data = $request->data;
        $results = json_decode($data, true);
        $insertedData = [];
        $duplicateData = [];

        // Get all the Enquiry records in the database for the current branch
        $existingData = Enquiry::all();
        //get the mobile number 
        $existingMobile = Enquiry::where('mob_no')->get();

        foreach ($results as $row) {
            if ($leaddata === 'LD') {
                // Validate phone number format
                $validator = Validator::make($row, [
                    1 => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                ]);

                if ($validator->fails()) {
                    continue;
                }
            }

            if ($leaddata === 'LD') {
                // Check if the mobile number already exists in the database
                $existingRow = $existingData->firstWhere('mob_no', $row['mob_no']);
            } else {
                // Check if the name and mobile number already exist in the database
                $existingRow = $existingData->where('name', $row['name'])
                    ->where('mob_no', $row['mob_no'])
                    ->first();
            }


            // This row is unique, insert it into the database
            $insertedData[] = $row;
            if ($existingRow) {
                $duplicateData[] = $row;
            }


                // Check if the course exists in the course table
                //$courseId = $courseData[$row['course']] ?? null;

                

        }


        $TotalRecords = Enquiry::count();
        $Count = count($duplicateData);
        $insertData = count($insertedData);

        return view('ViewDuplicate', compact('insertData', 'Count', 'branch_id', 'enquirytype_id', 'duplicateData', 'TotalRecords', 'leaddata'));
    }
}
