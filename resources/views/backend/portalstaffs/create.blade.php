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

.optional{
  color: #999;
  font-weight: bold;
}
.frmt-txt,.frmt-txt:hover{
  color: #E0055D;
  font-size: 13px;
  text-decoration: none !important;
  cursor: pointer;
}
.custom-title{
  font-size: 16px;
  text-align: left;
  color: #063;
  font-weight: bold;
}
.cus-label{
  font-weight: bold;
}

.heading-h3{
  font-size: 16px;
  text-transform: capitalize;
  color: #063;
  letter-spacing: .5px;
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
   <form  id="addPortalStaffForm" action = "{{ route('proces.portal-staff') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    {{ csrf_field() }}
    <fieldset>
     <legend>Portal Staff Management Area</legend>
     <div class="form-group">
      <label class="col-form-label" for="staff_title">Staff Title</label>
      <input type="text" name="staff_title" class="form-control staff_title placeholder-shown" placeholder="Staff Title (like Mr)" id="staff_title" value="{{ old('staff_title') }}"> 
      </div>

      <div class="form-group">
      <label class="col-form-label" for="staff_name">Staff Name</label>
      <input type="text" name="staff_name" class="form-control staff_name placeholder-shown" placeholder="Staff Name" id="staff_name" value="{{ old('staff_name') }}"> 
      </div>
      <div class="form-group">
      <label class="col-form-label" for="staff_email">Staff Email</label>
      <input type="email" name="staff_email" class="form-control staff_email placeholder-shown" placeholder="Staff Name" id="staff_email" value="{{ old('staff_email') }}"> 
      </div>
      <div class="form-group">
      <label class="col-form-label" for="staff_designation">Staff Designation</label>
      <input type="text" name="staff_designation" class="form-control staff_designation placeholder-shown" placeholder="Staff Designation" id="staff_designation" value="{{ old('staff_designation') }}"> 
      </div>
      <div class="form-group">
        <label class="col-form-label" for="staff_message">Message</label>
        <textarea  name="staff_message" class="form-control staff_message placeholder-shown" id="staff_message">{{old('staff_message')}}</textarea>
      </div>
      
      <div class="form-group">
        <label for="avatar">Profile Photo</label>
        <div class="custom-file">
          <input type="file" name="avatar" class="custom-file-input" id="avatar">
          <label class="custom-file-label" for="avatar">Choose file</label>
        </div>
      </div>
      <div class="form-group">
      <div class="list-group-item d-flex justify-content-between align-items-center">
        <span style="margin-left: -15px;">Portal Staff Status</span>
        <label class="switcher-control" style="margin-right: -12px;">
          <input type="checkbox" name="is_active" class="switcher-input" checked="checked">
          <span class="switcher-indicator"></span>
        </label>
      </div>
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

<section class="card card-fluid" id="table-show">
  <header class="card-header">
   <legend>All Portal Staff</legend>
</header>
<div class="card-body">
   <div class="form-group">
    <div class="input-group input-group-alt">
     <div class="input-group-prepend">
      <select class="custom-select">
       <option selected> Filter By </option>
       <option value="1"> Tags </option>
       <option value="2"> Vendor </option>
       <option value="3"> Variants </option>
       <option value="4"> Prices </option>
       <option value="5"> Sales </option>
   </select>
</div>   
<div class="input-group">
  <div class="input-group-prepend">
   <span class="input-group-text">
    <span class="oi oi-magnifying-glass"></span>
</span>
</div>
<input type="text" class="form-control" placeholder="Search record"> 
</div>
</div>
</div>

@if(count($portalUsers) > 0)
<div class="text-muted"> Showing {{ $portalUsers->firstItem() }} to {{ $portalUsers->lastItem() }}  of {{$portalUsers->total()}}  entries </div>
<div class="table-responsive" id="tblNews">
    <table class="table">
      <thead>
        <tr>
          <th colspan="2" style="min-width:100px">
            <div class="thead-dd dropdown">
              <span class="custom-control custom-control-nolabel custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="check-handle">
                <label class="custom-control-label" for="check-handle"></label>
              </span>
              <div class="thead-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
              </div>
              <span style="margin-left: 10px;">Added By</span>
              <div class="dropdown-arrow"></div>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Select all</a>
                <a class="dropdown-item" href="#">Unselect all</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Bulk remove</a>
                <a class="dropdown-item" href="#">Bulk edit</a>
                <a class="dropdown-item" href="#">Separate actions</a>
              </div>
            </div>
          </th>
          <th> Name</th>
          <th> Details</th>
          <th class="align-middle text-center"> Action </th>
        </tr>
      </thead>
      <tbody>
        @foreach($portalUsers as $user)
          <tr>
             <td class="align-middle col-checker">
                <div class="custom-control custom-control-nolabel custom-checkbox">
                   <input type="checkbox" class="custom-control-input" name="selectedRow[]" id="p3">
                   <label class="custom-control-label" for="p3"></label>
                </div>
             </td>
             
            <td class="align-middle">
              <a href="#" style="margin-left: 10px;">{{ $user->addedby}}</a>
            </td>
             <td class="text-justify">
                <a href="{{ route('show.portal-staff',['id'=>$user->pstaff_id]) }}">
                  {{ $value = $user->title ." " . $user->name }} </a>
             </td>
        

             <td><a href="{{ route('show.portal-staff',['id'=>$user->pstaff_id]) }}" class="frmt-txt">Read More</a></td>

             <td class="align-middle text-right">

                <label class="switcher-control">
                <input type="checkbox" name="is_active" class="switcher-input is_active_switcher" {{ $user->is_active == 1 ? 'checked' : '' }} data-id="{{ $user->pstaff_id }}" value="{{ $user->is_active }}">
                  <span class="switcher-indicator"></span>
                </label>

                <button type="button" href="#edit<?php echo $user->pstaff_id;?>" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#edit<?php echo $user->pstaff_id;?>">
                   <i class="fa fa-pencil-alt"></i>
                   <span class="sr-only">Edit</span>
                </button>
                <button type="button" href="#delete<?php echo $user->pstaff_id;?>" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#delete<?php echo $user->pstaff_id;?>">
                   <i class="far fa-trash-alt"></i>
                   <span class="sr-only">Remove</span>
                </button>
             </td>
          </tr>
          @include('backend.includes.modals.edit-portal-staff-modal')  
          @include('backend.includes.modals.delete-portal-staff-modal') 
          
          
        @endforeach
      </tbody>       
    </table>
    <div class="text-muted"> Showing {{ $portalUsers->firstItem() }} to {{ $portalUsers->lastItem() }}  of {{$portalUsers->total()}}  entries </div>
</div>
  @else 
  <div class="table-responsive">
    
    <table class="table">
      <tbody>
        <tr>
          <td colspan="6">No data found</td>
        </tr>
      </tbody>
    </table>
  </div>
@endif

<ul class="pagination justify-content-center mt-4">
 <li class="page-item">
   {{ $portalUsers->links() }}
</li>             
</ul>
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
<script src="{{asset('backend/js/jquery.validate.js')}}"></script>
<script src="{{asset('backend/js/additional-methods.js')}}"></script>
<script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/js/table-demo.js')}}"></script>
<script src="{{asset('backend/js/axios.min.js')}}"></script>
<script src="{{asset('backend/js/toastr.min.js')}}"></script>
@endsection
@section('custom-js')
<script>
 @if (Session::has('success'))
    toastr.success("{{Session::get('success')}}")
 @endif

  @if (Session::has('error'))
    toastr.warning("{{Session::get('success')}}")
 @endif 
 var base_url  = '{{ URL::to("/") }}/';

 $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
  }, function(size){
    return "MAX SIZE " + filesize(size,{exponent:2,round:1});
  });
 
 $(document).ready(function() {
   $('#BtnSubmit').on('click',function(){
      $("form#addPortalStaffForm").validate({
         errorElement:'span',
         errorClass:'help-block pull-left err',
         ignore:":hidden:not(select)",
         debug:true,
         rules:{
            staff_title:{
               required:true,
            },
            staff_name:{
              required:true,
            },
            staff_designation:{
              required:true,
            }
         },
         highlight:function(element){
            $(element).closest('.form-group').addClass('has-error');
         },
         success:function(label){
            label.closest('.form-group').removeClass('has-error');label.remove();
         },
         invalidHandler:function(form,validator){
            if(!validator.numberOfInvalids())return;
         },messages:{
            
         },
         submitHandler:function(form,e){
          
          $("#addPortalStaffForm")[0].submit();
      }
   });
   });

   $(".is_active_switcher").on('change', function(event) {
     event.preventDefault();
    
    var switchId = $(this).data("id");
    var switchVal = $(this).val();


    var cur_url="<?php echo route('add.portal-staff');?>";
    var url="<?php echo route('portalstaff.status');?>";

    axios({
      method: 'POST',
      url: url,
      data: {
          switchId: switchId,
          switchVal: switchVal,
      }
    })
    .then(function(res){
      var good  = res.data[0].Good;
      var msg   = res.data[0].message;
      setTimeout(()=>{toastr.success(msg);
      },1000);
      $('body').load(document.URL+'#tblNews');

    })


   });
 });
</script>
@endsection
