@php
$canUploadAlhazai = session('canUploadAlhazai');
$canAllocateSpace = session ('canAllocateSpace');
$isSuperAdmin = session ('isSuperAdmin');
@endphp
<div id="bottomHeader">
  <div class="topbar2">
    <!-- empty bar -->
  </div>

  <div class="row header2">
    <div class="col-md-3">
      <img src="{{ asset('images/mecca1.jpeg') }}" class="logoLeft">
      <img src="{{ asset('images/mecca1.jpeg') }}" class="logoLeft">


    </div>

    <div class="col-md-6" style="background-color: rgba(187, 117, 13, 0.527); height: 165px;">
      <!-- <h2 class="text-light">Katsina State Pilgrims’ Welfare Board</h2>
      <h5 class="text-light text-center"> Sarki Abdul’Rahman Way, Katsina, Katsina State. </h5> -->
      <div class="jumbotron">
        <h2 class="text-light">Katsina State Pilgrims’ Welfare Board</h2>
        <h5 class="text-light text-center">Sarki Abdul’Rahman Way, Katsina, Katsina State.</h5>
      </div>

    </div>

    <div class="col-md-3">
      <!-- <img src="{{ asset('images/mecca4.png') }}" class="logoRight">
      <img src="{{ asset('images/mecca4.png') }}" class="logoRight"> -->
    </div>
  </div>

  <div class=" row topbar3">

    <!-- Another empty bar -->
  </div>
  <!--  -->

  <div class="row">
    <!-- <div class="myNavs"> -->
    @if(!Auth::guest())
    <div class="user">
      <a href="/logout"> Logout |</a>
      |Logged in as: {{Auth::user()->name}}
    </div>
    @endif
    <!-- Navs start here -->


    <div class="col-md-2" style="background-color: rgba(187, 117, 13, 0.527); width:20%">
      <div class="container-fluid">
        <nav class="navbar">
          <ul class="nav navbar-nav navbar-expand-lg navbar-light ">
            <!-- <nav class="navbar navbar-expand-lg navbar-light"> -->

            @if(Auth::guest())

            <li class="nav-item">
              <a class="nav-link" href="{{route('login.show')}}"> Login</a>
            </li>

            @endif
            @if(!Auth::guest())
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Rented Properties</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('add_property')}}">Manage Properties</a>
                <a class="dropdown-item" href="/report/uploaded-spaces">Uploaded Accomdation</a>
                <a class="dropdown-item" href="/report/occupied-spaces">Occupied Accomdation</a>
                <a class="dropdown-item" href="/report/unoccupied-spaces">UnOccupied Accomdation</a>




              </div>

            </li>




            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Alhazai</a>
              <div class="dropdown-menu">

                @if($canUploadAlhazai)
                <a class="dropdown-item" href="{{route('register_alhaji')}}"">Register Alhaji </a>
                <a class="dropdown-item" href="{{route('manage_alhazai')}}"">Upload Alhazai </a>
                <a class="dropdown-item" href="{{route('manage_officials')}}"">Upload Officials </a>
                  @endif
                  <a class=" dropdown-item" href="{{route('list_alhazai')}}">List of Alhazai </a </div>

            </li>
            @if($canAllocateSpace)
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Accomodation</a>
              <div class="dropdown-menu">
                <a class="nav-link" href="{{route('manage_allocation')}}">Space Allocation</a>
                <a class="nav-link" href="{{route('officials_allocation')}}">Allocation to Officials</a>
                <a class="nav-link" href="{{route('special_allocation')}}">Special Allocation</a>

              </div>

            </li>
            @endif

            @if ($isSuperAdmin)
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Settings</a>
              <div class="dropdown-menu">

                <a class="nav-link" href="/users/list">User Management</a>
                <a class="nav-link" href="{{route('role')}}">Role Management</a>
                <a class="nav-link" href="{{route('generate_qr')}}">Generate QR codes</a>



              </div>

            </li>
            @endif

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Reports</a>
              <div class="dropdown-menu">
                <a class="nav-link" href="{{route('summary')}}">Report Summary</a>
                <a class="nav-link" href="{{route('all_alhazai')}}">All Alhazai in Excel</a>
                <a class="nav-link" href="/report/alhazai/yes">Accomodated in Excel</a>
                <a class="nav-link" href="/report/alhazai/no">Unaccomodated in Excel</a>




              </div>

            </li>





            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">My profile</a>
              <div class="dropdown-menu">
                <a class="nav-link" href="#">Upload/update profile picture</a>
                <a class="nav-link" href="#">Change password</a>
                <a class="nav-link" href="#">Update Info</a>

              </div>

            </li> -->
            @endif

          </ul>
        </nav>
      </div>
    </div>
    <!-- <div class="col-sm-3"> -->
    <!-- Each Page to define one or more columns  left to the nav bar?? -->
    @yield('content')
    <!-- </div> -->


  </div>
  <!-- end navs -->
</div>
<!-- end row -->

</div>
</header>