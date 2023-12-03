<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\StaffResource;
use App\Models\Group;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StaffController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $staffs = Staff::all();



        return $this->sendResponse("staffs", StaffResource::collection($staffs), '1', 'Staffs retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();

            $validator = Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'mobile_no' => 'required',
                'department_id' => 'required',
                'branch_id' => 'required',
                'remarks' => 'nullable',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => 'required',
                'confirm_password' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $emailExists = Staff::where('email', $input['email'])->count();

            if ($emailExists) {
                return $this->sendResponse("staffs", null, '3', 'Email already exists.');
            }

            $input['password'] = Crypt::encryptString($input['password']);
            $input['confirm_password'] = Crypt::encryptString($input['confirm_password']);

            $userId = DB::table('users')->insertGetId([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
            ]);



            $id = DB::table('staff')->insertGetId($input);

            DB::commit();
            return $this->sendResponse("staffs", $id, '1', 'Staff created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError($e->getMessage(), $errorMessages = [], $code = 404);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $staffs = Staff::find($id);

        if (is_null($staffs)) {
            return $this->sendError('Staff not found.');
        }

        return $this->sendResponse("staffs", $staffs, '1', 'Staff retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $Staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();

            $validator = Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'mobile_no' => 'required',
                'department_id' => 'required',
                'branch_id' => 'required',
                'remarks' => 'required',
                'email' => ['required', 'string', 'email', 'max:255']

            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $CheckExists = Staff::select('name')->where(['name' => $input['name']])->where('id', '<>', $id)->get();
            if (count($CheckExists) > 0) {
                return $this->sendResponse("name", 'Exists', '0', 'Staff Already Exists');
            } else {
                $email = DB::table('staff')
                    ->where('id', '=', $id)
                    ->pluck('email');



                $affected = DB::table('staff')->where('id', $id)->update([
                    'name' => $input['name'],
                    'email' => $input['email'],

                    'mobile_no' => $input['mobile_no'],
                    'remarks' => $input['remarks'],
                    'department_id' => $input['department_id'],
                    'branch_id' => $input['branch_id'],
                ]);

                DB::commit();
                return $this->sendResponse("updated_rows_count", $affected, '1', 'Staff updated successfully.');
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $Staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $email = DB::table('staff')
                ->where('id', $id)
                ->pluck('email')
                ->first();

            if (is_null($email)) {
                return $this->sendError('Staff not found.');
            }



            $CheckstaffExists = Group::whereRaw("FIND_IN_SET($id, members)")
                ->get();
            if (count($CheckstaffExists) > 0) {
                return $this->sendResponse("staffs", 'Exists', '0', 'Can`t delete this record because it is in use');
            } else {
                DB::table('users')->where('email', $email)->delete();

                $deleted = DB::table('staff')->where('id', $id)->delete();
            }



            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return $this->sendResponse("deleted_rows_count", $deleted, '1', 'Staff deleted successfully.');
    }
}
