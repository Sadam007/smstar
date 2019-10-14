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
                <span class="account-name">{{ ucwords(Auth::user()->name) }}</span>
                <span class="account-description">Administrator</span>
              </span>
            </button>
            <!-- /.btn-account -->
            <!-- .dropdown-aside -->
            <div id="dropdown-aside" class="dropdown-aside collapse">
              <!-- dropdown-items -->
              <div class="pb-3">
                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                  <span class="dropdown-icon oi oi-person"></span> Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"><span class="dropdown-icon oi oi-account-logout"></span>  {{ __('Logout') }}</a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                <!-- <div class="dropdown-divider"></div> -->
          
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
                  <a href="{{ route('dashboard') }}" class="menu-link">
                    <span class="menu-icon oi oi-dashboard"></span>
                    <span class="menu-text">Dashboard</span>
                  </a>
                </li>
                <!-- /.menu-item -->
                <!-- .menu-item -->
                
                <!-- .menu-header -->
                <li class="menu-header">Student Management </li>
                <!-- /.menu-header -->
                <!-- .menu-item -->
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-clock"></span>
                    <span class="menu-text">Sessions Management</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="{{ route('sessioncsv') }}" class="menu-link">Add Session</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('sessioncsv') }}" class="menu-link">All Sessions</a>
                    </li>
                  </ul>
                  <!-- /child menu -->
                </li>
                <!-- /.menu-item -->
                <!-- .menu-item -->
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-basket"></span>
                    <span class="menu-text">Colleges Management</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="{{ route('collegecsv') }}" class="menu-link">Add College</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('collegecsv') }}" class="menu-link">All Colleges</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('degreescsv') }}" class="menu-link">Degrees in Colleges</a>
                    </li>
                  </ul>
                  <!-- /child menu -->
                </li>
                <!-- /.menu-item -->
                <!-- .menu-item -->
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-book"></span>
                    <span class="menu-text">Degrees Management</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="{{ route('degreecsv') }}" class="menu-link">Add Degrees</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('degreecsv') }}" class="menu-link">All Degrees</a>
                    </li>
                  </ul>
                  <!-- /child menu -->
                </li>
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-book"></span>
                    <span class="menu-text">Subjects Management</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="{{ route('subjectcsv') }}" class="menu-link">Add Subjects</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('subjectcsv') }}" class="menu-link">All Subjects</a>
                    </li>
                  </ul>
                  <!-- /child menu -->
                </li>
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-clock"></span>
                    <span class="menu-text">Exams Management</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="{{ route('examcsv') }}" class="menu-link">Add exams</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('centrecsv') }}" class="menu-link">Add Centre</a>
                    </li>
                  </ul>
                  <!-- /child menu -->
                </li>
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-people"></span>
                    <span class="menu-text">Student Management</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="{{ route('district.create') }}" class="menu-link">Add District</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('certificate.create') }}" class="menu-link">Add Certificate</a>
                    </li>
                  </ul>
                  <!-- /child menu -->
                </li>

                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-list-rich"></span>
                    <span class="menu-text">Secrecy Management</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="{{ route('secrecyuser.create') }}" class="menu-link">Add User</a>
                    </li>
                   
                  </ul>
                  <!-- /child menu -->
                </li>

                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-share"></span>
                    <span class="menu-text">Exports Management</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="{{ route('export.students') }}" class="menu-link">Export Students</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('export.rollno') }}" class="menu-link">Export Roll Nos</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('export.rollno-comdets') }}" class="menu-link">Export Roll No Com Details</a>
                    </li>
                  
                  </ul>
                  <!-- /child menu -->
                </li>
                <li class="menu-item has-child">
                  <a href="#" class="menu-link">
                    <span class="menu-icon oi oi-transfer"></span>
                    <span class="menu-text">DB Synchronization</span>
                  </a>
                  <!-- child menu -->
                  <ul class="menu">
                    <li class="menu-item">
                      <a href="{{ route('database.import-txt') }}" class="menu-link">Import Txt</a>
                    </li>
                    <li class="menu-item">
                      <a href="{{ route('database.export-txt') }}" class="menu-link">Export Txt</a>
                    </li>
                    
                  </ul>
                  <!-- /child menu -->
                </li>
                <!-- /.menu-item -->
                <!-- .menu-item -->
              
                <li class="menu-header">General Settings </li>
                <!-- /.menu-header -->
                <!-- .menu-item -->
                
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
                      <a href="{{ route('admin.profile') }}" class="menu-link">Profile</a>
                    </li>
                
                    <li class="menu-item"><a class="menu-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">  {{ __('Logout') }}</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      </li>
                    @csrf
                  </form>
                    </li>
                    
                  </ul>
                  <!-- /child menu -->
                </li>
                <!-- /.menu-item -->
                
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