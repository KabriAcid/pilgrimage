<div id="bottomHeader">
  <div class="container-fluid">
    <nav class="navbar  navbar-expand-md justify-content-right" style="background-color:#ffffff">
      <a class="navbar-brand" href="">
        <img src="#" width="250px" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/member/home">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Administration</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/shura">Shura Committee</a>
              <a class="dropdown-item" href="/management">Management</a>

            </div>

          </li>

          
          <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Our products & services</a>
                <div class="dropdown-menu">
                 
                  <a class="dropdown-item" href="/mudarabah">Mudarabah</a>
                  <a class="dropdown-item" href="/musharakah">Musharakah</a>  
                  <a class="dropdown-item" href="/murabahah">Murabahah</a>
                  <a class="dropdown-item" href="/musawamah">Musawamah</a>   
                  <a class="dropdown-item" href="/ijarah">Ijarah</a>
                  <a class="dropdown-item" href="/qard-hassan">Qard-Hassan</a>                               
                </div>
              </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">Accounts and Loans</a>
            <div class="dropdown-menu">
               <a class="nav-link" href="/member/home">My Accounts</a>
               <a class="nav-link" href="{{route('member_loans')}}">My Loans</a>

            </div>

          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" href="#">My profile</a>
            <div class="dropdown-menu">
                <a class="nav-link" href="{{route('view_ppicture')}}">Upload/update profile picture</a>
               <a class="nav-link" href="{{route('change_password_get')}}">Change password</a>
                <a class="nav-link" href="{{route('self_update')}}">Update Info</a>

            </div>

          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="{{route('view_ppicture')}}">Upload/update profile picture</a>
          </li> -->
        </ul>
      </div>
      <div class="user">
        <a href="/logout"> Logout |</a>
        |Logged in as: {{Auth::user()->name}}
      </div>
    </nav>

  </div>
</div>
</div>
</header>