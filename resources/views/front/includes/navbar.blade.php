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
      <li class="nav-item">
        <a class="nav-link" href="{{ route('all.news') }}">News <i class="fa fa-star blink_me"></i> <span class="sr-only">(current)</span></a>
      </li>
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