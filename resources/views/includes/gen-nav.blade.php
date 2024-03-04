@php
$canUploadAlhazai = session('canUploadAlhazai');
$canAllocateSpace = session('canAllocateSpace');
$isSuperAdmin = session('isSuperAdmin');
@endphp

<header>
  <div id="bottomHeader">
    <div class="topbar2">
      <!-- empty bar -->
    </div>

    <div class="row header2">
      <div class="col-lg-3">
        <img src="{{ asset('images/mecca1.jpeg') }}" class="logoLeft">
        <img src="{{ asset('images/mecca1.jpeg') }}" class="logoLeft">
      </div>

      <div class="col-lg-6" style="background-color: rgba(187, 117, 13, 0.527); height: 165px;">
        <div class="jumbotron">
          <h2 class="text-light">Katsina State Pilgrims’ Welfare Board</h2>
          <h5 class="text-light text-center">Sarki Abdul’Rahman Way, Katsina, Katsina State.</h5>
        </div>
      </div>

      <div class="col-lg-3">
        <!-- <img src="{{ asset('images/mecca4.png') }}" class="logoRight">
        <img src="{{ asset('images/mecca4.png') }}" class="logoRight"> -->
      </div>
    </div>

    <div class="row topbar3">
      <!-- Another empty bar -->
    </div>

    <div class="row">

      <!-- Begin Nav -->
      <div class="col-lg-12 col-md-5 col-sm-3">  
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav">
                @if(Auth::guest())
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login.show') }}">Login</a>
                </li>
                @endif
                @if(!Auth::guest())
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Rented Properties</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('add_property') }}">Manage Properties</a>
                    <a class="dropdown-item" href="/report/uploaded-spaces">Uploaded Accommodation</a>
                    <a class="dropdown-item" href="/report/occupied-spaces">Occupied Accommodation</a>
                    <a class="dropdown-item" href="/report/unoccupied-spaces">Unoccupied Accommodation</a>
                  </div>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Alhazai</a>
                  <div class="dropdown-menu">
                    @if($canUploadAlhazai)
                    <a class="dropdown-item" href="{{route('register_alhaji')}}"">Register Alhaji </a>
                    <a class="dropdown-item" href="{{ route('manage_alhazai') }}">Upload Alhazai</a>
                    <a class="dropdown-item" href="{{route('manage_officials')}}"">Upload Officials </a>
                    @endif
                    <a class="dropdown-item" href="{{ route('list_alhazai') }}">List of Alhazai</a>
                  </div>
                </li>

                @if($canAllocateSpace)
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Accommodation</a>
                  <div class="dropdown-menu">
                    <a class="nav-link" href="{{ route('manage_allocation') }}">Space Allocation</a>
                    <a class="nav-link" href="{{ route('officials_allocation') }}">Allocation to Officials</a>
                    <a class="nav-link" href="{{ route('special_allocation') }}">Special Allocation</a>
                  </div>
                </li>
                @endif

                @if($isSuperAdmin)
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Settings</a>
                  <div class="dropdown-menu">
                    <a class="nav-link" href="/users/list">User Management</a>
                    <a class="nav-link" href="{{ route('role') }}">Role Management</a>
                    <a class="nav-link" href="{{ route('generate_qr') }}">Generate QR codes</a>
                    <a class="nav-link" href="{{ route('generate_ids') }}">Generate Identity Cards</a>
                  </div>
                </li>
                @endif

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Reports</a>
                  <div class="dropdown-menu">
                    <a class="nav-link" href="{{ route('summary') }}">Report Summary</a>
                    <a class="nav-link" href="{{ route('all_alhazai') }}">All Alhazai in Excel</a>
                    <a class="nav-link" href="/report/alhazai/yes">Accommodated in Excel</a>
                    <a class="nav-link" href="/report/alhazai/no">Unaccommodated in Excel</a>
                  </div>
                </li>
                @endif
                @if(!Auth::guest())
                <li class="nav-item dropdown">
                  <a class="nav-link"  role="button" href="/logout"> Log Out </a>
                  
                </li>
                @endif
              </ul>
            </div>
          </nav>
        </div>
      </div>
      <!-- End Nav -->
      
      </div>
    </div>
    
  </div>
</header>