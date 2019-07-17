 <!-- .app-aside -->
      <aside class="app-aside">
        <!-- .aside-content -->
        <div class="aside-content">
          <!-- .aside-header -->
          <header class="aside-header d-block d-md-none">
            <!-- .btn-account -->
            <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
              <span class="user-avatar user-avatar-lg">
                <img src="{{asset('backend/images/avatars/profile.jpg')}}" alt="">
              </span>
              <span class="account-icon">
                <span class="fa fa-caret-down fa-lg"></span>
              </span>
              <span class="account-summary">
                <span class="account-name">Sadam Hussain</span>
                <span class="account-description">Marketing Manager</span>
              </span>
            </button>
            <!-- /.btn-account -->
            <!-- .dropdown-aside -->
            <div id="dropdown-aside" class="dropdown-aside collapse">
              <!-- dropdown-items -->
              <div class="pb-3">
                <a class="dropdown-item" href="user-profile.html">
                  <span class="dropdown-icon oi oi-person"></span> Profile</a>
                <a class="dropdown-item" href="auth-signin-v1.html">
                  <span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Help Center</a>
                <a class="dropdown-item" href="#">Ask Forum</a>
                <a class="dropdown-item" href="#">Keyboard Shortcuts</a>
              </div>
              <!-- /dropdown-items -->
            </div>
            <!-- /.dropdown-aside -->
          </header>
          <!-- /.aside-header -->
          <!-- .aside-menu -->
          <section class="aside-menu has-scrollable">
            <!-- .stacked-menu -->
            <nav id="stacked-menu" class="stacked-menu">
              <!-- .menu -->
              <ul class="menu">
                <!-- .menu-item -->
                <li class="menu-item has-active">
                  <a href="{{ route('tdashboard') }}" class="menu-link">
                    <span class="menu-icon oi oi-dashboard"></span>
                    <span class="menu-text">Dashboard</span>
                  </a>
                </li>
                <!-- /.menu-item -->
                <!-- .menu-item -->
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-browser"></span>
                    <span class="menu-text">Layouts</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="layout-blank.html" class="menu-link">Blank Page</a>
                    </li>
                  </ul>
                  <!-- /child menu -->
                </li>
                <!-- /.menu-item -->
                <!-- .menu-header -->
                <li class="menu-header">Student Management </li>
                <!-- /.menu-header -->
                <!-- .menu-item -->
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-puzzle-piece"></span>
                    <span class="menu-text">Users Management</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="#" class="menu-link">Create User</a>
                    </li>
                    <li class="menu-item">
                      <a href="#" class="menu-link">All Users</a>
                    </li>
                  </ul>
                  <!-- /child menu -->
                </li>
                <!-- /.menu-item -->
                <!-- .menu-item -->
                <li class="menu-header">Other Activities </li>
                <!-- /.menu-header -->
                <!-- .menu-item -->
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-wrench"></span>
                    <span class="menu-text">Auth</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="auth-comingsoon-v1.html" class="menu-link">Page one</a>
                    </li>
                    <li class="menu-item">
                      <a href="auth-comingsoon-v2.html" class="menu-link">Page two</a>
                    </li>
                    <li class="menu-item">
                      <a href="auth-cookie-consent.html" class="menu-link">Page three</a>
                    </li>
                    
                  </ul>
                  <!-- /child menu -->
                </li>
                <!-- /.menu-item -->
                <!-- .menu-item -->
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-people"></span>
                    <span class="menu-text">User</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="user-profile.html" class="menu-link">Profile</a>
                    </li>
                    <li class="menu-item">
                      <a href="user-activities.html" class="menu-link">Activities</a>
                    </li>
                    <li class="menu-item">
                      <a href="user-teams.html" class="menu-link">Teams</a>
                    </li>
                    <li class="menu-item">
                      <a href="user-projects.html" class="menu-link">Projects</a>
                    </li>
                  </ul>
                  <!-- /child menu -->
                </li>
               
              </ul>
              <!-- /.menu -->
            </nav>
            <!-- /.stacked-menu -->
          </section>
          <!-- /.aside-menu -->
        </div>
        <!-- /.aside-content -->
      </aside>
      <!-- /.app-aside -->