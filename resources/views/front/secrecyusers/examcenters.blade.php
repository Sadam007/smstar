@extends('layouts.secrecy')

@section('page-title')
<title> Exam Portal | Secrecy Users | Exam Centers</title>
@endsection

@section('theme-css-plugins')

<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('custom-css')
    <style>
        /* ==== Custom Styles Area ====*/
      .circle{
      width: 30px;
      height: 30px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      padding: 5px 8px;

    }
    .subject{
    color: #bc9123;
    font-weight: bolder;
    text-transform: capitalize;
  }
    .assign{
      color: #063;
      font-weight: 700;
      margin-top: 5px;
      display: inline-block;
    }
    .assign-to{
      color: #2E5F9B;
      font-weight: 700;

    }
    .assign1{
      color: #00a1ff;
      font-weight: 700;
    }
        
    </style>
@endsection

@section('main')

        @include('front.secrecyusers.components.header-component')
         <div class="page-inner">
        <header class="page-title-bar">
          <button type="button" class="btn btn-success btn-floated">
            <span class="fa fa-plus"></span>
          </button>
        </header>
        <div class="page-section">
          <section class="card card-fluid">
            <header class="card-header">
             <legend style="font-size: 20px;">
               Subjects
               <a href="{{ route('secdashboard') }}" style="height: " class="btn btn-outline-primary btn-sm float-right">
                <span class="fa fa-arrow-left"></span></a>
             </legend>
           </header>
           <div class="card-body">
            <div class="form-group">
              <div class="input-group input-group-alt">
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
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <span class="oi oi-magnifying-glass"></span>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="Search record"> </div>
                </div>
              </div>
              <div class="text-muted"> Showing {{ $centers->firstItem() }} to {{ $centers->lastItem() }} of {{$centers->total()}} entries </div>
              <div class="table-responsive">
                <table class="table" id="table-students">
                  <thead>
                    <tr>
                      <th width="10%">Center Code</th>
                      <th width="25%">Subject Code </th>
                      <th width="10%">Students </th>
                      <th>Asssign </th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php //dd($centers);?>
                    @if(count($centers) > 0 )
                      @foreach($centers as $center)
                           <tr>
                            <td >
                              <span title="Centre Name : {{ $center->name_of_centre }}">{{ $center->ccode }}</span>
                            </td>
                            <td class="subject">{{ $center->subcode }}
                          <br>
                          @if(count($assignments) > 0)
                          <span class="assign-to"> 
                      
                              @foreach($assignments as $assignment)
                                @if($center->subcode == $assignment->subcode)
                                   ({{ ( $assignment->name )}})
                                
                                @else 

                                @endif

                              @endforeach
                            
                          </span>
                          @else 
                          <span class="assign1">examcenter not assigned to any teacher </span> 
                          @endif
                        </td>
                        <td >
                        
                              <a href="">
                                <span class="badge badge-primary circle">
                                <?php 
                                $stdCount  =  $center->stdCount;
                                if ($stdCount < 10) {
                                   echo $stdCount = "0".$stdCount;
                                }
                                else{
                                   echo $stdCount;
                                }

                                ?>


                                </span>
                              </a>
                          </td>
                            <td >
                          <form action="SubjectAssignmentForm-{{ $center->roll_no_com_det_id }}" autocomplete="off">
                          <input type="hidden" class="hiddenCenterCode" name="hiddenCenterCode" value="{{ $center->ccode }}">
                          <input type="hidden" class="hiddenSubcode" name="hiddenSubcode" value="{{ $center->subcode }}">
                         <select name="" id="TeachExamcenterAssignment" class="form-control TeachExamcenterAssignment">
                           <option value="">select an option</option>
                           @if(count($teachers) > 0 )
                                @foreach($teachers as $teacher)
                                  <option title="{{ "Address : " . $teacher->address }}" value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach

                          @else

                          <option value="">Teacher(s) not  found.</option> 

                           @endif
                         </select>
                       </form>
                        </td>
                          </tr>
                        @endforeach
                        @else
                        <tr>
                          <td colspan="4">Center is not assigned to this subject.</td>
                        </tr>
                      @endif  
          
                  </tbody>
                </table>
              </div>
              <ul class="pagination justify-content-center mt-4">
                 <li class="page-item">
                  {{ $centers->links() }}
                </li>             
              </ul>
            </div>

        

@endsection
@section('page-js-plugins')
    {{-- @include('backend.includes.components.scripts.dashboard-chart-component') --}}
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

        $('#TeachExamcenterAssignment').select2({
          width: '90%',
          placeholder: 'Search  teacher',
          // theme:"classic",
          language: {
            noResults: function() {
              return '<button id="no-results-btn" onclick="noResultsButtonClicked()" class="btn btn-sm">No Result Found</a>';
            },
          },
          escapeMarkup: function(markup) {
            return markup;
          },
        }); 

        var base_url  = '{{ URL::to("/") }}/';

        $(".TeachExamcenterAssignment").on('change', function(event) {
          event.preventDefault();

              var form       = $(this).closest('form');
              var teachId    =  $(this).val();
              var centercode = form.find('.hiddenCenterCode').val();
              var subcode    = form.find('.hiddenSubcode').val();

              var url="<?php echo route('examcenter.assignment');?>";
              var cur_url= document.URL;

              axios({
                    method: 'POST',
                    url: url,
                    data: {
                      teachId:teachId,
                      centercode:centercode,
                      subcode:subcode,

                    }
              }) 
              .then(function(res){
                var tos=res.data[0].message;

                var good=res.data[0].Good;
                if(good==true){
                 setTimeout(()=>{toastr.success(tos);
                 },1000);

                 $('body').load(document.URL+'#table-students');
               }
             })
              .catch(function(err){
                setTimeout(()=>{toastr.warning("Could not assign examcenter to relevant teacher.");
              },1000);
                $('body').load(document.URL+'#table-students')});
    
        });

        function noResultsButtonClicked() {
          alert('Please search another keywords to match some record." button.');
        }
    </script>
@endsection
