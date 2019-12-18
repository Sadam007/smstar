@extends('layouts.teacher')

@section('page-title')
<title> Exam Portal | Teacher Management | Update Profile </title>
@endsection

@section('theme-css-plugins')
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
       <a href="{{route('tdashboard')}}">
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
      <input type="text" class="form-control" name="teacherName" value="{{ $teacher->name }}" id="teacherName" required disabled>
    </div>

    <div class="form-group">
      <label class="control-label" for="teacherMobile">Mobile #</label>
      <input id="teacherMobile" type="email" name="teacherMobile" value="{{ $teacher->mobile }}" class="form-control" required disabled>
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
   <a href="{{ route('tdashboard') }}" class="nav-link smooth-scroll">Dashboard</a>
   <a href="{{ route('teacher.logout') }}" class="nav-link smooth-scroll">Logout</a>
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
<script src="{{asset('backend/js/toastr.min.js')}}"></script>
@endsection
@section('custom-js')
  <script>
  /* ==== Custom Scripts Area ====*/

  jQuery.validator.addMethod("validMobile", function(value,element) {
            return this.optional(element) ||  /^[0]?[789]\d{11}$/.test(value);
    }, "Please enter your mobile with country code and without dashes");

  var base_url  = '{{ URL::to("/") }}/';
 $('#BtnUpdate').on('click',function(){
      $("form#teacherProfileForm").validate({
         errorElement:'span',
         errorClass:'help-block pull-left err',
         ignore:":hidden:not(select)",
         debug:true,
         rules:{
            teacherName:{
               required:true,
            },
            teacherMobile:{
              required:true,
              minlength:13,
              maxlength:13,
              validMobile: true,
            },
            teacherPassword:{
              required:true
            },
            teacherNewPassword:{
              required:true,
              minlength : 8,
            },
            teacherConfirmNewPassword:{
              required:true,
              minlength:8,
              equalTo:"#teacherNewPassword"
            }
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
         messages:{
            
         },
         submitHandler:function(form,e){
            var btn=document.querySelector("#BtnUpdate");
            btn.style.display="none";var img=document.createElement("img");
            img.setAttribute("src",base_url+'front/images/loading.gif');
            var loader=document.querySelector("#loader");loader.appendChild(img);
            var url="<?php echo route('teacher.profile-update');?>";
            var cur_url="<?php echo route('teacher.profile');?>";

            //Grabbing Form Data 
            var teacherName         = $('#teacherName').val();
            var teacherMobile        = $('#teacherMobile').val();
            var teacherPassword     = $('#teacherPassword').val();
            var teacherNewPassword  = $('#teacherNewPassword').val();

            var data=new FormData();

            data.set('teacherName', teacherName);
            data.set('teacherMobile', teacherMobile);
            data.set('teacherPassword', teacherPassword);
            data.set('teacherNewPassword', teacherNewPassword);

            axios({
                method: 'POST',
                url: url,
                data: data
            })

            .then(function(res){
                var tos=res.data[0].message;
            var good=res.data[0].Good;
              if(good==true){
                setTimeout(()=>{toastr.success(tos);
                  },1000);
                  $('body').load(document.URL);    
                }
            })
          
            
           e.preventDefault();
      }
   });
   });

	</script>
@endsection
