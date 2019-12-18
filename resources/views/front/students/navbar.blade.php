<header class="app-header">
  <div class="top-bar">
    <div class="top-bar-brand">
      <a href="{{ route("stddashboard") }}" style="font-weight: 500;line-height: 1rem;">Student Dashboard</a>
    </div>
    <div class="top-bar-list">
      <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
        <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="Menu" aria-controls="navigation">
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
        </button>
      </div>
      <div class="top-bar-item top-bar-item-full">
        <div class="top-bar-search">
          <div class="input-group input-group-search">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <span class="oi oi-magnifying-glass"></span>
              </span>
            </div>
            <input type="text" class="form-control" aria-label="Search" placeholder="Search"> </div>
          </div>
        </div>
        <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
          
          <div class="dropdown">
            <button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="user-avatar user-avatar-md">
            <img src="{{ asset("backend/images/avatars/profile.jpg") }}" alt=""></span> <span class="account-summary pr-lg-4 d-none d-lg-block"><span class="account-name">
            {{ strtoupper(Auth('student')->user()->stdName)  }}</span> <span class="account-description">Student</span></span>
            </button>
            <div class="dropdown-arrow dropdown-arrow-left"></div><!-- .dropdown-menu -->
            <div class="dropdown-menu">
              <h6 class="dropdown-header d-none d-md-block d-lg-none"> {{ strtoupper(Auth('student')->user()->stdName) }} </h6><a class="dropdown-item" href="{{ route('student.profile') }}"><span class="dropdown-icon oi oi-person"></span> Profile</a>
              <a class="dropdown-item" href="{{ route('student.logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><span class="dropdown-icon oi oi-account-logout"></span>  {{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
                
                
              </div>
            </div>
          </div>
        </div>
      </header>