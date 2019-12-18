@extends('layouts.student')

@section('page-title')
<title> Exam Portal | Student Management | Update Profile </title>
@endsection

@section('theme-css-plugins')
<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
@endsection

@section('custom-css')

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
       <a href="{{route('stddashboard')}}">
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
   <form  id="studentProfileForm" autocomplete="off" method="POST">
    {{ csrf_field() }}
    <fieldset>
     <legend>Update Profile</legend>

    <div class="form-group">
      <label for="tf2">Name </label>
      <input type="text" class="form-control" name="studentName" value="{{ $student->stdName }}" id="studentName" required disabled>
    </div>

    <div class="form-group">
      <label class="control-label" for="studentMobile">Mobile #</label>
      <input id="studentMobile" type="email" name="studentMobile" value="{{ $student->contact }}" class="form-control" required disabled>
    </div>

    <div class="form-group">
      <label class="control-label" for="studentPassword">Current Password</label>
      <input id="studentPassword" type="password" name="studentPassword" class="form-control" required>
    </div>

    <div class="form-group">
      <label class="control-label" for="studentNewPassword">New Password</label>
      <input id="studentNewPassword" type="password" name="studentNewPassword" class="form-control" required>
    </div>

    <div class="form-group">
      <label class="control-label" for="studentConfirmNewPassword">Confirm New Password</label>
      <input id="studentConfirmNewPassword" type="password" name="studentConfirmNewPassword" class="form-control" required>
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
   <a href="{{ route('stddashboard') }}" class="nav-link smooth-scroll">Dashboard</a>
   <a href="{{ route('student.logout') }}" class="nav-link smooth-scroll">Logout</a>
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
      $("form#studentProfileForm").validate({
         errorElement:'span',
         errorClass:'help-block pull-left err',
         ignore:":hidden:not(select)",
         debug:true,
         rules:{
            studentName:{
               required:true,
            },
            studentMobile:{
              required:true,
              minlength:13,
              maxlength:13,
              validMobile: true,
            },
            studentPassword:{
              required:true
            },
            studentNewPassword:{
              required:true,
              minlength : 8,
            },
            studentConfirmNewPassword:{
              required:true,
              minlength:8,
              equalTo:"#studentNewPassword"
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
            var url="<?php echo route('student.profile-update');?>";
            var cur_url="<?php echo route('student.profile');?>";

            //Grabbing Form Data 
            var studentName         = $('#studentName').val();
            var studentMobile       = $('#studentMobile').val();
            var studentPassword     = $('#studentPassword').val();
            var studentNewPassword  = $('#studentNewPassword').val();

            var data=new FormData();

            data.set('studentName', studentName);
            data.set('studentMobile', studentMobile);
            data.set('studentPassword', studentPassword);
            data.set('studentNewPassword', studentNewPassword);

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
