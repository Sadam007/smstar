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
				@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
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
@include('validations.stdValidation')
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

	
</script>
@endsection