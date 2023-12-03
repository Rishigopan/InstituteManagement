<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\notinterestResource;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DirectAdmissionController extends BaseController
{
    public function index()  {
        $enquiries = Enquiry::whereIn('feedback', [1])->get()->sortDesc();
    return $this->sendResponse("enquiries", notinterestResource::collection($enquiries), '1', 'Enquiries retrieved successfully.');
        
    }
}