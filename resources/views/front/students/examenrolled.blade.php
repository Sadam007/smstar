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
				<table class="table table-striped table-bordered">
					<p style="font-size: 15px;font-weight: bold;color: #346cb0;text-transform: uppercase;">Exams in which student is enrolled</p>
					<tr>
						<th width="10%">Serial No</th>
						<th width="60%">Examination Details</th>
						
					</tr>
					@if(count($exams))
						<?php $i=1 ; //dd($exams);?>
						@foreach($exams as $exam)
	                  		<tr>
	                  			<th>{{ $i++ }}</th>
	                  			<th><a href="{{ route('student.datesheet',['examid'=>$exam->exam_id,'examcode'=>$exam->examcode ,'exam' => urlencode($exam->description)]) }}">{{ $exam->description }}</a></th>
	                  		</tr>
	                  	@endforeach
	                  	@else
	                  	<tr>
	                  		<td colspan="3" class="alert alert-danger">No Result Found</td>
	                  	</tr>
	                @endif  	
				</table>
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
