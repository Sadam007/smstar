<aside class="app-aside">
        <div class="aside-content">
          <header class="aside-header d-block d-md-none">
            <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
              <span class="user-avatar user-avatar-lg">
                <img src="{{asset('backend/images/avatars/profile.jpg')}}" alt="">
              </span>
              <span class="account-icon">
                <span class="fa fa-caret-down fa-lg"></span>
              </span>
              <span class="account-summary">
                <span class="account-name">{{ strtoupper(Auth('degAdmin')->user()->username) }}</span>
                <span class="account-description">Degree Administrator</span>
              </span>
            </button>
            <div id="dropdown-aside" class="dropdown-aside collapse">
              <div class="pb-3">
                <a class="dropdown-item" href="{{ route('degadmin.profile') }}">
                  <span class="dropdown-icon oi oi-person"></span> Profile</a>
                <a class="dropdown-item" href="{{ route('specialuser.logout') }}">
                  <span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
                
              </div>
            </div>
          </header>
          <section class="aside-menu has-scrollable">
            <nav id="stacked-menu" class="stacked-menu">
              <ul class="menu">
                <li class="menu-item has-active">
                  <a href="{{ route('degAdmindashboard') }}" class="menu-link">
                    <span class="menu-icon oi oi-dashboard"></span>
                    <span class="menu-text">Dashboard</span>
                  </a>
                </li>
                
                <li class="menu-header">Staff Management </li>
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-puzzle-piece"></span>
                    <span class="menu-text">Users Management</span>
                  </a>
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="#" class="menu-link">Create User</a>
                    </li>
                    <li class="menu-item">
                      <a href="#" class="menu-link">All Users</a>
                    </li>
                  </ul>
                </li>

                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-people"></span>
                    <span class="menu-text">CrossTab Management</span>
                  </a>
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="{{ route('crossTabDegrees') }}" class="menu-link">View Assigned Degrees</a>
                    </li>
                    <li class="menu-item">
                      <a href="#" class="menu-link">Degree Admins</a>
                    </li>
                  </ul>
                </li>


                <li class="menu-header">Teacher Management </li>
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-puzzle-piece"></span>
                    <span class="menu-text">Teachers Management</span>
                  </a>
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="#" class="menu-link">All Teachers</a>
                    </li>
                  </ul>
                </li>
                
                
              </ul>
            </nav>
          </section>
        </div>
      </aside>