@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | Clerks First Login Attempt</title>
@endsection

@section('page-css-plugins')
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
</style>
@endsection



@section('main')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<strong>
						Mr. {{ ucwords($username) }} Please change your password</div>
					</strong>
				<div class="card-body">
					<form method="POST" action="{{ route('clerk.first.login.process') }}"
						id="formClerkFirstLogin">
						@csrf
						
						<div class="form-group row">
							<label for="cpassword" class="col-md-4 col-form-label text-md-right">Current Password</label>

							<div class="col-md-6">
								<input id="cpassword" type="password" class="form-control{{ $errors->has('cpassword') ? ' is-invalid' : '' }}" name="cpassword" required>

								@if ($errors->has('cpassword'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('cpassword') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="npassword" class="col-md-4 col-form-label text-md-right">New Password</label>

							<div class="col-md-6">
								<input id="npassword" type="password" class="form-control{{ $errors->has('npassword') ? ' is-invalid' : '' }}" name="npassword" required>

								@if ($errors->has('npassword'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('npassword') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label for="ncpassword" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

							<div class="col-md-6">
								<input id="ncpassword" type="password" class="form-control{{ $errors->has('ncpassword') ? ' is-invalid' : '' }}" name="ncpassword" required>
								@if ($errors->has('ncpassword'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('ncpassword') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-6 offset-md-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="flremember" {{ old('remember') ? 'checked' : '' }}> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" id="BtnClerkFirstLogin" class="btn btn-primary">
									Change Password
								</button>
							</div>
						</div>

						<input type="hidden" name="clerk_id" value="{{ $clerk_id }}">
						<input type="hidden" name="user_id" value="{{ $user_id }}">
						<input type="hidden" name="department_id" value="{{ $department_id }}">
						<input type="hidden" name="username" value="{{ $username }}">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('page-js-plugins')
	<script src="{{asset('backend/js/jquery.validate.js')}}"></script>
	<script src="{{asset('backend/js/additional-methods.js')}}"></script>
	<script src="{{asset('backend/js/toastr.min.js')}}"></script>

	<script>
		@if (Session::has('warning'))
 			toastr.error("{{Session::get('warning')}}")
 		@endif 
	</script>
@endsection
@section('custom-js')
<script>
	/* ==== Custom Scripts Area ====*/

 @if (Session::has('success'))
 toastr.success("{{Session::get('success')}}")
 @endif 


 $('#BtnClerkFirstLogin').on('click',function(){
  $("form#formClerkFirstLogin").validate({
   errorElement:'span',
   errorClass:'help-block pull-left err',
   ignore:":hidden:not(select)",
   debug:true,
   rules:{
     cpassword:{
            required:true,
            	
     },
     npassword:{
     		required:true,
            minlength : 8,
     },
     ncpassword:{
     		required:true,
            minlength : 8,
            equalTo : "#npassword"
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
  $('#formClerkFirstLogin')[0].submit(); 
//e.preventDefault();
}
});
});

</script>
@endsection