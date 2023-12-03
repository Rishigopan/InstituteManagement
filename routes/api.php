<?php

use App\Http\Controllers\Api\AdmissionController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\CourseCategoryController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\QualificationController;
use App\Http\Controllers\Api\BatchTypeController;
use App\Http\Controllers\Api\DivisionController;
use App\Http\Controllers\Api\CasteCategoryController;
use App\Http\Controllers\Api\RelationController;
use App\Http\Controllers\Api\ReligionController;
use App\Http\Controllers\Api\CasteController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\ParentInfoController;
use App\Http\Controllers\Api\CourseTypeController;
use App\Http\Controllers\Api\EnquiryTypeController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\CourseProviderController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\EnquiryController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\StreamController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\BatchController;
use App\Http\Controllers\Api\TaskCategoryController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\FollowupController;
use App\Http\Controllers\Api\AcademicYearController;
use App\Http\Controllers\Api\FollowUpReportController;
use App\Http\Controllers\Api\TaskStatusController;
use App\Http\Controllers\Api\notinterestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\StartTaskController;
use App\Http\Controllers\Api\FeeTypeController;
use App\Http\Controllers\Api\FeeCategoryController;
use App\Http\Controllers\Api\FeeCollectionController;
use App\Http\Controllers\Api\AddTaskController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\StaffAssignController;
use App\Http\Controllers\Api\TaskTemplateController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public routes//
Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/department/{id}', [DepartmentController::class, 'show']);

Route::get('/course-categories', [CourseCategoryController::class, 'index']);
Route::get('/course-category/{id}', [CourseCategoryController::class, 'show']);

Route::get('/documents', [DocumentController::class, 'index']);
Route::get('/document/{id}', [DocumentController::class, 'show']);

Route::get('/qualifications', [QualificationController::class, 'index']);
Route::get('/qualification/{id}', [QualificationController::class, 'show']);

Route::get('/batch-types', [BatchTypeController::class, 'index']);
Route::get('/batch-type/{id}', [BatchTypeController::class, 'show']);

Route::get('/divisions', [DivisionController::class, 'index']);
Route::get('/division/{id}', [DivisionController::class, 'show']);

Route::get('/caste-categories', [CasteCategoryController::class, 'index']);
Route::get('/caste-category/{id}', [CasteCategoryController::class, 'show']);

Route::get('/religions', [ReligionController::class, 'index']);
Route::get('/religion/{id}', [ReligionController::class, 'show']);

Route::get('/relations', [RelationController::class, 'index']);
Route::get('/relation/{id}', [RelationController::class, 'show']);

Route::get('/castes', [CasteController::class, 'index']);
Route::get('/caste/{id}', [CasteController::class, 'show']);

Route::get('/branches', [BranchController::class, 'index']);
Route::get('/branch/{id}', [BranchController::class, 'show']);

Route::get('/organizations', [OrganizationController::class, 'index']);
Route::get('/organization/{id}', [OrganizationController::class, 'show']);

Route::get('/parentinfos', [ParentInfoController::class, 'index']);
Route::get('/parentinfo/{id}', [ParentInfoController::class, 'show']);


Route::get('/enquiry-type', [EnquiryTypeController::class, 'index']);
Route::get('/enquiry-type/{id}', [EnquiryTypeController::class, 'show']);


Route::get('/course-type', [CourseTypeController::class, 'index']);
Route::get('/course-type/{id}', [CourseTypeController::class, 'show']);


Route::get('/Staffs', [StaffController::class, 'index']);
Route::get('/Staffs/{id}', [StaffController::class, 'show']);

Route::get('/CourseProvider', [CourseProviderController::class, 'index']);
Route::get('/CourseProvider/{id}', [CourseProviderController::class, 'show']);

Route::get('/Enquiry', [EnquiryController::class, 'index']);
Route::get('/Enquiry/{id}', [EnquiryController::class, 'show']);

Route::get('/branchwiseStaff/{branchId}', [EnquiryController::class, 'getStaffName']);

Route::get('/Admission', [AdmissionController::class, 'index']);
Route::get('/Admission/{id}', [AdmissionController::class, 'show']);

Route::get('/Feedback', [FeedbackController::class, 'index']);
Route::get('/Feedback/{id}', [FeedbackController::class, 'show']);

Route::get('/Stream', [StreamController::class, 'index']);
Route::get('/Stream/{id}', [StreamController::class, 'show']);

Route::get('/CourseReq', [CourseController::class, 'index']);
Route::get('/CourseReq/{id}', [CourseController::class, 'show']);

Route::get('/Batch', [BatchController::class, 'index']);
Route::get('/Batch/{id}', [BatchController::class, 'show']);

Route::get('/taskcategorys', [TaskCategoryController::class, 'index']);
Route::get('/taskcategory/{id}', [TaskCategoryController::class, 'show']);

Route::get('/groups', [GroupController::class, 'index']);
Route::get('/group/{id}', [GroupController::class, 'show']);

Route::get('/academicYear', [AcademicYearController::class, 'index']);
Route::get('/academicYear/{id}', [AcademicYearController::class, 'show']);

Route::get('/Taskstatus', [TaskStatusController::class, 'index']);
Route::get('/Taskstatus/{id}', [TaskStatusController::class, 'show']);


//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/{id}', [DashboardController::class, 'show']);
Route::get('/dashboard_admission', [DashboardController::class, 'admission']);
Route::post('/dashboard_feedback', [DashboardController::class, 'feedback']);
// Route::post('/feedback_count/{id}', [DashboardController::class, 'updateFeedbackCount']);


Route::post('/followup', [FollowupController::class, 'index']);
Route::get('/followupreportdata', [FollowUpReportController::class, 'followupreport']);
Route::get('/notInterest', [notinterestController::class, 'index']);
Route::get('/branch-wiseStaff/{branchId}', [GroupController::class, 'getStaffName'])->name('get-staffs.getStaffs');
Route::get('/branch-wise-group/{branchId}', [GroupController::class, 'getTeamName'])->name('branch-wise-observers-participants.getTeamName');
Route::get('/getGroupMembers/{groupId}', [AddTaskController::class, 'getGroupMembers'])->name('getGroupMembers.getGroupMembers');
Route::get('/Addtask/showTaskChecklist/{taskId}', [AddTaskController::class, 'getChecklist']);
Route::get('/feedbacks/{feedbackId}', [FeedbackController::class, 'getFeedbackDetails']);
Route::get('/staffName/{staffId}', [StaffController::class, 'getStaffDetails']);
Route::post('/assign-task', [AddTaskController::class, 'submitForm']);
Route::get('/getpendingtasks/{staffId}', [AddTaskController::class, 'getPendingWorkDetails'])->name('tasks.get');
Route::post('/searchEnquiriesinOffcanvas', [FollowupController::class, 'searchEnquiriesinOffcanvas']);
Route::get('/getEnquiriesNameAndPhone', [FollowupController::class, 'getEnquiriesNameAndPhone']);
Route::get('/CourseTypeWiseCourse/{courseId}', [EnquiryController::class, 'getCourse'])->name('get-staffs.getStaffs');

Route::post('/staffassign/show-enquiries', [StaffAssignController::class, 'Search']);
Route::put('/staffassign/assign-staff', [StaffAssignController::class, 'Assign']);

//Task Report
Route::get('/Taskreportdata', [ReportController::class, 'gettaskreport']);
Route::get('/Checklist/{id}', [ReportController::class, 'getchecklist']);

//departments
Route::post('/department', [DepartmentController::class, 'store']);
Route::put('/department/{id}', [DepartmentController::class, 'update']);
Route::delete('/department/{id}', [DepartmentController::class, 'destroy']);

//Academic Year
Route::post('/academicYear', [AcademicYearController::class, 'store']);
Route::put('/academicYear/{id}', [AcademicYearController::class, 'update']);
Route::delete('/academicYear/{id}', [AcademicYearController::class, 'destroy']);


//Task Status
Route::post('/Taskstatus', [TaskStatusController::class, 'store']);
Route::put('/Taskstatus/{id}', [TaskStatusController::class, 'update']);
Route::delete('/Taskstatus/{id}', [TaskStatusController::class, 'destroy']);

//Course Category
Route::post('/course-category', [CourseCategoryController::class, 'store']);
Route::put('/course-category/{id}', [CourseCategoryController::class, 'update']);
Route::delete('/course-category/{id}', [CourseCategoryController::class, 'destroy']);

//Document
Route::post('/document', [DocumentController::class, 'store']);
Route::put('/document/{id}', [DocumentController::class, 'update']);
Route::delete('/document/{id}', [DocumentController::class, 'destroy']);

//Qualification
Route::post('/qualification', [QualificationController::class, 'store']);
Route::put('/qualification/{id}', [QualificationController::class, 'update']);
Route::delete('/qualification/{id}', [QualificationController::class, 'destroy']);

//Batch Type
Route::post('/batch-type', [BatchTypeController::class, 'store']);
Route::put('/batch-type/{id}', [BatchTypeController::class, 'update']);
Route::delete('/batch-type/{id}', [BatchTypeController::class, 'destroy']);

//Division
Route::post('/division', [DivisionController::class, 'store']);
Route::put('/division/{id}', [DivisionController::class, 'update']);
Route::delete('/division/{id}', [DivisionController::class, 'destroy']);

//Caste Categories
Route::post('/caste-category', [CasteCategoryController::class, 'store']);
Route::put('/caste-category/{id}', [CasteCategoryController::class, 'update']);
Route::delete('/caste-category/{id}', [CasteCategoryController::class, 'destroy']);

//Religion
Route::post('/religion', [religionController::class, 'store']);
Route::put('/religion/{id}', [religionController::class, 'update']);
Route::delete('/religion/{id}', [religionController::class, 'destroy']);

//Relation
Route::post('/relation', [RelationController::class, 'store']);
Route::put('/relation/{id}', [RelationController::class, 'update']);
Route::delete('/relation/{id}', [RelationController::class, 'destroy']);

//Caste
Route::post('/caste', [CasteController::class, 'store']);
Route::put('/caste/{id}', [CasteController::class, 'update']);
Route::delete('/caste/{id}', [CasteController::class, 'destroy']);

//Branch
Route::post('/branch', [BranchController::class, 'store']);
Route::put('/branch/{id}', [BranchController::class, 'update']);
Route::delete('/branch/{id}', [BranchController::class, 'destroy']);

//Organization
Route::post('/organization', [OrganizationController::class, 'store']);
Route::put('/organization/{id}', [OrganizationController::class, 'update']);
Route::delete('/organization/{id}', [OrganizationController::class, 'destroy']);

//Parent Info
Route::post('/parentinfo', [ParentInfoController::class, 'store']);
Route::put('/parentinfo/{id}', [ParentInfoController::class, 'update']);
Route::delete('/parentinfo/{id}', [ParentInfoController::class, 'destroy']);


//EnquiryType

Route::post('/enquirytype', [EnquiryTypeController::class, 'store']);
Route::put('/enquirytype/{id}', [EnquiryTypeController::class, 'update']);
Route::delete('/enquirytype/{id}', [EnquiryTypeController::class, 'destroy']);

//courseType
Route::post('/coursetype', [CourseTypeController::class, 'store']);
Route::put('/coursetype/{id}', [CourseTypeController::class, 'update']);
Route::delete('/coursetype/{id}', [CourseTypeController::class, 'destroy']);

//Staff
Route::post('/staff', [StaffController::class, 'store']);
Route::put('/staff/{id}', [StaffController::class, 'update']);
Route::delete('/staff/{id}', [StaffController::class, 'destroy']);

//CourseProvider
Route::post('/courseProvider', [CourseProviderController::class, 'store']);
Route::put('/courseProvider/{id}', [CourseProviderController::class, 'update']);
Route::delete('/courseProvider/{id}', [CourseProviderController::class, 'destroy']);

//Enquiry
Route::post('/enquiry', [EnquiryController::class, 'store']);
Route::put('/enquiry/{id}', [EnquiryController::class, 'update']);
Route::delete('/enquiry/{id}', [EnquiryController::class, 'destroy']);

//Admission
Route::post('/admission', [AdmissionController::class, 'store']);
Route::put('/admission/{id}', [AdmissionController::class, 'update']);
Route::delete('/admission/{id}', [AdmissionController::class, 'destroy']);

//password Reset
Route::put('/ResetPassword/{id}', [ResetPasswordController::class, 'reset']);

//feedback
Route::post('/feedback', [FeedbackController::class, 'store']);
Route::put('/feedback/{id}', [FeedbackController::class, 'update']);
Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy']);


//Stream
Route::post('/stream', [StreamController::class, 'store']);
Route::put('/stream/{id}', [StreamController::class, 'update']);
Route::delete('/stream/{id}', [StreamController::class, 'destroy']);


//CourseRequirment
Route::post('/courseRequirement', [CourseController::class, 'store']);
Route::put('/courseRequirement/{id}', [CourseController::class, 'update']);
Route::delete('/courseRequirement/{id}', [CourseController::class, 'destroy']);

Route::post('/batches', [BatchController::class, 'store']);
Route::put('/batches/{id}', [BatchController::class, 'update']);
Route::delete('/batches/{id}', [BatchController::class, 'destroy']);

//Task Category
Route::post('/taskcategory', [TaskCategoryController::class, 'store']);
Route::put('/taskcategory/{id}', [TaskCategoryController::class, 'update']);
Route::delete('/taskcategory/{id}', [TaskCategoryController::class, 'destroy']);

//Group/Team
Route::post('/group', [GroupController::class, 'store']);
Route::put('/group/{id}', [GroupController::class, 'update']);
Route::delete('/group/{id}', [GroupController::class, 'destroy']);
//AssignTask
Route::post('/store-end-time', [StartTaskController::class, 'storeEndTime']);
Route::post('/store-start-time', [StartTaskController::class, 'storeStartTime']);
Route::post('/store-task-status', [StartTaskController::class, 'storeStatus']);
Route::get('/filter-tasks', [StartTaskController::class, 'filterTasks']);
//Fee Category
Route::post('/fee_category', [FeeCategoryController::class, 'store']);
Route::put('/fee_category/{id}', [FeeCategoryController::class, 'update']);
Route::delete('/fee_category/{id}', [FeeCategoryController::class, 'destroy']);
Route::post('/changestatus', [FeeCategoryController::class, 'changeStatus'])->name('changestatus');
Route::post('/changedefaultstatus', [FeeCategoryController::class, 'changeDefaultStatus'])->name('changedefaultstatus');

//Fee Collection
Route::get('/fee-collection', [FeeCollectionController::class, 'index'])->name('fee-collection.index');
Route::post('/fee-collection/store', [FeeCollectionController::class, 'store'])->name('fee-collection.store');
// Route::get('/fee_collection', 'FeeCollectionController@getStudentDetails');
Route::get('/student_details', [FeeCollectionController::class, 'student']);
Route::post('/student/details', [FeeCollectionController::class, 'showStudentDetails'])->name('studentDetails');


Route::post('/followup/search-enquiries', [FollowupController::class, 'searchEnquiries']);
Route::post('/feedbackstatus', [FollowupController::class, 'getDeletableStatus']);
Route::post('/submit-feedback', [FollowupController::class, 'submitFeedback']);
Route::get('/followup/history/{enquiry_id}', [FollowupController::class, 'getFollowUpDetails']);

Route::get('/taskstemps', [TaskTemplateController::class, 'index']);
Route::get('/taskstemp/{id}', [TaskTemplateController::class, 'show']);



//task template
Route::post('/tasks', [TaskTemplateController::class, 'store']);
Route::put('/taskstemp/{id}', [TaskTemplateController::class, 'update']);
Route::delete('/tasks/{id}', [TaskTemplateController::class, 'destroy']);


//followupEdit
Route::get('/followupedit/{id}', [FollowupController::class, 'show']);
Route::put('/followupupdate/{id}', [FollowupController::class, 'update']);
