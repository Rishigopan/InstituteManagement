<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ParentInfoResource;
use App\Models\ParentInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ParentInfoController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
     {
 
         $parentinfos = ParentInfo::all();
 
        
 
         return $this->sendResponse("parentinfos", ParentInfoResource::collection($parentinfos),'1', 'Parent Information retrieved successfully.');
 
         // return $this->sendResponse("parentinfos", ParentInfoResource::collection($parentinfos), 'parentinfos retrieved successfully.');
         // } else {
         //     return $this->sendError('Access Denied.', ["You dont have privilege to access this page . Sorry Contact Administrator"]);
         // }
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

                'father_name' => ['required', 'string', 'max:255'],
                'mother_name' => ['nullable','max:255'],
                'primary_mobile_no' => ['required', 'max:15'],
                'secondary_mobile_no' => ['nullable','max:15'],
                'primary_email' => ['required', 'max:120',],
                'secondary_email' => ['nullable','max:120'],
                'permanent_address' => [ 'nullable','max:500'],
                'permanent_mobile_no' => [ 'nullable','max:15'],
                'permanent_lan_line_no' => [ 'nullable','max:25'],
                'permanent_email' => [ 'nullable','max:120'],
                'permanent_post_office' => [ 'nullable','max:50'],
                'permanent_lan_mark' => [ 'nullable','max:120'],
                'communication_address' => ['nullable', 'max:500'],
                'communication_mobile_no' => ['nullable', 'max:15'],
                'communication_lan_line_no' => [ 'nullable','max:25'],
                'communication_email' => ['nullable','max:120'],
                'communication_post_office' => ['nullable', 'max:50'],
                'communication_lan_mark' => ['nullable','max:120'],
                'father_occupation' => [ 'nullable','max:70'],
                'mother_occupation' => [ 'nullable','max:70'],
                'country' => ['nullable','max:50'],
                'state' => ['nullable','max:50'],
                'location' => [ 'nullable','max:50'],   
                'user_name' => ['nullable', 'string', 'max:255'],
                'password' => 'nullable',
                'created_by' => ['max:10'],
             ]);
 
             if ($validator->fails()) {
                 return $this->sendError('Validation Error.', $validator->errors());
             }
             $CheckExists = ParentInfo::select('father_name')->where(['father_name' => $input['father_name']])->get();
             if (count($CheckExists) > 0) {
                 return $this->sendResponse("parentinfos", 'Exists' , '0', 'Parent Information Already Exists');
             } else {

                //  $input['password'] = Crypt::encryptString($input['password']);
                //  $input['password'] = Crypt::encryptString($input['password']);
     
                 DB::table('users')->insertGetId([
                     'name' => $input['user_name'],
                     'email' => $input['primary_email'],
                     'password' => Crypt::encryptString($input['password']),
                 ]);
                 

                $id = DB::table('parent_infos')->insertGetId($input);
     
                 DB::commit();
                return $this->sendResponse("parentinfos", $id, '1', 'Parent Information created successfully.');
             }   
         } catch (\Exception $e) {
             DB::rollback();
         }
     }
 
     /**
      * Display the specified resource.
      *
      * @param  \App\Models\ParentInfo  $parentinfos
      * @return \Illuminate\Http\Response
      */
     public function show(int $id)
     {
         $parentinfos = ParentInfo::find($id);
 
         if (is_null($parentinfos)) {
             return $this->sendError('Parent Information not found.');
         }
 
         return $this->sendResponse("parentinfos", $parentinfos, '1', 'Parent Information retrieved successfully.');
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Models\ParentInfo  $parentinfos
      * @return \Illuminate\Http\Response
      */
     public function edit(ParentInfo $parentinfos)
     {
         //
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Models\ParentInfo  $parentinfos
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
        try {
            DB::beginTransaction();
            $input = $request->all();

            $validator = Validator::make($input, [
                'father_name' => ['required', 'string', 'max:255'],
                'mother_name' => ['nullable','max:255'],
                'primary_mobile_no' => ['required', 'max:15'],
                'secondary_mobile_no' => ['nullable','max:15'],
                'primary_email' => ['nullable', 'max:120',],
                'secondary_email' => ['nullable','max:120'],
                'permanent_address' => [ 'nullable','max:500'],
                'permanent_mobile_no' => [ 'nullable','nullable','max:15'],
                'permanent_lan_line_no' => [ 'nullable','max:25'],
                'permanent_email' => [ 'nullable','max:120'],
                'permanent_post_office' => [ 'nullable','max:50'],
                'permanent_lan_mark' => [ 'nullable','max:120'],
                'communication_address' => ['nullable', 'max:500'],
                'communication_mobile_no' => ['nullable', 'max:15'],
                'communication_lan_line_no' => [ 'nullable','max:25'],
                'communication_email' => ['nullable','max:120'],
                'communication_post_office' => ['nullable', 'max:50'],
                'communication_lan_mark' => ['nullable','max:120'],
                'father_occupation' => [ 'nullable','max:70'],
                'mother_occupation' => [ 'nullable','max:70'],
                'country' => ['nullable','max:50'],
                'state' => ['nullable','max:50'],
                'location' => [ 'nullable','max:50'],   
                'user_name' => ['required', 'string', 'max:255'],
                
            // 'password' => 'nullable',
            'updated_by' => ['max:10'],
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $CheckExists = ParentInfo::select('father_name')->where(['father_name' => $input['father_name']])->where('id','<>',$id)->get();
            if (count($CheckExists) > 0) {
                return $this->sendResponse("parentinfos", 'Exists' , '0', 'Parent Information Already Exists');
            } 
            else
            {
                $email = DB::table('parent_infos')
                ->where('id', '=', $id)
                ->pluck('primary_email');

                DB::table('users')->where('email', $email)->update([
                    'name' => $input['user_name'],
                    'email' => $input['primary_email'],
                    // 'password' => Crypt::encryptString($input['password']),
                ]);

                $affected = DB::table('parent_infos')->where('id', $id)->update([
                    'father_name' => $input['father_name'],
                    'mother_name' => $input['mother_name'],
                    'primary_mobile_no' => $input['primary_mobile_no'],
                    'secondary_mobile_no' => $input['secondary_mobile_no'],
                    'primary_email' => $input['primary_email'],
                    'secondary_email' => $input['secondary_email'],
                    'permanent_address' => $input['permanent_address'],
                    'permanent_mobile_no' => $input['permanent_mobile_no'],
                    'permanent_lan_line_no' => $input['permanent_lan_line_no'],
                    'permanent_email' => $input['permanent_email'],
                    'permanent_post_office' => $input['permanent_post_office'],
                    'permanent_lan_mark' => $input['permanent_lan_mark'],
                    'communication_address' => $input['communication_address'],
                    'communication_mobile_no' => $input['communication_mobile_no'],
                    'communication_lan_line_no' => $input['communication_lan_line_no'],
                    'communication_email' => $input['communication_email'],
                    'communication_post_office' => $input['communication_post_office'],
                    'communication_lan_mark' => $input['communication_lan_mark'],
                    'father_occupation' => $input['father_occupation'],
                    'mother_occupation' => $input['mother_occupation'],
                    'country' => $input['country'],
                    'state' => $input['state'],
                    'location' => $input['location'],
                    'user_name' => $input['user_name'],
                    // 'password' => ($input['password']),
                    'updated_by' => $input['updated_by'],
                ]);

                DB::commit();  
                return $this->sendResponse("updated_rows_count", $affected, '1', 'Parent Information updated successfully.');    
            }          
        } catch (\Exception $e) {
            DB::rollback();
        }
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\ParentInfo  $doctor
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         try {
             DB::beginTransaction();
 
             $email = DB::table('parent_infos')
                 ->where('id', '=', $id)
                 ->pluck('primary_email');
 
             if (is_null($email)) {
                 return $this->sendError('Parent Information not found.');
             }
 
             DB::table('users')->where('email', '=', $email)->delete();
 
             $deleted = DB::table('parent_infos')->where('id', '=', $id)->delete();
 
             DB::commit();
             return $this->sendResponse("deleted_rows_count", $deleted, '1', 'Parent Information deleted successfully.');

         } catch (\Exception $e) {
             DB::rollback();
         }
 
     }
}
