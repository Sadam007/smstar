@extends('layouts.app')

@section('page-title')
<title> Exam Portal | Portal Staff Management | Add Staff</title>
@endsection

@section('theme-css-plugins')
<link href="{{asset('backend/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
@endsection
@section('custom-css')
<style>
/* ==== Custom Styles Area ====*/

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
    
    <fieldset>
      <legend>Portal Staff Details</legend>

      @if(count($staffdetails) > 0)
        <div class="table-responsive">
          <table class="table table-bordered">
        
              <tr>
                <th width="20%">Name</th>
                <td>{{ $staffdetails[0]->title." ". $staffdetails[0]->name }}</td>
              </tr>
              <tr>
                <th width="20%">Email</th>
                <td>{{ $staffdetails[0]->email }}</td>
              </tr>
              <tr>
                <th width="20%">Designation</th>
                <td>{{ $staffdetails[0]->designation }}</td>
              </tr>
              <tr>
                <th width="20%">Profile</th>
                <td><img src="{{ $staffdetails[0]->avatar }}" alt="Profile image" style="width: 70px;height: 70px;border-radius: 50%;"></td>
              </tr>
              <tr>
                <th width="20%">Status</th>
                <td>
                  @php
                     $status =  $staffdetails[0]->is_active;
                  @endphp
                  <label class="switcher-control">
                  <input type="checkbox" class="switcher-input is_archieve_switcher" {{ $status == 1 ? 'checked' : '' }} >
                  <span class="switcher-indicator"></span>
                </label>
                </td>
              </tr>
          </table>
        </div>
        @else
          <p style="color: red;">No Data Found</p>
      @endif
    </fieldset>
    <a href="{{ route('add.portal-staff') }}#table-show" class="btn btn-outline-success btn-sm float-right">back</a>
  </div>
</section>

</div>
<div class="page-sidebar page-sidebar-fixed">
  <p><br></p>
  <h3 class="page-title" style="font-size: 20px;margin-bottom:-20px;margin-top: 30px;margin-left: 12px;"> Relevant Links </h3>
  <nav id="nav-content" class="nav flex-column mt-4">
   <a href="{{ route('add.portal-staff') }}" class="nav-link smooth-scroll">Add Portal Staff</a>
   <a href="#table-show" class="nav-link smooth-scroll">All Portal Staff</a>
</nav>
</div>
</div>
</div>
</div>

@endsection
@section('page-js-plugins')

@endsection
@section('custom-js')
<script>
 $('input[type="checkbox"]').on('click', function(event) {
    event.preventDefault();
    event.stopPropagation();
    return false;
});
</script>
@endsection
