<ul class="sidebar-nav" id="sidebar-nav">
  <div class=" d-flex justify-content-center">
    <img src="{{url('assets/images/logo.png')}}" style="width:110px; height:110px;">
  </div>
  <li class="nav-item mt-3">
    <a class="nav-link collapsed " href="{{ url('/dashboard') }}">
    <i>  <img src="{{url('assets/images/dashboard.png')}}" style="width:20px; height:20px;"></i>
      <span>Dashboard</span>
    </a>
  </li> 
  <li class="nav-item mt-3">
    <a class="nav-link collapsed " href="{{ url('/enquiryTable') }}">
    <i>  <img src="{{url('assets/images/enquiry.png')}}" style="width:20px; height:20px;"></i>
      <span>Enquiry</span>
    </a>
  </li>
  <li class="nav-item mt-3">
    <a class="nav-link collapsed " href="{{ url('/staffassign') }}">
    <i>  <img src="{{url('assets/images/staffassign.png')}}" style="width:20px; height:20px;"></i>
      <span>Staff Assign</span>
    </a>
  </li> 
  <li class="nav-item mt-3">
    <a class="nav-link collapsed " href="{{ url('/followUp') }}">
    <i>  <img src="{{url('assets/images/dashboard.png')}}" style="width:20px; height:20px;"></i>
      <span>Follow-Up </span>
    </a>
  </li> 

  <li class="nav-item mt-3">
    <a class="nav-link collapsed " href="{{ url('/ImportDatas') }}">
    <i>  <img src="{{url('assets/images/import.png')}}" style="width:20px; height:20px;"></i>
      <span>Import Data</span>
    </a>
  </li> 
  {{-- <li class="nav-item mt-3">
    <a class="nav-link collapsed " href="{{ url('/DuplicateData') }}">
    <i> <img src="{{url('assets/images/duplicate.png')}}" style="width:20px; height:20px;"></i>
      <span>Duplicate Data</span>
    </a>
  </li>  --}}
  
  <li class="nav-item mt-3">
    <a class="nav-link collapsed " href="{{ url('/attendence') }}">
    <i>  <img src="{{url('assets/images/attendence.png')}}" style="width:20px; height:20px;"></i>
      <span>Attendence</span>
    </a>
  </li>   
   
  
  <li class="nav-item mt-3">
    <a class="nav-link collapsed " href="{{ url('/admission') }}">
    <i>  <img src="{{url('assets/images/coursetype.png')}}" style="width:20px; height:20px;"></i>
      <span>Admission</span>
    </a>
  </li> 
  <li class="nav-item mt-3">
    <a class="nav-link collapsed " href="{{ url('/BatchTable') }}">
    <i>  <img src="{{url('assets/images/batchtype.png')}}" style="width:20px; height:20px;"></i>
      <span>Batch</span>
    </a>
  </li> 
  


  <!-- task Dropdown Start -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#task" data-bs-toggle="collapse" href="#">
    <i> <img src="{{url('assets/images/taskv.png')}}" style="width:20px; height:20px;"></i>
    <span>Tasks</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="task" class="nav-content collapse " data-bs-parent="#sidebar-nav">       
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/taskcategory')}}">
          <i> <img src="{{url('assets/images/taskcat.png')}}" style="width:20px; height:20px;"> </i>
          <span>Task Category</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/Taskstatus')}}">
          <i> <img src="{{url('assets/images/taskcat.png')}}" style="width:20px; height:20px;"> </i>
          <span>Task Status</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <a class="nav-link collapsed " href="{{ url('/task') }}">
        <i>  <img src="{{url('assets/images/task.png')}}" style="width:20px; height:20px;"></i>
          <span>Task Template</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <a class="nav-link collapsed " href="{{ url('/AddTask') }}">
        <i>  <img src="{{url('assets/images/orgtable.png')}}" style="width:20px; height:20px;"></i>
          <span>Add Task</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <a class="nav-link collapsed " href="{{ url('/viewtask') }}">
        <i>  <img src="{{url('assets/images/viewtask.png')}}" style="width:20px; height:20px;"></i>
          <span>My Task</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <a class="nav-link collapsed " href="{{ url('/viewtaskboard') }}">
        <i>  <img src="{{url('assets/images/taskv.png')}}" style="width:20px; height:20px;"></i>
          <span>View Tasks</span>
        </a>
      </li> 
      <li class="nav-item mt-3">
        <a class="nav-link collapsed " href="{{ url('/taskreport') }}">
        <i>  <img src="{{url('assets/images/taskreport.png')}}" style="width:20px; height:20px;"></i>
          <span>Task Report</span>
        </a>
      </li>
    </ul>
  </li>
  <!-- task Dropdown End -->

  <!-- Masters Dropdown Start -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
    <i> <img src="{{url('assets/images/master.png')}}" style="width:20px; height:20px;"></i>
    <span>Masters</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">     
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/enquirytype') }}">
          <i> <img src="{{url('assets/images/enquiry.png')}}" style="width:20px; height:20px;"> </i>
          <span>Enquiry Type</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/department') }}">
          <i> <img src="{{url('assets/images/department.png')}}" style="width:20px; height:20px;"> </i>
          <span> Department </span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/ParentInfo')}}">
          <i> <img src="{{url('assets/images/parentinfo.png')}}" style="width:20px; height:20px;"> </i>
          <span> Parent Info </span>
        </a>
      </li> 
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/courcecat')}}">
          <i> <img src="{{url('assets/images/courcecategory.png')}}" style="width:20px; height:20px;"> </i>
          <span> Course Category </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/coursetype')}}">
          <i> <img src="{{url('assets/images/coursetype.png')}}" style="width:20px; height:20px;"> </i>
          <span> Course Type </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/batchtype')}}">
          <i> <img src="{{url('assets/images/batchtype.png')}}" style="width:20px; height:20px;"> </i>
          <span> Batch Type </span>
        </a>
      </li> 
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/document')}}">
          <i> <img src="{{url('assets/images/document.png')}}" style="width:20px; height:20px;"> </i>
          <span> Document </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/qualification')}}">
          <i> <img src="{{url('assets/images/qualification.png')}}" style="width:20px; height:20px;"> </i>
          <span> Qualification </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/Stream')}}">
          <i> <img src="{{url('assets/images/stream.png')}}" style="width:20px; height:20px;"> </i>
          <span> Stream </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/group')}}">
          <i> <img src="{{url('assets/images/batch.png')}}" style="width:20px; height:20px;"> </i>
          <span> Group/Team </span>
        </a>
      </li>  
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/division')}}">
          <i> <img src="{{url('assets/images/division.png')}}" style="width:20px; height:20px;"> </i>
          <span> Division </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/religion')}}">
          <i> <img src="{{url('assets/images/religion.png')}}" style="width:20px; height:20px;"> </i>
          <span> Religion </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/relation')}}">
          <i> <img src="{{url('assets/images/relation.png')}}" style="width:20px; height:20px;"> </i>
          <span> Relation </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/castecat')}}">
          <i> <img src="{{url('assets/images/castecategory.png')}}" style="width:20px; height:20px;"> </i>
          <span> Caste Category </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/caste')}}">
          <i> <img src="{{url('assets/images/caste.png')}}" style="width:20px; height:20px;"> </i>
          <span> Caste </span>
        </a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/staff')}}">
          <i> <img src="{{url('assets/images/staff.png')}}" style="width:20px; height:20px;"> </i>
          <span> Staff </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/OrganizationTable')}}">
          <i> <img src="{{url('assets/images/organization.png')}}" style="width:20px; height:20px;"> </i>
          <span> Organization </span>
        </a>
      </li>
      
    
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/courseproviderTable')}}">
          <i> <img src="{{url('assets/images/courseprovider.png')}}" style="width:20px; height:20px;"> </i>
          <span> Course Provider </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/courseTable')}}">
          <i> <img src="{{url('assets/images/course.png')}}" style="width:20px; height:20px;"> </i>
          <span> Course </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/BranchTable')}}">
          <i> <img src="{{url('assets/images/branch.png')}}" style="width:20px; height:20px;"> </i>
          <span> Branch</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/Feedback')}}">
          <i> <img src="{{url('assets/images/feedback.png')}}" style="width:20px; height:20px;"> </i>
          <span> Feedback</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/fee_category')}}">
          <i> <img src="{{url('assets/images/feedback.png')}}" style="width:20px; height:20px;"> </i>
          <span> Fee Category</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/Fee_type')}}">
          <i> <img src="{{url('assets/images/feedback.png')}}" style="width:20px; height:20px;"> </i>
          <span> Fee Type</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/academicYear')}}">
          <i> <img src="{{url('assets/images/calendar.png')}}" style="width:20px; height:20px;"> </i>
          <span> Academic Year</span>
        </a>
      </li>
  </ul>
</li> 
<!-- Masters Dropdown End -->

  <!-- Reports Dropdown Start -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#Report" data-bs-toggle="collapse" href="#">
    <i> <img src="{{url('assets/images/taskreport.png')}}" style="width:20px; height:20px;"></i>
    <span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="Report" class="nav-content collapse " data-bs-parent="#sidebar-nav">       

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/FollowupPage')}}">
          <i> <img src="{{url('assets/images/viewtask.png')}}" style="width:20px; height:20px;"> </i>
          <span>Follow Up Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/notInterest')}}">
          <i> <img src="{{url('assets/images/viewtask.png')}}" style="width:20px; height:20px;"> </i>
          <span>Course Not Interest</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/DirectAdmission')}}">
          <i> <img src="{{url('assets/images/viewtask.png')}}" style="width:20px; height:20px;"> </i>
          <span>Direct Admission</span>
        </a>
      </li>

    </ul>
  </li>
  <!-- Reports Dropdown End -->



<!-- Settings Dropdown Start -->
<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#form-nav" data-bs-toggle="collapse" href="#">
  <i> <img src="{{url('assets/images/settings.png')}}" style="width:20px; height:20px;"></i>
  <span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="form-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">     
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('/ResetPassword/{id}') }}">
        <i> <img src="{{url('assets/images/password.png')}}" style="width:20px; height:20px;"> </i>
        <span>Reset Passsword</span>
      </a>
    </li>
  </ul>
</li>
<!-- Settings Dropdown End -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="{{ '/logout' }}">
    <i><img src="{{url('assets/images/logout.png')}}" style="width:20px; height:20px;"></i>
      <span>Log Out</span>
    </a>
  </li>
</ul>
<div class="d-flex justify-content-center ps-4">
<button class="btn btn-primary px-5 py-0">V 1.1 BETA</button>
</div>


