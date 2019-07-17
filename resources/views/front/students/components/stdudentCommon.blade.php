<div class="wrapper">   
    <div class="page">
    	<div class="page-inner">
			@if($students)
				@foreach($students as $student)
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<p style="font-size: 15px;font-weight: bold;color: #346cb0;text-transform: uppercase;">Student Profile Data</p>
							<tr>
								<th width="20%">Registration No</th>
								<th >{{ $student->regno }}</th>
							</tr>
							<tr>
								<th width="20%">Name</th>
								<th >{{ $student->stdName }}</th>
							</tr>
							<tr>
								<th width="20%">Father's Name</th>
								<th >{{ $student->stdfName }}</th>
							</tr>
							<tr>
								<th width="20%">Degree</th>
								<th >{{ $student->Det1 }}</th>
							</tr>
							<tr>
								<th width="20%">College / District</th>
								<th >{{ $student->CollegeName }}</th>
							</tr>
						</table>
					</div>
				@endforeach
			@endif
	