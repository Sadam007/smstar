@extends('layouts.student')

@section('page-title')
<title> Exam Portal | Student Dashboard </title>
@endsection

@section('custom-css')
    <style>
        /* ==== Custom Styles Area ====*/
        
    </style>
@endsection

@section('main')

        @include('front.students.components.header-component')

        <div class="page-section">
                <!-- .section-block -->
                <div class="section-block">
                  <!-- metric row -->
                  <div class="metric-row">
                    <div class="col-lg-9">
                      <div class="metric-row metric-flush">
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="{{ route('student.enrolled-exams')}}" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> View Datesheet </h2>
                            <p class="metric-value h3">
                              <sub>
                                <i class="oi oi-people"></i>
                              </sub>
                              <span class="value">8</span>
                            </p>
                          </a>
                          <!-- /.metric -->
                        </div>
                        <!-- /metric column -->
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="{{ route('student.dmc') }}" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> View DMC </h2>
                            <p class="metric-value h3">
                              <sub>
                                <i class="oi oi-fork"></i>
                              </sub>
                              <span class="value">12</span>
                            </p>
                          </a>
                          <!-- /.metric -->
                        </div>
                        <!-- /metric column -->
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="{{ route('student.apply-Rechecking') }}" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Apply For Rechecking </h2>
                            <p class="metric-value h3">
                              <sub>
                                <i class="fa fa-tasks"></i>
                              </sub>
                              <span class="value">64</span>
                            </p>
                          </a>
                          <!-- /.metric -->
                        </div>
                        <!-- /metric column -->
                      </div>
                    </div>
                    <!-- metric column -->
                    <div class="col-lg-3">
                      <!-- .metric -->
                      <a href="#" class="metric metric-bordered">
                        <div class="metric-badge">
                          <span class="badge badge-lg badge-success">
                            <span class="oi oi-media-record pulse mr-1"></span> News Updates</span>
                        </div>
                        <p class="metric-value h3">
                          <sub>
                            <i class="oi oi-timer"></i>
                          </sub>
                          <span class="value">8</span>
                        </p>
                      </a>
                      <!-- /.metric -->
                    </div>
                    <!-- /metric column -->
                  </div>
                  <!-- /metric row -->
                </div>
               
                
                <!-- /section-deck -->
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
