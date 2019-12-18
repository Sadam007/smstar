<header class="app-header">
  <div class="top-bar">
    <div class="top-bar-brand">
      <a href="{{ route("tdashboard") }}" style="font-weight: 500;line-height: 1rem;">Teaher Dashboard</a>
    </div>
    <div class="top-bar-list">
      <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
        <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="Menu" aria-controls="navigation">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>
      </div>
      <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
        <ul class="header-nav nav">
          <li class="nav-item dropdown header-nav-dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="oi oi-grid-three-up"></span>
            </a>
            <div class="dropdown-arrow"></div>
            <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
              <div class="dropdown-sheets">
                <div class="dropdown-sheet-item">
                  <a href="#" class="tile-wrapper">
                    <span class="tile tile-lg bg-indigo">
                      <i class="oi oi-people"></i>
                    </span>
                    <span class="tile-peek">Teams</span>
                  </a>
                </div>
                <div class="dropdown-sheet-item">
                  <a href="#" class="tile-wrapper">
                    <span class="tile tile-lg bg-teal">
                      <i class="oi oi-fork"></i>
                    </span>
                    <span class="tile-peek">Projects</span>
                  </a>
                </div>
                <div class="dropdown-sheet-item">
                  <a href="#" class="tile-wrapper">
                    <span class="tile tile-lg bg-pink">
                      <i class="fa fa-tasks"></i>
                    </span>
                    <span class="tile-peek">Tasks</span>
                  </a>
                </div>
                <div class="dropdown-sheet-item">
                  <a href="#" class="tile-wrapper">
                    <span class="tile tile-lg bg-yellow">
                      <i class="oi oi-fire"></i>
                    </span>
                    <span class="tile-peek">Feeds</span>
                  </a>
                </div>
                <div class="dropdown-sheet-item">
                  <a href="#" class="tile-wrapper">
                    <span class="tile tile-lg bg-cyan">
                      <i class="oi oi-document"></i>
                    </span>
                    <span class="tile-peek">Files</span>
                  </a>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <div class="dropdown">
            <button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="user-avatar user-avatar-md">
              <img src="{{ asset("backend/images/avatars/profile.jpg") }}" alt=""></span>
              <span class="account-summary pr-lg-4 d-none d-lg-block"><span class="account-name">
                {{ strtoupper(Auth('teacher')->user()->name)  }}</span>
              <span class="account-description">Teacher</span></span>
            </button>
          <div class="dropdown-arrow dropdown-arrow-left"></div>
          <div class="dropdown-menu">
            <h6 class="dropdown-header d-none d-md-block d-lg-none"> {{ strtoupper(Auth('teacher')->user()->name)  }} </h6><a class="dropdown-item" href="{{ route('teacher.profile') }}"><span class="dropdown-icon oi oi-person"></span> Profile</a> 

            <a class="dropdown-item" href="{{ route('teacher.logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><span class="dropdown-icon oi oi-account-logout"></span>  {{ __('Logout') }}</a>

              <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
          </div>
        </div>
      </div>
    </div>
</header>
     