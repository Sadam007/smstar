@extends('layouts.app')

@section('page-title')
<title> Exam Portal | Student Management | Add District</title>
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
   <form  id="distrctForm" autocomplete="off">
    {{ csrf_field() }}
    <fieldset>
      <legend>District Management Area</legend>
     <div class="form-group">
      <label class="col-form-label" for="district">District Name</label>
      <input type="text" name="district" class="form-control username" placeholder="Enter District Name" id="district"> 
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
  $("form#distrctForm").validate({
   errorElement:'span',
   errorClass:'help-block pull-left err',
   ignore:":hidden:not(select)",
   debug:true,
   rules:{
    district:{
     required:true,
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
},
submitHandler:function(form,e){
  var btn=document.querySelector("#BtnSubmit");
  btn.style.display="none";var img=document.createElement("img");
  img.setAttribute("src",base_url+'front/images/loading.gif');
  var loader=document.querySelector("#loader");loader.appendChild(img);
  var url="<?php echo route('district.process');?>";
  var cur_url="<?php echo route('district.create');?>";
  var district   = document.querySelector("#district").value;

   axios({
        method: 'POST',
        url: url,
        data: {
              district: district,
            }
          })
  .then(function(res){
    var tos=res.data[0].message;
    var good=res.data[0].Good;
    if(good==true){
    setTimeout(()=>{toastr.success(tos);
    },1000);
   img.setAttribute("src","");
   btn.style.display="block";
   loader.style.display="none";
   $('body').load(document.URL+'#distrctForm');
 }
})
.catch(function(err){
  setTimeout(()=>{toastr.warning("District can not be added");
},1000);
  img.setAttribute("src","");
  btn.style.display="block";
  loader.style.display="none";

  $('body').load(document.URL+'#distrctForm')});
e.preventDefault();
}
});
});

</script>
@endsection