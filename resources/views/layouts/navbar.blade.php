<div class="d-flex align-items-center justify-content-between">
    <i class="bi bi-list toggle-sidebar-btn"></i>
      <a href="{{ url('/dashboard') }}" class="logo d-flex align-items-center">
        <span class="d-lg-block ms-3">Inston</span>
        <img class="ps-2" src="{{url('assets/images/logo.png')}}" style="width:30px; height:30px;">
      </a>      
</div><!-- End Logo -->
<nav class="header-nav ms-auto me-auto">
  <ul class="d-md-flex align-items-center d-none">
      <li class="nav-item">
          <a class="nav-link  navbr me-4"  href="{{ url('/enquiry') }}">Enquiry</a>
          </li>
          <li class="nav-item">
          <a class="nav-link  navbr me-4" href="{{ url('/admission') }}">Admission</a>
          </li>
          <li class="nav-item">
          <a class="nav-link navbr me-4" href="{{ url('/batch') }}">Batch</a>
      </li>
  </ul>
</nav><!-- End Icons Navigation -->

<div class="dropdown me-4 text-end">
   <span class="d-md-block ps-2">{{ Auth::user()->name }}</span>
</div>