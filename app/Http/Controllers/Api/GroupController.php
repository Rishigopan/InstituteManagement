<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\GroupResources;
use App\Models\Group;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class GroupController extends BaseController
{
          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all()->sortDesc();
        return $this->sendResponse("groups", GroupResources::collection($groups), '1', 'Group/Team retrieved successfully.');

    }


 //branch Wise staff
 public function getStaffName($branchId)
{
    $staffs = Staff::where('branch_id', $branchId)
                    ->select('id', 'name')
                    ->get();
    return response()->json($staffs);
}
public function getTeamName($branchId)
{
    $staffs = Group::where('branch_id', $branchId)
                    ->select('id', 'name')
                    ->get();
    return response()->json($staffs);
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
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'branch_id' => ['required','max:100'],
            'members' => ['max:100'],
            'created_by' => ['max:10'],
        ]);


        //return $request->branch_id;

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $CheckExists = Group::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("groups", 'Exists' , '0', 'Group/Team Already Exists');
        } else {
            $groups = Group::create($input);
            return $this->sendResponse("groups", new GroupResources($groups), '1', 'Group/Team created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Group  $groups
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $groups = Group::find($id);

        if (is_null($groups)) {
            return $this->sendError('Group/Team not found.');
        }

        return $this->sendResponse("groups", new GroupResources($groups), '1', 'Group/Team retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Group  $groups
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $groups)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Group  $groups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $groups = Group::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'branch_id' => ['required','max:100'],
            'members' => ['max:100'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = Group::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("groups", 'Exists' , '0', 'Group/Team Already Exists');
        } else {
            $groups->name = $input['name'];
            $groups->members = $input['members'];
            $groups->branch_id = $input['branch_id'];
            $groups->updated_by = $input['updated_by'];
            $groups->save();
            return $this->sendResponse("groups", new GroupResources($groups), '1', 'Group/Team Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Religion  $groups
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
    
        if (is_null($group)) {
            return $this->sendError('Group not found.');
        }
    
            $group->delete();
            return $this->sendResponse("groups", new GroupResources($group), '1', 'Group/Team Deleted successfully');
        
    }
    
    
}
