@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | Students Login</title>
@endsection

@section('page-css-plugins')
<link rel="stylesheet" href="{{ asset('backend/css/fontawesome-all.min.css') }}">
<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">

@endsection
@section('custom-css')
<style>
	/* ==== Custom Styles Area ====*/
	.card{
		min-height: auto;
	}
	.err{
		color: red;
		font-weight: bold;
		font-size: 15px;
	}
	.has-error{
		color: red;
		font-weight: bold;
		font-size: 15px;
	}
</style>
@endsection

@section('main')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"><span style="font-size: 18px; font-weight: bold;">Students Sign In Form</span> <i class="fa fa-user fa-lg float-right" aria-hidden="true"></i></div>

				<div class="card-body">
					<form id="StudentsSignInForm" autocomplete="off" method="POST" action="{{ route('student.login') }}">
						@csrf
						<div class="form-group">
							<label for="regno">Registration No</label>
							<input id="regno" type="text" class="form-control{{ $errors->has('regno') ? ' is-invalid' : '' }}" name="regno" value="{{ old('regno') }}" required>

							@if ($errors->has('regno'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('regno') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<label for="lpassword">Password</label>
							<input id="lpassword" type="password" class="form-control{{ $errors->has('lpassword') ? ' is-invalid' : '' }}" name="lpassword" required>

							@if ($errors->has('lpassword'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('lpassword') }}</strong>
							</span>
							@endif
						</div>

						<div class="form-group">

							<div class="checkbox">
								<label>
									<input type="checkbox" name="lremember" {{ old('lremember') ? 'checked' : '' }}> 
									Remember Me
								</label>
							</div>

						</div>

						<div class="form-group">

							<button type="submit" id="BtnStudentSignIn" class="btn btn-primary">
								Login
							</button>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="mg-top">&nbsp;</div>
@endsection


@section('page-js-plugins')
<script src="{{asset('backend/js/jquery.validate.js')}}"></script>
<script src="{{asset('backend/js/toastr.min.js')}}"></script>
@endsection
@section('custom-js')
<script>
	/* ==== Custom Scripts Area ====*/
	@if (Session::has('success'))
	toastr.success("{{Session::get('success')}}")
	@endif

	@if (Session::has('warning'))
	toastr.error("{{Session::get('warning')}}")
	@endif    
	jQuery.validator.addMethod("validMobile", function(value,element) {
            return this.optional(element) ||  /^[0]?[789]\d{11}$/.test(value);
    }, "Please enter your mobile with country code and without dashes");
	$('#BtnStudentSignIn').on('click',function(){
      $("form#StudentsSignInForm").validate({
         errorElement:'span',
         errorClass:'help-block pull-left err',
         ignore:":hidden:not(select)",
         debug:true,
         rules:{
             regno:{
              required:true,
              number:true,
              //minlength:13,
              //maxlength:13,
              // validMobile: true,
            },
            lpassword:{
              required:true,
              minlength:8
            },
        
         },
         highlight:function(element){
            $(element).closest('.form-control').addClass('has-error');
         },

         success:function(label){
            label.closest('.form-control').removeClass('has-error');label.remove();
         },
         invalidHandler:function(form,validator){
            if(!validator.numberOfInvalids())return;
         },
         errorPlacement: function (error, element) {
        if (element.parent('.form-group').length) {
            error.insertAfter(element.parent());
        } else if (element.hasClass('select2')) {
            error.insertAfter(element.next('span'));
        } else {
            error.insertAfter(element);
        }
    },
          messages: {
            
          },
         submitHandler:function(form, e){
           
            $('#StudentsSignInForm')[0].submit(); 
           
         //e.preventDefault();

      }
   });
   });
</script>
@endsection