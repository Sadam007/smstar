@extends('layouts.teacher')

@section('page-title')
<title> Exam Portal | Teacher Dashboard </title>
@endsection

@section('custom-css')
<style>
/* ==== Custom Styles Area ====*/
	.circle{
      width: 24px;
      height: 24px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      padding: 5px 8px;
    }
</style>
@endsection

@section('main')

@include('front.teachers.components.header-component')

<div class="page-inner">
	<header class="page-title-bar">
		<button type="button" class="btn btn-success btn-floated">
			<span class="fa fa-plus"></span>
		</button>
	</header>
	<div class="page-section">
		<section class="card card-fluid">
			<!-- .card-header -->
			<div class="card-header">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#tabInternal" role="tab">40 % Marks / Internal Evaluation</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#messages" role="tab">60 % Marks / External Evaluation</a>
					</li>

				</ul>	

			  	<div class="tab-content">
			    	<div class="tab-pane fade show active" id="tabInternal" role="tabpanel">
			 			<div class="card-body">
                    <!-- .form-group -->
                    <div class="form-group">
                      <!-- .input-group -->
                      <div class="input-group input-group-alt">
                        <!-- .input-group-prepend -->
                        <div class="input-group-prepend">
                          <select class="custom-select">
                            <option selected> Filter By </option>
                            <option value="1"> Tags </option>
                            <option value="2"> Vendor </option>
                            <option value="3"> Variants </option>
                            <option value="4"> Prices </option>
                            <option value="5"> Sales </option>
                          </select>
                        </div>
                        <!-- /.input-group-prepend -->
                        <!-- .input-group -->
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <span class="oi oi-magnifying-glass"></span>
                            </span>
                          </div>
                          <input type="text" class="form-control" placeholder="Search record"> </div>
                        <!-- /.input-group -->
                      </div>
                      <!-- /.input-group -->
                    </div>
                    <!-- /.form-group -->
                    <!-- .table-responsive -->
                    <div class="text-muted"> Showing {{ $subjects->firstItem() }} to {{ $subjects->lastItem() }} of {{$subjects->total()}} entries </div>
                    <div class="table-responsive">
                      <!-- .table -->
                      <table class="table">
                        <!-- thead -->
                        <thead>
                          <tr>

                            <th> Subject Name </th>
                            <th> No of Students </th>
                            <th> Semester </th>
                            <th> Degree </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php //dd($subjects);?>
                        	@if(count($subjects) > 0)
                        		@foreach($subjects as $subject)
		                          	<tr>
		                            	<td>
		                            		<a href="{{ route('subject.forty',['subject'=>$subject->subject_id,'code'=>$subject->code]) }}">{{ $subject->Na }}</a>
		                            	</td>
		                            	<td class="align-middle"> 113 </td>
		                            	<td class="align-middle"> 
		                            		<span class="badge badge-primary circle">
		                            			{{ $subject->semester_id }} 
		                            		</span>	
		                            	</td>
		                            	<td class="align-middle"> {{ $subject->Det1 }} </td>
		                       
		                          	</tr>
	                          	@endforeach
                          	@endif
                        </tbody>
                      </table>
                    </div>
                    <ul class="pagination justify-content-center mt-4">
                       <li class="page-item">
                        {{ $subjects->links() }}
                      </li>             
                      </ul>
                  </div>
			      
			    	</div>
			    <div class="tab-pane" id="messages" role="tabpanel">
			      
			     
			    </div>
			    
			  </div>
			</div>

		</section>
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
