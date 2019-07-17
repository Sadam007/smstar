@extends('layouts.student')

@section('page-title')
<title> Exam Portal | Student | Enrolled In an Exam </title>
@endsection

@section('custom-css')
    <style>
        /* ==== Custom Styles Area ====*/
        
    </style>
@endsection

@section('main')


        @include('front.students.components.stdudentCommon')
        	<p></p>

			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<p style="font-size: 15px;font-weight: bold;color: #346cb0;text-transform: uppercase;">Exams in which student is enrolled</p>
					<tr>
						<th width="10%">Roll No</th>
						<th width="60%">Semester</th>
					</tr>
					@if($rollnos)
						@foreach($rollnos as $rollno)
	                  		 <tr>
	                  			<th>{{ $rollno->rollno }}</th>
	                  			<th><a href="#"></a></th>
	                  		</tr> 
	                  	@endforeach
	                  	@else
	                  	<tr>
	                  		<td colspan="2" class="alert alert-danger">No Result Found</td>
	                  	</tr>
	                @endif  	
				</table>
				<a href="{{ route('student.enrolled-exams') }}" class="btn btn-outline-primary btn-sm">Back</a>
			</div>
		</div>
	</div>
</div>

@endsection
@section('page-js-plugins')
    @include('backend.includes.components.scripts.dashboard-chart-component')
@endsection
@section('custom-js')
    <script>
        /* ==== Custom Scripts Area ====*/
        
    </script>
@endsection
