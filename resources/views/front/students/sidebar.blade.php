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
                <span class="account-name">{{ strtoupper(Auth('student')->user()->stdName) }}</span>
                <span class="account-description">Student</span>
              </span>
            </button>
            <!-- /.btn-account -->
            <!-- .dropdown-aside -->
            <div id="dropdown-aside" class="dropdown-aside collapse">
              <!-- dropdown-items -->
              <div class="pb-3">
                <a class="dropdown-item" href="{{ route('student.profile') }}">
                  <span class="dropdown-icon oi oi-person"></span> Profile</a>
                <a class="dropdown-item" href="{{ route('student.logout') }}">
                  <span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
                
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
                  <a href="{{ route('stddashboard') }}" class="menu-link">
                    <span class="menu-icon oi oi-dashboard"></span>
                    <span class="menu-text">Dashboard</span>
                  </a>
                </li>
               
                <li class="menu-header">Examination Links </li>
                <!-- /.menu-header -->
                <!-- .menu-item -->
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-puzzle-piece"></span>
                    <span class="menu-text">Examination</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="{{ route('student.enrolled-exams') }}" class="menu-link">View Datesheet</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('student.dmc') }}" class="menu-link">View DMC</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('student.apply-Rechecking') }}" class="menu-link">Apply for rechecking</a>
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