@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | Degree Admin Login Area</title>
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
</style>
@endsection



@section('main')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"><span style="font-size: 18px; font-weight: bold;">Degree Admin Login Area</span> <i class="fa fa-user fa-lg float-right" aria-hidden="true"></i></div>

				<div class="card-body">
					<form method="POST" action="{{ route('degadmin.login') }}">
						@csrf
						<div class="form-group">
							<label for="username">Username</label>
								<input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

								@if ($errors->has('username'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('username') }}</strong>
								</span>
								@endif
						</div>

						<div class="form-group">
							<label for="password">Password</label>

							
								<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

								@if ($errors->has('password'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
								@endif
						</div>

						<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
									</label>
								</div>
						</div>

						<div class="form-group">
								<button type="submit" class="btn btn-primary">
									Login
								</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('page-js-plugins')
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

</script>
@endsection