<header class="app-header">
  <div class="top-bar">
    <div class="top-bar-brand">
      <a href="{{ route("secdashboard") }}" style="font-weight: 500;line-height: 1rem;">Secrecy Users Dashboard</a>
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
            <input type="text" class="form-control" aria-label="Search" placeholder="Search"> 
          </div>
        </div>
      </div>
      <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
        <ul class="header-nav nav">
          <li class="nav-item dropdown header-nav-dropdown has-notified">
            <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="oi oi-envelope-open"></span>
            </a>
            <div class="dropdown-arrow"></div>
            <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
              <h6 class="dropdown-header stop-propagation">
              <span>Messages</span>
              <a href="#">Mark all as read</a>
              </h6>
              <div class="dropdown-scroll has-scrollable">
                <a href="#" class="dropdown-item unread">
                  <div class="user-avatar">
                  <img src="{{asset('backend/images/avatars/team1.jpg')}}" alt=""> </div>
                  <div class="dropdown-item-body">
                    <p class="subject"> Stilearning </p>
                    <p class="text text-truncate"> Invitation: Joe's Dinner @ Fri Aug 22 </p>
                    <span class="date">2 hours ago</span>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="user-avatar">
                  <img src="{{asset('backend/images/avatars/team3.png')}}" alt=""> </div>
                  <div class="dropdown-item-body">
                    <p class="subject"> Openlane </p>
                    <p class="text text-truncate"> Final reminder: Upgrade to Pro </p>
                    <span class="date">23 hours ago</span>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="tile tile-circle bg-green"> GZ </div>
                  <div class="dropdown-item-body">
                    <p class="subject"> Gogo Zoom </p>
                    <p class="text text-truncate"> Live healthy with this wireless sensor. </p>
                    <span class="date">1 day ago</span>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="tile tile-circle bg-teal"> GD </div>
                  <div class="dropdown-item-body">
                    <p class="subject"> Gold Dex </p>
                    <p class="text text-truncate"> Invitation: Design Review @ Mon Jul 7 </p>
                    <span class="date">1 day ago</span>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="user-avatar">
                  <img src="{{asset('backend/images/avatars/team2.png')}}" alt=""> </div>
                  <div class="dropdown-item-body">
                    <p class="subject"> Creative Division </p>
                    <p class="text text-truncate"> Need some feedback on this please </p>
                    <span class="date">2 days ago</span>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="tile tile-circle bg-pink"> LD </div>
                  <div class="dropdown-item-body">
                    <p class="subject"> Lab Drill </p>
                    <p class="text text-truncate"> Our UX exercise is ready </p>
                    <span class="date">6 days ago</span>
                  </div>
                </a>
              </div>
              <a href="app-messages.html" class="dropdown-footer">All messages
                <i class="fa fa-fw fa-long-arrow-alt-right"></i>
              </a>
            </div>
          </li>
        </ul>
        <div class="dropdown">
          <button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="user-avatar user-avatar-md">
            <img src="{{ asset("backend/images/avatars/profile.jpg") }}" alt=""></span> <span class="account-summary pr-lg-4 d-none d-lg-block"><span class="account-name">
            {{ strtoupper(Auth('secrecyuser')->user()->username)  }}</span> <span class="account-description">Secrecy Staff</span></span>
          </button>
          <div class="dropdown-arrow dropdown-arrow-left"></div>
          <div class="dropdown-menu">
            <h6 class="dropdown-header d-none d-md-block d-lg-none"> {{ strtoupper(Auth('secrecyuser')->user()->username)  }} </h6><a class="dropdown-item" href="{{ route('secrecyuser.profile') }}"><span class="dropdown-icon oi oi-person"></span> Profile</a>
            <a class="dropdown-item" href="{{ route('secrecyuser.logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><span class="dropdown-icon oi oi-account-logout"></span>  {{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('secrecyuser.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
        </div>
      </div>
    </div>
</header>