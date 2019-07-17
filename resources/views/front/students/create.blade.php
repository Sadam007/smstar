@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | Students Registration</title>
@endsection

@section('page-css-plugins')
<link rel="stylesheet" href="{{ asset('backend/css/fontawesome-all.min.css') }}">
<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/jquery.datetimepicker.css')}}" rel="stylesheet">
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
	span.select2-selection.select2-selection--single {
		outline: none !important;
		border: 1px solid #ddd !important;
	}
	#select2-stdDepartment-container,#select2-stdSession-container,#select2-stdDegree-container,#select2-stdDomicile-container{
		background: #fff !important;
		height: 38px !important;
		border-radius: .25rem !important;
		border: 1px solid #ddd !important;
	}

	label{
		font-weight: normal;
	}
	#smartwizard li a{
		font-size: 16px;
		color: #2E5F9B
	}
	.help-block ul li {
		margin-top: 10px;
	} 
	#step-three-table thead tr {
		background: #2E5F9B !important;
		color: white;
	}
	#step-three-table input[type='text'] {

	}
	/*::placeholder ,.select2-selection__placeholder,#stdPhoto{
	padding: 2px;
	font-weight: normal;
	text-transform: capitalize;
	color: #2E5F9B !important;
	opacity: .7 !important;

	}*/
	ul.progresssteps{margin: 0; text-align: center; padding: 0;}
	ul.progresssteps li {
		width: 1.2em;
		height: 1.2em;
		text-align: center;
		line-height: 2em;
		border-radius: 50%;
		background: #2E5F9B;
		margin: 0 1em;
		display: inline-block;
		color: white;
		position: relative;
	}

	ul.progresssteps li::before{
		content: '';
		position: absolute;
		top: .9em;
		left: -4em;
		width: 4em;
		height: .2em;
		background: #9c9c9c;
		z-index: -1;
	}

	ul.progresssteps li:first-child::before {display: none;}
	ul.progresssteps .active {background: #2E5F9B;}
	ul.progresssteps .active ~ li {background: #9c9c9c;}
	ul.progresssteps .active ~ li::before {background: #9c9c9c;}
	.m-t-md {margin-top: 20px !important;}
	.m-b-md {margin-bottom: 20px !important;}
	h6{
		font-weight: bolder;
		font-size: 16px;
	}
</style>
@endsection

@section('main')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<span style="font-size: 18px; font-weight: bold;">Students Sign Up Form</span> <i class="fa fa-user-alt fa-lg float-right"></i>
				</div>
				<div class="card-body">


					<form id="form-1" method="post">
						<ul class="progresssteps">
							<li class="active"> </li>
							<li> </li>
							<li> </li>
							<li> </li>
						</ul> 
						<h6 class="m-b-md m-t-md">Step 1 : College / Deparment Information</h6>
						<div class="form-group">	
							<label>Department / College</label>		
							<select name="stdDepartment" class="form-control department" id="stdDepartment" required>
								<option value=""></option>
								@if(count($colleges) > 0 )
								@foreach($colleges as $college)
								<option class="cus-opt" value="{{ $college->college_id }}">
									{{ $college->name }} 
								</option>
								@endforeach
								@endif
							</select>
						</div>
						<div class="form-group">
							<label>Session</label>	 
							<select name="stdSession" class="form-control department" id="stdSession" required="">
								<option value=""></option>
								@if(count($sessions) > 0 )
								@foreach($sessions as $session)
								<option class="cus-opt" value="{{ $session->session }}">
									{{ $session->session }} 
								</option>
								<option value="{{ $session->id }}" id="sessionId" style="display: none;"></option>
								@endforeach
								@endif
							</select>
						</div>
						<div class="form-group">
							<label>Degree</label>		
							<select name="stdDegree" class="form-control department" id="stdDegree" required="">
								{{-- <option value=""></option>
								@if(count($degrees) > 0 )
								@foreach($degrees as $degree)
								<option class="cus-opt" value="{{ $degree->id }}"> 
									{{ $degree->M_Title }} 
								</option>
								@endforeach
								@endif --}}
							</select>
						</div>
						<br>
						<input type="submit" id="btn-1" name="submit" value="Next"  class="btn btn-outline-primary">

					</form>

					<div class="clearfix"></div>
					<form style="display:none;" id="form-2" method="post" enctype="multipart/form-data">
						<ul class="progresssteps m-t-md m-b-md">
							<li class=""> </li>
							<li class="active"> </li>
							<li class=""> </li>
							<li class=""> </li>
						</ul> 
						<h6 class="m-b-md m-t-md">Step 2 : Personal Information</h6>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="stdName">Name</label>
									<input type="text" class="form-control" name="stdName" id="stdName" placeholder="Write your name" required>			
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="stdfName">Father Name</label>
									<input type="text" class="form-control" name="stdfName" id="stdfName" placeholder="Write your father name" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="stddob">D.O.B</label>
									<input type="text" class="form-control"  name="stddob" id="stddob" placeholder="Enter your dob (Format : DD.MM.YYYY)" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="stdDomicile">Domicile</label>
									<select name="stdDomicile" class="form-control department" id="stdDomicile" required>
										<option value=""></option>
										@if(count($districts) > 0 )
										@foreach($districts as $district)
										<option class="cus-opt" value="{{ $district->id }}">
											{{ $district->name }} 
										</option>
										@endforeach
										@endif
									</select>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="stdAddress">Address</label>
									<textarea class="form-control" name="stdAddress" id="stdAddress" rows="1" placeholder="Write your address..." required style="resize: none;"></textarea>
								</div>

							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="stdPhoto">Profile Photo</label>
									<input type="file" class="form-control" name="stdPhoto" id="stdPhoto" required>
								</div>
							</div>
						</div>
						

						<input type="submit" id="btn-2" name="submit2" value="Next" class="btn btn-outline-primary  m-l-xs">
						<a href="javascript:;" onclick="backPage('form-2','form-1')" class="btn btn-outline-primary ">Back</a>
					</form>
					<div class="clearfix"></div>
					<form style="display:none;" id="form-3" method="post">
						<ul class="progresssteps m-t-md m-b-md">
							<li class=""> </li>
							<li class=""> </li>
							<li class="active"> </li>
							<li class=""> </li>
						</ul> 
						<h6 class="m-b-md m-t-md">Step 3 : Academic Information</h6>
						<div class="table-responsive">
							<table id="step-three-table" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Name of Exam Passed</th>
										<th>Group</th>
										<th>Roll No</th>
										<th>Passing Year </th>
										<th>M.Obtained</th>
										<th>T.Marks</th>
										{{-- <th>Division/ Grade</th> --}}
										<th>Institute / School</th>
										<th>Board / University</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<select name="metricSelect" class="form-control department" id="metricSelect" required>
												<option value=""></option>
												@if(count($certificates) > 0 )
												@foreach($certificates as $certificate)
													@if($certificate->name === "SSC")
													<option class="cus-opt" value="{{ $certificate->id }}">	{{ $certificate->name }} 
													@endif	
												</option>
												@endforeach
												@endif
											</select>
										</td>
										<td>
											<select name="metricGroup" class="form-control department" id="metricGroup" required>
												
											</select>
											
										</td>
										<td>
											<input type="text" class="form-control" id="metricRollno" name="metricRollno">
										</td>
										<td>
											<input type="text" class="form-control" id="metricYear" name="metricYear">
										</td>
										<td>
											<input type="text" class="form-control" id="metricObtMarks" name="metricObtMarks">
										</td>
										<td>
											<input type="text" class="form-control" id="metricTotMarks" name="metricTotMarks">
										</td>
										{{-- <td>
											<input type="text" class="form-control" id="metricDivision" name="metricDivision">
										</td> --}}
										<td>
											<input type="text" class="form-control" id="metricInstitue" name="metricInstitue">
										</td>
										<td>
											<input type="text" class="form-control" id="metricBoard" name="metricBoard">
										</td>
									</tr>
									<tr>
										<td>
											<select name="fscSelect" id="fscSelect" class="form-control">
												<option value=""></option>
													@if(count($certificates) > 0 )
														@foreach($certificates as $certificate)
														@if($certificate->name === "FSC" || $certificate->name === "Diploma")
														<option class="cus-opt" value="{{ $certificate->id }}">	{{ $certificate->name }} 
														@endif	
												</option>
												@endforeach
												@endif
											</select>
										</td>
										<td>
											<select name="fscGroup" class="form-control department" id="fscGroup" required>
												
											</select>
									
										</td>
										<td>
											<input type="text" class="form-control" id="fscRollno" name="fscRollno">
										</td>
										<td>
											<input type="text" class="form-control" id="fscYear" name="fscYear">
										</td>
										<td>
											<input type="text" class="form-control" id="fscObtMarks" name="fscObtMarks">
										</td>
										<td>
											<input type="text" class="form-control" id="fscTotMarks" name="fscTotMarks">
										</td>
										{{-- <td>
											<input type="text" class="form-control" id="fscDivision" name="fscDivision">
										</td> --}}
										<td>
											<input type="text" class="form-control" id="fscInstitue" name="fscInstitue">
										</td>
										<td>
											<input type="text" class="form-control" id="fscBoard" name="fscBoard">
										</td>
									</tr>
									<tr>
										<td>
											<select name="bscSelect" id="bscSelect" class="form-control">
												<option value=""></option>
													@if(count($certificates) > 0 )
														@foreach($certificates as $certificate)
														@if($certificate->name === "B.A" || $certificate->name === "B.Sc")
														<option class="cus-opt" value="{{ $certificate->id }}">	{{ $certificate->name }} 
														@endif	
												</option>
												@endforeach
												@endif
											</select>
										</td>
										<td>
											<select name="bscGroup" class="form-control department" id="bscGroup" >
												
											</select>
											
										</td>
										<td>
											<input type="text" class="form-control" id="bscRollno" name="bscRollno">
										</td>
										<td>
											<input type="text" class="form-control" id="bscYear" name="bscYear">
										</td>
										<td>
											<input type="text" class="form-control" id="bscObtMarks" name="bscObtMarks">
										</td>
										<td>
											<input type="text" class="form-control" id="bscTotMarks" name="bscTotMarks">
										</td>
										{{-- <td>
											<input type="text" class="form-control" id="bscDivision" name="bscDivision">
										</td> --}}
										<td>
											<input type="text" class="form-control" id="bscInstitue" name="bscInstitue">
										</td>
										<td>
											<input type="text" class="form-control" id="bscBoard" name="bscBoard">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<br>
						<input type="submit" name="submi3" id="btn-3" class="btn btn-outline-primary" value="Next">
						<a href="javascript:;" onclick="backPage('form-3','form-2')" class="btn btn-outline-primary">Back</a>
					</form>
					<div class="clearfix"></div>
					<form style="display:none;" id="form-4" method="post" enctype="multipart/form-data">
						<ul class="progresssteps m-t-md m-b-md">
							<li class=""> </li>
							<li class=""> </li>
							<li class=""> </li>
							<li class="active"> </li>
						</ul> 
						<h6 class="m-b-md m-t-md">Step 4 : Contact Information</h6>
						<div class="form-group">
							<label for="name">Email Address :</label>
							<input type="email" class="form-control" name="stdEmail" id="stdEmail" placeholder="Write your email address" required>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="name">Mobile # :</label>
							<input type="text" class="form-control" name="stdContact" id="stdContact" placeholder="Write your mobile number" required>
							<div class="help-block with-errors"></div>
						</div>

						<input type="submit" name="submi4" id="btn-4" class="btn btn-outline-primary" value="Register">
						<a href="javascript:;" onclick="backPage('form-4','form-3')" class="btn btn-outline-primary">Back</a>
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
<script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.datetimepicker.full.min.js')}}"></script>
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

	$("#stdDepartment").on("change", function(e){
		e.preventDefault();
		var deptValue = $(this).val();
		var url = "<?php echo route('check.college.degrees');?>";
		var stdDegree = document.querySelector("#stdDegree");

		//stdDegree.innerHTML += `<option value="">Please select an option</option>`;
		if (stdDegree) {
			axios({
            method: 'POST',
            url: url,
            data: {
              deptValue: deptValue,
            }
          })
		.then(function(res){

			var arr = res.data.data;

			stdDegree.innerHTML = "";
        	arr.forEach(function(item,value){
        		var degId = item.id;
        		var Det1  = item.Det1;
        		var DegCode = item.DegCode;
        		var M_Title = item.M_Title;
        		stdDegree.innerHTML += `<option value="${DegCode}"> ${Det1}</option>`;


        	});
        	
         })
		.catch(function(err){
			//console.log(err.data);
			var notFound = document.querySelector("#stdDegree");
				notFound.innerHTML = "";
				notFound.innerHTML += `<option value=""> No degree found in this college</option>`
		});
		}
		else{
			alert("The selected department is not found");
		}
	});


	$('#step-three-table').DataTable({      
		"searching": false,
		"paging": false, 
		"info": false,         
		"lengthChange":false ,
		"ordering": false,
	});

	$('#stddob').datetimepicker({
		format:'d.m.Y',
		timepicker:false,
		theme:'dark'
	});

	function backPage(form_hide,form_show){
		$('#'+form_hide).hide();
		$('#'+form_show).show();
	}

	$(document).ready(function () {

		$.validator.addMethod("lettersonly", function(value, element) 
            {
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        },'Letters and white spaces are allowed');
 		
 		$.validator.addMethod("specialLetters", function(value, element) 
            {
            return this.optional(element) || /^[a-zA-Z\:/\s]+$/i.test(value);
        },'Letters, white spaces, / and : are allowed');

        $.validator.addMethod('filesize', function (value, element, param) {
	      return this.optional(element) || (element.files[0].size <= param)
	  	}, function(size){
	   		 return "MAX SIZE " + filesize(size,{exponent:2,round:1});
	  	});

      $.validator.addMethod("validMobile", function(value,element) {
            return this.optional(element) ||  /^[0]?[789]\d{11}$/.test(value);
    	}, "Please enter your mobile with country code and without dashes"); 

 		
		$('#stdDepartment').select2({
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

		$('#stdSession').select2({
			width: '100%',
			placeholder: 'Search Session',
			language: {
				noResults: function() {
					return '<button id="no-results-btn" onclick="noResultsButtonClicked()" class="btn btn-sm">No Result Found</a>';
				},
			},
			escapeMarkup: function(markup) {
				return markup;
			},
		}); 

		$("#metricSelect").on('change',  function(evt) {
			 evt.preventDefault();
			$("#metricGroup").append('<option value="">Select Group</option>');
			$("#metricGroup").append('<option value="Arts">Arts</option>');
			$("#metricGroup").append('<option value="Science">Science</option>');
			
		});
// 
		$("#fscSelect").on('change',  function(ev) {
			 ev.preventDefault();
	
			var fscGroup = $(this).val();
			if (fscGroup == 2) 
				{
					$("#fscGroup").append('<option value="">Select Group</option>');
					$("#fscGroup").append('<option value="Medical">Pre Medical</option>');
					$("#fscGroup").append('<option value="Engineering">Pre Engineering</option>');
				}
				if (fscGroup == 3){
					$("#fscGroup").append('<option value="">Select Group</option>');
					$("#fscGroup").append('<option value="Civil">Civil</option>');
					$("#fscGroup").append('<option value="Electrical">Electrical</option>');
					$("#fscGroup").append('<option value="Chemical">Chemical</option>');
					$("#fscGroup").append('<option value="Electronics">Electronics</option>');
					$("#fscGroup").append('<option value="Petroleum">Petroleum</option>');
				}
		});

		$("#bscSelect").on('change',  function(et) {
			et.preventDefault();
			var bscGroup = $(this).val();
			if (bscGroup == 4) 
				{
					$("#bscGroup").append('<option value="B.A">Arts</option>');
				}
				if (bscGroup == 5){
					
					$("#bscGroup").append('<option value="B.Sc">Science</option>');
				
				}
		});
		$('#stdDomicile').select2({
			width: '100%',
			placeholder: 'Search your domicile',
			language: {
				noResults: function() {
					return '<button id="no-results-btn" onclick="noResultsButtonClicked()" class="btn btn-sm">No Result Found</a>';
				},
			},
			escapeMarkup: function(markup) {
				return markup;
			},
		}); 

		$('#btn-1').on('click', function () {
			$("form#form-1").validate({
				errorElement: 'span',
				errorClass: 'help-block err',
				ignore: ":hidden:not(select)",
				debug:true,
				rules: {
					stdDepartment: {
						required: true,
					},
					stdDegree: {
						required: true,
					},
					stdDegree:{
						required:true,
					},
				},
					highlight: function (element) {
						$(element)
						.closest('.form-control').addClass('err');
					},
					success: function (label) {
						label.closest('.form-control').removeClass('err');
						label.remove();
					},
					invalidHandler:function(form,validator){
						if(!validator.numberOfInvalids())return;
					},
					messages: {
					},
					submitHandler: function (form) {
	        			$('#form-1').hide();
	              $('#form-2').show();
	        }
	    });
		});

		$('#btn-2').on('click', function () {
			$("form#form-2").validate({
				errorElement: 'span',
				errorClass: 'help-block err',
				ignore: ":hidden:not(select)",
				rules: {
					stdName: {
						required: true,
						lettersonly:true,
						minlength:3,
					},
					stdfName:{
						required:true,
						lettersonly:true,
						minlength:3,
					},
					stddob:{
						required:true,
					},
					stdDomicile:{
						required:true,
					},
					stdAddress:{
						required:true,
						specialLetters:true,
					},
					stdPhoto:{
						required:true,
						extension: "jpg|jpeg|png",
                        filesize:1000 * 1024
					}
				},
				highlight: function (element) {
					$(element)
					.closest('.form-control').addClass('err');
				},
				success: function (label) {
					label.closest('.form-control').removeClass('err');
					label.remove();
				},
				invalidHandler:function(form,validator){
					if(!validator.numberOfInvalids())return;
				},
				messages: {
					stdPhoto:{
                        	required:"This field is required",
                            extension:"These extension (jpg | jpeg | png) are allowed to upload",  
                            filesize:"Image size must be less than 1MB",  
                    },
				},
				submitHandler: function (form) {
        			$('#form-2').hide();
        			$('#form-3').show();
        }
    	});
		});

		$('#btn-3').on('click', function () {
			$("form#form-3").validate({
				errorElement: 'span',
				errorClass: 'help-block err',
				ignore: ":hidden:not(select)",
				rules: {
					metricSelect: {
						required: true,
					},
					metricGroup:{
						required:true,
					},
					metricRollno:{
						required:true,
						number:true,
					},
					metricYear:{
						required:true,
						number:true,
					},
					metricObtMarks:{
						required:true,
						number:true,
					},
					metricTotMarks:{
						required:true,
						number:true,
					},
					metricInstitue:{
						required:true,
						lettersonly:true,
					},
					metricBoard:{
						required:true,
					},
					fscSelect:{
						required:true,
					},
					fscGroup:{
						required:true,
					},
					fscRollno:{
						required:true,
						number:true,
					},
					fscYear:{
						required:true,
						number:true,
					},
					fscObtMarks:{
						required:true,
						number:true,
					},
					fscTotMarks:{
						required:true,
						number:true,
					},
					fscInstitue:{
						required:true,
						lettersonly:true,
					},
					fscBoard:{
						required:true,
					},
					// bscSelect:{
					// 	required:true,
					// },
					// bscGroup:{
					// 	required:true,
					// },
					// bscRollno:{
					// 	required:true,
					// 	number:true,
					// },
					// bscYear:{
					// 	required:true,
					// 	number:true,
					// },
					// bscObtMarks:{
					// 	required:true,
					// 	number:true,
					// },
					// bscTotMarks:{
					// 	required:true,
					// 	number:true,
					// },
					// bscInstitue:{
					// 	required:true,
					// 	lettersonly:true,
					// },
					// bscBoard:{
					// 	required:true,
					// },
				},
				highlight: function (element) {
					$(element)
					.closest('.form-control').addClass('err');
				},
				success: function (label) {
					label.closest('.form-control').removeClass('err');
					label.remove();
				},
				invalidHandler:function(form,validator){
					if(!validator.numberOfInvalids())return;
				},
				messages: {
				},
				submitHandler: function (form) {
              $('#form-3').hide();
              $('#form-4').show();

                            
        }
      });
		});

		$('#btn-4').on('click', function () {
			$("form#form-4").validate({
				errorElement: 'span',
				errorClass: 'help-block err',
				ignore: ":hidden:not(select)",
				debug:true,
				rules: {
					stdEmail: {
						required: true,
						email:true,
					},
					stdContact:{
						required:true,
	               minlength:13,
	               maxlength:13,
	               validMobile: true,
					}
				},
				highlight: function (element) {
					$(element)
					.closest('.form-control').addClass('err');
				},
				success: function (label) {
					label.closest('.form-control').removeClass('err');
					label.remove();
				},
				invalidHandler:function(form,validator){
					if(!validator.numberOfInvalids())return;
				},
				messages: {
				},
				submitHandler: function (form,ett) {

					var booking_name = $('#name').val();
					// Form 1 values
					var stdDepartment  = $('#stdDepartment').val();
					var stdSession     = $('#stdSession').val();
					var sessionId     = $('#sessionId').val();
					var stdDegree      = $('#stdDegree').val();

					// Form 2 values
					var stdName        = $('#stdName').val();
					var stdfName       = $('#stdfName').val();
					var stddob         = $('#stddob').val();
					var stdDomicile    = $('#stdDomicile').val();
					var stdPhoto       = $('#stdPhoto').val();
					var stdAddress     = $('#stdAddress').val();
					// Form 3 values
					var metricSelect   = $('#metricSelect').val();
					var metricGroup    = $('#metricGroup').val();
					var metricRollno   = $('#metricRollno').val();
					var metricYear     = $('#metricYear').val();
					var metricObtMarks = $('#metricObtMarks').val();
					var metricTotMarks = $('#metricTotMarks').val();
					var metricInstitue = $('#metricInstitue').val();
					var metricBoard    = $('#metricBoard').val();

					var fscSelect      = $('#fscSelect').val();
					var fscGroup       = $('#fscGroup').val();
					var fscRollno      = $('#fscRollno').val();
					var fscYear        = $('#fscYear').val();
					var fscObtMarks    = $('#fscObtMarks').val();
					var fscTotMarks    = $('#fscTotMarks').val();
					var fscInstitue    = $('#fscInstitue').val();
					var fscBoard       = $('#fscBoard').val();

					var bscSelect      = $('#bscSelect').val();
					var bscGroup       = $('#bscGroup').val();
					var bscRollno      = $('#bscRollno').val();
					var bscYear        = $('#bscYear').val();
					var bscObtMarks    = $('#bscObtMarks').val();
					var bscTotMarks    = $('#bscTotMarks').val();
					var bscInstitue    = $('#bscInstitue').val();
					var bscBoard       = $('#bscBoard').val();

					// Form 4 values
					var stdEmail       = $('#stdEmail').val();
					var stdContact     = $('#stdContact').val();


					var url="<?php echo route('register.student');?>";
            		var cur_url="<?php echo route('student.create');?>";

            	axios({
            		method: 'POST',
            		url: url,
            		data: {
              			stdDepartment:   stdDepartment,
              			stdSession:      stdSession,
              			sessionId:       sessionId,
              			stdDegree:       stdDegree,
              			stdName:         stdName,
              			stdfName:        stdfName,
              			stddob:          stddob,
              			stdDomicile:     stdDomicile,
              			stdPhoto:        stdPhoto,
              			stdAddress:      stdAddress,
              			metricSelect:    metricSelect,
              			metricGroup:     metricGroup,
              			metricRollno:    metricRollno,
              			metricYear:      metricYear,
              			metricObtMarks:  metricObtMarks,
              			metricTotMarks:  metricTotMarks,
              			metricInstitue:  metricInstitue,
              			metricBoard:     metricBoard,
              			fscSelect:       fscSelect,
              			fscGroup:        fscGroup,
              			fscRollno:       fscRollno,
              			fscYear:         fscYear,
              			fscObtMarks:     fscObtMarks,
              			fscTotMarks:     fscTotMarks,
              			fscInstitue:     fscInstitue,
              			fscBoard:        fscBoard,

              			bscSelect:       bscSelect,
              			bscGroup:        bscGroup,
              			bscRollno:       bscRollno,
              			bscYear:         bscYear,
              			bscObtMarks:     bscObtMarks,
              			bscTotMarks:     bscTotMarks,
              			bscInstitue:     bscInstitue,
              			bscBoard:        bscBoard,

              			stdEmail:        stdEmail,
              			stdContact:      stdContact,

            		}
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
		        .catch(function(err){
           			setTimeout(()=>{toastr.error("User already exists.");
         			},1000);
         		});
					
					ett.preventDefault();
				}
			});
		});
	});

function noResultsButtonClicked() {
	alert('Please search another keywords to match some record." button.');
}
</script>
@endsection