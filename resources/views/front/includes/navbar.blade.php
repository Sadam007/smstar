<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <div class="container">
   <a class="navbar-brand" href="/">Exam Portal</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('homepage') }}">Home <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('users') }}">Users <span class="sr-only">(current)</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('teacher.create') }}" tabindex="-1">Teachers Registration</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('student.create') }}" tabindex="-1">Student Registration</a>
      </li>
      
       <li class="nav-item">
        <a class="nav-link" href="{{ route('specialuser.login') }}">Special Login</a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">News</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('clerk.login') }}">Clerk Login</a>
      </li> -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          College Menu
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('specialuser.login') }}">College Admin Login</a>
          <a class="dropdown-item" href="{{ route('degadmin.login') }}">College Degree Admin Login</a>
          <a class="dropdown-item" href="{{ route('teacher.create') }}">Teachers Registration</a>
          <a class="dropdown-item" href="{{ route('teacher.create') }}">Teachers Login</a>
          <a class="dropdown-item" href="{{ route('student.create') }}">Students Registration</a>
          <a class="dropdown-item" href="{{ route('login.student') }}">Students Login</a>
          <a class="dropdown-item" href="{{ route('clerk.login') }}">Clerk Login</a>
          
        </div>
      </li> -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Exams Links
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('secrecyuser.login') }}">Secrecy Login</a>
        </div>
      </li> -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
      </li>   -->
        {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('login') }}">Login</a>
        <a class="dropdown-item" href="{{ route('register') }}">Register</a>
        </div> --}}
        <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Admin Login</a>
      </li>
      </li>
    </ul>
  </div>
</div>
</nav>
<div class="clearfix"></div>
<div class="spacer"></div>        