@extends('layouts.app')

@section('page-title')
<title> Exam Portal | Sessions Management | Add Single Session</title>
@endsection

@section('theme-css-plugins')
<link href="{{asset('backend/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/flatpickr.min.css')}}" rel="stylesheet">
@endsection
@section('custom-css')
<style>
/* ==== Custom Styles Area ====*/
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
/*.modal-dialog {
   -webkit-transform: translate(0,-50%);
   -o-transform: translate(0,-50%);
   transform: translate(0,-50%);
   top: 30%;
   margin: 0 auto;
   }*/
</style>
@endsection

@section('main')
<div class="wrapper">
 <div class="page has-sidebar">
  <div class="page-inner" id="page-inner">
   <header class="page-title-bar">
    <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
      <li class="breadcrumb-item active">
       <a href="{{route('dashboard')}}">
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
   <form  id="uploadCsvForm" autocomplete="off" method="POST">
    {{ csrf_field() }}
    <fieldset>
     <legend>Session Management Area</legend>

    <div class="form-group">
      <label for="tf2">Session </label>
      <input type="text" class="form-control" name="sessionFormat" id="tf2" placeholder="Format : 2012-2016" required>
    </div>

    <div class="form-group">
      <label for="sel1">Session Years</label>
      <select class="custom-select" name="sessYears" id="sel1" required>
        <option value=""> select an option </option>
        <option value="1"> 1</option>
        <option value="2"> 2</option>
        <option value="3"> 3</option>
        <option value="4"> 4</option>
        <option value="5"> 5</option>
      </select>
    </div>
    <div class="form-group">
      <label class="control-label" for="flatpickr01">Start Date</label>
      <input id="flatpickr01" type="text" name="startDate" class="form-control">
    </div>

    <div class="form-group">
      <label class="control-label" for="flatpickr02">End Date</label>
      <input id="flatpickr02" type="text" name="endDate" class="form-control">
    </div>
     
    <div class="form-group btn-toggle">
      <button type="submit" id="BtnSubmit" class="btn btn-primary">Submit</button>
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
   <a href="{{ route('singleSession') }}" class="nav-link smooth-scroll">Add New Session</a>
   <a href="{{ route('sessioncsv') }}" class="nav-link smooth-scroll">All Sessions</a>
</nav>
</div>
</div>
</div>
</div>

@endsection
@section('page-js-plugins')
<script src="{{asset('backend/js/jquery.validate.js')}}"></script>
<script src="{{asset('backend/js/additional-methods.js')}}"></script>
<script src="{{asset('backend/js/toastr.min.js')}}"></script>
<script src="{{asset('backend/js/flatpickr.min.js')}}"></script>
@endsection
@section('custom-js')
<script>
  $(document).ready(function() {
    

    flatpickr('#flatpickr01', {
      dateFormat: 'd/m/Y'
    });

    flatpickr('#flatpickr02', {
      dateFormat: 'd/m/Y'
    });

  });
</script>
@endsection