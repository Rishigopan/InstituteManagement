<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseTypeController;
use App\Http\Controllers\EnquiryTypeController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseCatagoryController;
use App\Http\Controllers\BatchTypeController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\CasteCatagaryController;

use App\Http\Controllers\CasteController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CourseProController;
use App\Http\Controllers\BranchTableController;
use App\Http\Controllers\CourseProTableController;
use App\Http\Controllers\CourseProEditController;
use App\Http\Controllers\ParentInfoController;
use App\Http\Controllers\BranchEditController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrgTableController;
use App\Http\Controllers\OrganizationEditController;
use App\Http\Controllers\ParentInfotableController;

use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\CourseMainController;

use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\StaffAssignController;
use App\Http\Controllers\ViewTaskController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\NotinterestController;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Task;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\FeeTypeController;
use App\Http\Controllers\FeeCategoryController;
use App\Http\Controllers\AddTaskController;
use App\Http\Controllers\TaskTemplateController;
use App\Http\Controllers\AdmissionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DirectAdmissionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        Auth::logout();
    }
    return redirect()->route('login');
});
// Route::get('/dashboard', function () {
//     return view('index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');





Route::get('/dashboard',[DashboardController::class,'index'] )->middleware(['auth', 'verified'])->name('dashboard.dashboard');





Route::get('/staff', function () {
    return view('StaffMaster');
});


Route::get('/assigntask', function () {
    return view('AssignTask');
});
// Route::get('/viewtask', function () {
//     return view('ViewTask');
// });

Route::get('/viewtaskboard', function () {
    return view('ViewTaskBoard');
});



Route::get('/ResetPassword/{id}', function () {
    return view('ResetPassword');
});
Route::get('/taskreport', [ReportController::class, 'taskreports']);
Route::get('/admission', [AdmissionController::class, 'Admission'])->name('admission.Admission');
Route::get('/admission/{id}',[Admissioncontroller::class,'getstudent']);
Route::get('/getstaff/{branch}',[StaffAssignController::class,'getstaffs'] );
Route::post('/excelview', [ImportExportController::class, 'import'] )->name('excelview.import');
Route::get('/DuplicateData', [DuplicateController::class, 'Duplicate'] )->name('DuplicateData.Duplicate');
Route::post('/SAVEDATA', [ImportExportController::class, 'saveData'])->name('SAVEDATA.save');
Route::get('/ImportDatas', [ImportExportController::class, 'index'] )->name('ImportDatas.index');
Route::post('/ImportData', [ImportExportController::class, 'import'])->name('ImportData.import');
Route::get('/batch', [BatchController::class, 'Batch'] )->name('batch.Batch');
Route::get('/BatchTable', [BatchController::class, 'BatchTable'] )->name('BatchTable.BatchTable');
Route::get('/BatchEdit/{id}', [BatchController::class, 'BatchEdit'] )->name('BatchEdit.BatchEdit');
Route::get('/coursetype', [CourseTypeController::class, 'courseType'] )->name('course.courseType');
Route::get('/enquirytype', [EnquiryTypeController::class, 'Enquirytype'] )->name('enquirytype.Enquirytype');
Route::get('/relation', [RelationController::class, 'Relation'] )->name('relation.Relation');
Route::get('/religion', [ReligionController::class, 'Religion'] )->name('religion.Religion');
Route::get('/document', [DocumentController::class, 'Document'] )->name('document.Document');
Route::get('/qualification', [QualificationController::class, 'Qualification'] )->name('qualification.Qualification');
Route::get('/department', [DepartmentController::class, 'Department'] )->name('department.Deparment');
Route::get('/courcecat', [CourseCatagoryController::class, 'Coursecatagory'] )->name('courcecat.Coursecatagory');
Route::get('/batchtype', [BatchTypeController::class, 'BatchType'] )->name('batchtype.BatchType');
Route::get('/division', [DivisionController::class, 'Division'] )->name('division.Division');
Route::get('/castecat', [CasteCatagaryController::class, 'Castecatagory'] )->name('castecat.Castecatagory');
Route::get('/caste', [CasteController::class, 'Caste'] )->name('caste.Caste');
Route::get('/branch', [BranchController::class, 'Branch'] )->name('branch.Branch');
Route::get('/staff', [StaffController::class, 'Staff'] )->name('staff.Staff');
Route::get('/courseprovider', [CourseProController::class, 'CoursePro'] )->name('courseprovider.CoursePro');
Route::get('/BranchTable', [BranchTableController::class, 'BranchTable'] )->name('branchtable.BranchTable');
Route::get('/courseproviderTable', [CourseProTableController::class, 'CourseProTable'] )->name('courseproviderTable.CourseProTable');
Route::get('/courseproviderEdit/{id}',[CourseProEditController::class, 'CourseProEdit'] )->name('courseproviderEdit.CourseEdit');
Route::get('/parent', [ParentInfoController::class, 'ParentInfo'] )->name('parent.ParentInfo');
Route::get('/branchEdit/{id}',[BranchEditController::class, 'BranchEdit'] )->name('branchEdit.BranchEdit');
Route::get('/organization',[OrganizationController::class, 'Organization'] )->name('organization.Organization');
Route::get('/OrganizationTable',[OrgTableController::class, 'OrgTable'] )->name('organizationTable.OrgTable');
Route::get('/OrganizationEdit/{id}',[OrganizationEditController::class, 'OrgEdit'] )->name('OrganizationEdit.OrgEdit');
Route::get('/parentinfoedit/{id}',[ParentInfotableController::class, 'ParentInfoEdit'] )->name('ParentInfoEdit.ParentInfoEdit');
Route::get('/ParentInfo', [ParentInfotableController::class, 'ParentInfo'] )->name('ParentInfo.ParentInfo');
Route::get('/enquiry', [EnquiryController::class, 'Enquiry'] )->name('enquiry.Enquiry');
Route::get('/enquiryTable', [EnquiryController::class, 'EnquiryTable'] )->name('enquiryTable.EnquiryTable');
Route::get('/enquiryedit/{id}', [EnquiryController::class, 'EnquiryEdit'] )->name('enquiryedit.EnquiryEdit');
Route::get('/Feedback', [FeedbackController::class, 'Feedback'] )->name('Feedback.Feedback');
Route::get('/Stream', [StreamController::class, 'Stream'] )->name('Stream.Stream');
Route::get('/course', [CourseMainController::class, 'Course'] )->name('course.Course');
Route::get('/CourseEdit/{id}', [CourseMainController::class, 'CourseEdit'] )->name('CourseEdit.CourseEdit');
Route::get('/courseTable', [CourseMainController::class, 'CourseTable'] )->name('courseTable.CourseTable');
Route::get('/attendence', [AttendenceController::class, 'Attendence'] )->name('attendence.Attendence');
Route::get('/followUp', [FollowUpController::class, 'Followup'] )->name('followUp.Followup');
Route::get('/taskcategory', [TaskCategoryController::class, 'taskcategory'] )->name('Taskcategory.taskcategory');
Route::get('/group', [GroupController::class, 'groups'] )->name('Groups.group');
Route::get('/staffassign', [StaffAssignController::class, 'StaffAssign'] )->name('staffassign.StaffAssign');
Route::get('/viewtask', [ViewTaskController::class, 'taskview'] );
Route::get('/FollowupPage', [ReportController::class, 'followupreport'] );
Route::get('/followupreport', [ReportController::class, 'followupreport'])->name('followupreport');
Route::get('/academicYear', [AcademicYearController::class, 'Year'] )->name('academicYear.AcademicYear');
Route::get('/Taskstatus', [TaskStatusController::class, 'TaskStatus'] )->name('Taskstatus.TaskStatus');
Route::get('/AddTask', [AddTaskController::class, 'AddTask'] )->name('AddTask.AddTask');

Route::get('/getStaffByBranch', [EnquiryController::class, 'getStaffByBranch'] )->name('getStaffByBranch.getStaffByBranch');
Route::get('/notInterest', [NotinterestController::class, 'EnquiryTable'] )->name('notInterest.EnquiryTable');
Route::get('/DirectAdmission', [DirectAdmissionController::class, 'EnquiryTable'] )->name('DirectAdmission.EnquiryTable');


Route::post('/update-column/{id}', 'DashboardController@updateColumn')->name('update.column');
Route::get('/fee_category', [FeeCategoryController::class, 'FeeCategory'] )->name('fee_category.Fee_category');
Route::get('/task', [TaskTemplateController::class, 'index'])->name('task_template.index');


Route::get('/Fee_type', function () {
    return view('Fee_type');
});


Route::get('/fee', function () {
    return view('fee');
});


Route::get('/Academic_year', function () {
    return view('Academic_year');
});

Route::get('/Student_card', function () {
    return view('Student_card');
});


Route::get('/Toggle_switch', function () {
    return view('Toggle_switch');
});

Route::get('/Default_toggle', function () {
    return view('Default_toggle');
});

Route::get('/Data_table', function () {
    return view('Data_table');
});
});

require __DIR__.'/auth.php';

?>