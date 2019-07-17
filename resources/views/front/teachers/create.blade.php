@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | Teachers Registration</title>
@endsection

@section('page-css-plugins')
   <link rel="stylesheet" href="{{ asset('backend/css/fontawesome-all.min.css') }}">
   <link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
   <link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
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
#BtnTeacherSignUp{
	display: block;
	margin-top: 5px;
}	
span.select2-selection.select2-selection--single {
        outline: none !important;
        border: 1px solid #ddd !important;
    }
#select2-department-container{
	background: #fff !important;
	height: 38px !important;
	border-radius: .25rem !important;
	border: 1px solid #ddd !important;
}

</style>
@endsection

@section('main')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><span style="font-size: 18px; font-weight: bold;">Teachers Sign Up Form</span> <i class="fa fa-pencil-alt fa-lg float-right"></i></div>

				<div class="card-body">
					<form id="TeachersSignUpForm" action="{{ route('register.teacher') }}" method="POST" autocomplete="off">
            @csrf
						<div class="form-group">
                              <label for="department">College / Department</label>
                              <select name="department" class="custom-select department" id="department" required="">
                                <option value=""></option>
                                @if(count($colleges) > 0 )
                                    @foreach($colleges as $college)
                                      <option class="cus-opt" value="{{ $college->id }}"> {{ $college->name }} </option>
                                    @endforeach
                                @endif
                              </select>
                           </div>
						
						<div class="form-group">
							<label>Full Name</label>
							<input type="text" class="form-control"  id="fullname" name="fullname"  placeholder="Enter Full Name"  required>
						</div>
						<div class="form-group">
							<label>Mobile No</label>
							<input type="text" class="form-control"  id="mobile" name="mobile" placeholder="Enter Mobile Number"  required>
						</div>

						<div class="form-group">
							<label>Password:</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password"  required>
						</div>
						<div class="form-group">
							<label>Confirm Password:</label>
							<input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter Confirm Password"  required>
						</div>
						
						<button type="submit" id="BtnTeacherSignUp" class="btn btn-primary">Sign Up</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header"><span style="font-size: 18px; font-weight: bold;">Teachers Sign In Form</span> <i class="fa fa-user fa-lg float-right" aria-hidden="true"></i></div>

				<div class="card-body">
					<form id="TeachersSignInForm" autocomplete="off" method="POST" action="{{ route('teacher.login') }}">
            @csrf
						<div class="form-group">
              <label for="lmobile">Mobile No</label>
              <input id="lmobile" type="text" class="form-control{{ $errors->has('lmobile') ? ' is-invalid' : '' }}" name="lmobile" value="{{ old('lmobile') }}" required>

                  @if ($errors->has('lmobile'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('lmobile') }}</strong>
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

            <button type="submit" id="BtnTeacherSignIn" class="btn btn-primary">
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
<script src="{{asset('backend/js/additional-methods.js')}}"></script>
<script src="{{asset('backend/js/axios.min.js')}}"></script>
<script src="{{asset('backend/js/toastr.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
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


     $(document).ready(function() {

        

  
        $('#department').select2({
          width: '100%',
          placeholder: 'Search  department / college',
          language: {
            noResults: function() {
              return '<button id="no-results-btn" onclick="noResultsButtonClicked()" class="btn btn-sm">No Result Found</a>';
            },
          },
          escapeMarkup: function(markup) {
            return markup;
          },
        });




    jQuery.validator.addMethod("letterswithspace", function(value, element) {
    return this.optional(element) || /^[a-z][a-z\s]*$/i.test(value);
    }, "Only Letters and white spaces  are allowed");	

    jQuery.validator.addMethod("validMobile", function(value,element) {
            return this.optional(element) ||  /^[0]?[789]\d{11}$/.test(value);
    }, "Please enter your mobile with country code and without dashes");

    var base_url  = '{{ URL::to("/") }}/';
    $('#BtnTeacherSignUp').on('click',function(){
      $("form#TeachersSignUpForm").validate({
         errorElement:'span',
         errorClass:'help-block pull-left err',
         ignore:":hidden:not(select)",
         debug:true,
         rules:{
            department:{
              required:true,
            },
            fullname:{
               required:true,
               letterswithspace: true

            },
            mobile:{
            	required:true,
              minlength:13,
              maxlength:13,
              validMobile: true,

  
            },
            password:{
            	required:true,
            	minlength:8
            },
            cpassword:{
                 minlength : 8,
                 equalTo : "#password"
            },
         },
         highlight:function(element){
            $(element).closest('.form-group').addClass('has-error');
         },

         success:function(label){
            label.closest('.form-group').removeClass('has-error');label.remove();
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
           
            $('#TeachersSignUpForm')[0].submit(); 
           
         //e.preventDefault();

      }
   });
   });
  });

     

      $('#BtnTeacherSignIn').on('click',function(){
      $("form#TeachersSignInForm").validate({
         errorElement:'span',
         errorClass:'help-block pull-left err',
         ignore:":hidden:not(select)",
         debug:true,
         rules:{
            
            lmobile:{
              required:true,
              minlength:13,
              maxlength:13,
              validMobile: true,
            },
            lpassword:{
              required:true,
              minlength:8
            },
        
         },
         highlight:function(element){
            $(element).closest('.form-group').addClass('has-error');
         },

         success:function(label){
            label.closest('.form-group').removeClass('has-error');label.remove();
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
           
            $('#TeachersSignInForm')[0].submit(); 
           
         //e.preventDefault();

      }
   });
   });

     function noResultsButtonClicked() {
      alert('You clicked the "No Result Found" button.');
    }
    </script>
@endsection