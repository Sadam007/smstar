<!DOCTYPE html>
<html lang="en">
<head>

  @include('backend.includes.metas')
  
  @yield('page-title')
  
  <link rel="icon"  href="{{asset('backend/images/favicon.ico')}}">
  <link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">

  @include('backend.includes.theme-css-dependencies')

  @yield('theme-css-plugins')
  
  @yield('custom-css')

  <style>
    .err{
   color: red;
   font-weight: bold;
   font-size: 15px;
  }
  .error{
   color: red;
   font-weight: bold;
   font-size: 15px;
   background: black;
   letter-spacing: .5px;
   padding: 10px;
  }
  .success{
   color:white;
   font-weight: bold;
   font-size: 15px;
   background: #2E5F9B;
   letter-spacing: .5px;
   padding: 10px;
  }

  .card-header legend{
   margin-bottom: 0px !important;
  }
  </style>
  
</head>

<body>
  <!-- .app -->
  <div class="app">

    @include('front.degadmins.navbar')
    
    @include('front.degadmins.sidebar')

    <main class="app-main">
      <div class="wrapper">
 <div class="page has-sidebar">
  <div class="page-inner" id="page-inner">
   <header class="page-title-bar">
    <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
      <li class="breadcrumb-item active">
       <a href="{{route('degAdmindashboard')}}">
        <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Dashboard</a>
    </li>
</ol>
</nav>
</header>
<div class="page-section">
 <div class="d-xl-none">
  <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar">
   <i class="fa fa-th-list"></i>
</button>
</div>

<section id="base-style" class="card">
  <div class="card-body">
   <form  id="teacherProfileForm" autocomplete="off" method="POST">
    {{ csrf_field() }}
    <fieldset>
     <legend>Update Profile</legend>

    <div class="form-group">
      <label for="tf2">Name </label>
      <input type="text" class="form-control" name="teacherName" value="{{ $degadmin->name }}" id="teacherName" required disabled>
    </div>

    <div class="form-group">
      <label class="control-label" for="teacherMobile">Mobile #</label>
      <input id="teacherMobile" type="email" name="teacherMobile" value="{{ $degadmin->mobile }}" class="form-control" required disabled>
    </div>

    <div class="form-group">
      <label class="control-label" for="teacherPassword">Current Password</label>
      <input id="teacherPassword" type="password" name="teacherPassword" class="form-control" required>
    </div>

    <div class="form-group">
      <label class="control-label" for="teacherNewPassword">New Password</label>
      <input id="teacherNewPassword" type="password" name="teacherNewPassword" class="form-control" required>
    </div>

    <div class="form-group">
      <label class="control-label" for="teacherConfirmNewPassword">Confirm New Password</label>
      <input id="teacherConfirmNewPassword" type="password" name="teacherConfirmNewPassword" class="form-control" required>
    </div>
     
    <div class="form-group btn-toggle">
      <button type="submit" id="BtnUpdate" name="BtnUpdate" class="btn btn-primary">Update</button>
    </div>   
</fieldset>
<div id="loader"></div>
</form>
@if (count($errors) > 0)
<div class="text-danger">
    <ul>
     @foreach ($errors->all() as $error)
     <li>{{ $error }}</li>
     @endforeach
 </ul>
</div>
@endif
</div>
</section>


</div>
<div class="page-sidebar page-sidebar-fixed">
  <p><br></p>
  <h3 class="page-title" style="font-size: 20px;margin-bottom:-20px;margin-top: 30px;margin-left: 12px;"> Relevant Links </h3>
  <nav id="nav-content" class="nav flex-column mt-4">
   <a href="{{ route('degAdmindashboard') }}" class="nav-link smooth-scroll">Dashboard</a>
   <a href="{{ route('degAdmin.logout') }}" class="nav-link smooth-scroll">Logout</a>
</nav>
</div>
</div>
</div>
</div>
      

    </main>


@include('backend.includes.theme-js-dependencies')

@yield('page-js-plugins')     
<script src="{{asset('backend/js/jquery.validate.js')}}"></script>
<script src="{{asset('backend/js/additional-methods.js')}}"></script>
<script src="{{asset('backend/js/axios.min.js')}}"></script>
<script src="{{asset('backend/js/toastr.min.js')}}"></script>

      
</body>
</html>
