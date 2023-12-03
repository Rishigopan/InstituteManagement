<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackResource;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\followup;

class FeedbackController extends BaseController
{
      /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       


       $feedback = Feedback::all()->sortDesc();
       return $this->sendResponse("feedback", FeedbackResource::collection($feedback), '1', 'Feedback retrieved successfully.');

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
           
           'feedback' => ['max:250'],
           'created_by' => ['max:10'],
       ]);

       if ($validator->fails()) {
           return $this->sendError('Validation Error', $validator->errors());
       }
       
        else {
            $feedback = Feedback::create($input);
           return $this->sendResponse("Feedback", new FeedbackResource( $feedback), '1', 'Feedback created successfully');
       }
   }
/**
    * Display the specified resource.
    *
    * @param  App\Models\Feedback   $feedback
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
        $feedback = Feedback::find($id);

       if (is_null( $feedback)) {
           return $this->sendError('Feedback not found.');
       }

       return $this->sendResponse("Feedback", new FeedbackResource( $feedback), '1', 'Feedback retrieved successfully.');
   }

 /**
    * Show the form for editing the specified resource.
    *
    * @param  App\Models\Feedback   $feedbacks
    * @return \Illuminate\Http\Response
    */
   public function edit(Feedback  $feedbacks)
   {
       //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  App\Models\Feedback   $feedback
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
        $feedback = Feedback::find($id);

       $input = $request->all();

       $validator = Validator::make($input, [
           
           'feedback' => ['max:250'],
           'updated_by' => ['max:10'],
       ]);

       if ($validator->fails()) {
           return $this->sendError('Validation Error', $validator->errors());

       }
       else {
           
            $feedback->feedback = $input['feedback'];
            $feedback->updated_by = $input['updated_by'];
            $feedback->save();           
           return $this->sendResponse("Feedback", new FeedbackResource( $feedback), '1', 'Feedback Updated successfully');
       }
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  App\Models\Feedback   $feedback
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
        $feedback = Feedback::find($id);

       if (is_null( $feedback)) {
           return $this->sendError('Feedback not found.');
       }
       if ($feedback->is_deletable == 'NO') {
        return $this->sendResponse("feedback", new FeedbackResource( $feedback), '2',  'Feedback cannot be deleted');
    }
    $CheckfeedbackExists = followup::select('feedback_id') -> where( 'feedback_id', '=' , $id) -> get();
    $CheckfeedbackExistsinEnquiry = Enquiry::select('feedback') -> where( 'feedback', '=' , $id) -> get();
    if (count($CheckfeedbackExists)  > 0  || count($CheckfeedbackExistsinEnquiry ) > 0) {
        return $this->sendResponse("enquiries", 'Exists' , '0', 'Feedback  is  in Use');
    } else {
    $feedback->delete();

    }
       return $this->sendResponse("feedback", new FeedbackResource( $feedback), '1', 'Feedback Deleted successfully');
       
   }
}
