@extends('layouts.app')

@section('page-title')
<title> Exam Portal | Sessions Management | Add Session</title>
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
.custom-title{
  font-size: 16px;
  text-align: left;
  color: #063;
  font-weight: bold;
}
.custom-title:hover{
  cursor: pointer;
}
.cus-label{
  font-weight: bold;
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
   <form  id="uploadCsvForm" autocomplete="off">
    {{ csrf_field() }}
    <fieldset>
     <legend>Session Management Area</legend>
     <div class="form-group">
      <label>Upload File</label>
      <div class="custom-file">
       <input type="file" name="csv_import" id="csv_import" class="custom-file-input" id="tf3">
       <label class="custom-file-label persist" for="tf3">Choose file</label>
   </div>
</div>
<div class="form-group btn-toggle">
  <button type="submit" id="BtnSubmit" class="btn btn-success">Submit</button>
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
   <legend>All Registered Sessions</legend>
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
<div class="text-muted"> Showing {{ $sessions->firstItem() }} to {{ $sessions->lastItem() }} of {{$sessions->total()}} entries </div>
<div class="table-responsive">
    <table class="table">
     @if(count($sessions) > 0 )
     <thead>
      <tr>
       <th colspan="2" style="min-width:200px">
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
<th> Code </th>
<th> session </th>
<th> status </th>
<th> Action </th>
</tr>
</thead>
<tbody>
  @foreach($sessions as $sess)
  <tr>
   <td class="align-middle col-checker">
    <div class="custom-control custom-control-nolabel custom-checkbox">
     <input type="checkbox" class="custom-control-input" name="selectedRow[]" id="p3">
     <label class="custom-control-label" for="p3"></label>
 </div>
</td>
<td>        
    <a href="#" style="margin-left: 10px;">{{ $sess->addedby}}</a>
</td>
<td class="align-middle"> {{ $sess->sessionCode}} </td>
<td class="align-middle"> {{ $sess->session}} </td>
<td class="align-middle"> 
    @php
        $status = $sess->status;
    @endphp
    
   <div class="form-group">
      <div class="list-group-item d-flex justify-content-between align-items-center">
        <label class="switcher-control">
          <input type="checkbox" name="is_active" class="switcher-input is_active_switcher" {{ $status == 1 ? 'checked' : '' }} data-id="{{ $sess->id }}" value="{{ $status }}">
          <span class="switcher-indicator"></span>
        </label>
      </div>
    </div> 

</td>
<td class="align-middle">
    <button type="button" href="#edit<?php echo $sess->id;?>" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#edit<?php echo $sess->id;?>">
     <i class="fa fa-pencil-alt"></i>
     <span class="sr-only">Edit</span>
 </button>
 <button type="button" href="#delete<?php echo $sess->id;?>" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#delete<?php echo $sess->id;?>">
     <i class="far fa-trash-alt"></i>
     <span class="sr-only">Remove</span>
 </button>
</td>
</tr>
  @include('backend.includes.modals.edit-session-modal')  
  @include('backend.includes.modals.delete-session-modal')
@endforeach
@else
<td>No Data Found</td> 
@endif
</tbody>       
</table>
</div>
<ul class="pagination justify-content-center mt-4">
 <li class="page-item">
  {{ $sessions->links() }}
</li>             
</ul>
</div>
</section>
</div>
<div class="page-sidebar page-sidebar-fixed">
  <p><br></p>
  <h3 class="page-title" style="font-size: 20px;margin-bottom:-20px;margin-top: 30px;margin-left: 12px;"> Relevant Links </h3>
  <nav id="nav-content" class="nav flex-column mt-4">
   <a href="{{ route('singleSession') }}" class="nav-link smooth-scroll">Add New Session</a>
   <a href="#base-style" class="nav-link smooth-scroll">Add Sessions</a>
   <a href="#table-show" class="nav-link smooth-scroll">All Sessions</a>
</nav>
</div>
</div>
</div>
</div>

@endsection
@section('page-js-plugins')
<script src="{{asset('backend/js/jquery.validate.js')}}"></script>
<script src="{{asset('backend/js/additional-methods.js')}}"></script>
<script src="{{asset('backend/js/axios.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/js/table-demo.js')}}"></script>
<script src="{{asset('backend/js/toastr.min.js')}}"></script>
@endsection
@section('custom-js')
<script>
 @if (Session::has('success'))
 toastr.success("{{Session::get('success')}}")
 @endif 
 var base_url  = '{{ URL::to("/") }}/';
 $('#BtnSubmit').on('click',function(){
  $("form#uploadCsvForm").validate({
   errorElement:'span',
   errorClass:'help-block pull-left err',
   ignore:":hidden:not(select)",
   debug:true,
   rules:{
    csv_import:{
     required:true,extension:"csv",
 },
},
highlight:function(element){
    $(element).closest('.custom-file').addClass('has-error');
},
success:function(label){
    label.closest('.custom-file').removeClass('has-error');label.remove();
},
invalidHandler:function(form,validator){
    if(!validator.numberOfInvalids())return;
},messages:{
    csv_import:{
     required:"This field is required",
     extension:"File type must be (*.csv)"
 }
},
submitHandler:function(form,e){
    var btn=document.querySelector("#BtnSubmit");
    btn.style.display="none";var img=document.createElement("img");
    img.setAttribute("src",base_url+'front/images/loading.gif');
    var loader=document.querySelector("#loader");loader.appendChild(img);
    var url="<?php echo route('sessioncsvprocess');?>";
    var cur_url="<?php echo route('sessioncsv');?>";
    var data=new FormData();
    data.append('csv_import',document.getElementById('csv_import').files[0]);
    var config={onUploadProgress:function(progressEvent){
     var percentCompleted=Math.round((progressEvent.loaded*100)/ progressEvent.total);
 },
};
axios.post(url,data)
.then(function(res){
    var tos=res.data[0].message;
    var good=res.data[0].Good;
    if(good==true){
     setTimeout(()=>{toastr.success(tos);
     },1000);
     img.setAttribute("src","");
     btn.style.display="block";
     loader.style.display="none";
     $(".custom-file-label").html('');
     $(".custom-file-label").html('Choose file');
     $('body').load(document.URL+'#uploadCsvForm');
 }
})
.catch(function(err){
    setTimeout(()=>{toastr.warning("CSV File Internal data format is not matched");
},1000);
    img.setAttribute("src","");
    btn.style.display="block";
    loader.style.display="none";
    $(".custom-file-label").html('');
    $(".custom-file-label").html('Choose file');
    $('body').load(document.URL+'#uploadCsvForm')});
e.preventDefault();
}
});
});

$(".is_active_switcher").on('change', function(event) {
     event.preventDefault();
    
    var switchId = $(this).data("id");
    var switchVal = $(this).val();


    var cur_url="<?php echo route('sessioncsv');?>";
    var url="<?php echo route('session.status');?>";

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



</script>
@endsection