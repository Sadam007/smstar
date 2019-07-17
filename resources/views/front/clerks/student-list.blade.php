@extends('layouts.clerk')

@section('page-title')
<title> Exam Portal | Clerks Dashboard | Registered Students in a Degree </title>
@endsection
@section('theme-css-plugins')


<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">


@endsection

@section('custom-css')
    <style>
        /* ==== Custom Styles Area ====*/
  
        
    </style>
@endsection

@section('main')

        @include('front.clerks.components.header-component')

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
               @if(count($colleges) > 0)
                  @foreach($colleges as $college)
                    {{ $college->collegeName }}              
                  @endforeach
               @endif
               <a href="{{ route('cdashboard') }}" style="height: " class="btn btn-outline-primary btn-sm float-right">
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
              <div class="text-muted"> Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{$students->total()}} entries </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                      <tr>
                        <th> Reg No</th>
                        <th> Name</th>
                        <th> Father Name </th>
                        <th> Status </th>
                      </tr>
                    </thead>
                  @if(count($students) > 0 )
                      @foreach($students as $student)
                      <tr>
                        <td class="align-middle">{{ $student->regno }}</td>
                        <td class="align-middle">{{ $student->stdName }}</td>
                        <td class="align-middle">{{ $student->stdfName }}</td>
                        <td class="align-middle">
                         @if($student->is_active === 0)
                         <form id="inactiveStdFormHidden-{{ $student->regno }}">
                          <input type="hidden" class="hiddenStudent" name="hiddenStudent" value="{{ $student->student_id }}">
                          <input type="hidden" class="hiddenRegno" name="hiddenRegno" value="{{ $student->regno }}">
                          <input type="hidden" class="hiddenDegree" name="hiddenDegree" value="{{ $student->degree_id }}">
                           <button  class="btn btn-primary btn-sm btn-inactive">Inactive</button>
                         </form>

                         @else 
                         <form id="activeStdFormHidden-{{ $student->regno }}">
                          <input type="hidden" class="hiddenStudentActive" name="hiddenStudentActive" value="{{ $student->student_id }}">
                          <input type="hidden" class="hiddenRegnoActive" name="hiddenRegnoActive" value="{{ $student->regno }}">
                           <button  class="btn btn-success  btn-sm btn-active">&nbsp;Active&nbsp;&nbsp;</button>
                         </form>
                        
                         @endif
                       </td>
                     </tr>
                     @endforeach
                     @endif  
                   </tbody>
                 </table>
              </div>
              <ul class="pagination justify-content-center mt-4">
                 <li class="page-item">
                  {{ $students->links() }}
                </li>             
              </ul>
            </div>

@endsection
@section('page-js-plugins') 
    <script src="{{asset('backend/js/axios.min.js')}}"></script>
    <script src="{{asset('backend/js/toastr.min.js')}}"></script>
@endsection

@section('custom-js')
      <script>
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}")
        @endif
        @if (Session::has('info'))
        toastr.info("{{Session::get('success')}}")
        @endif

        var base_url  = '{{ URL::to("/") }}/';

        $('button.btn-inactive').click(function (e) {
          e.preventDefault();
          var stdForm = $(this).closest('form');
          var stdId   =  stdForm.find('.hiddenStudent').val();
          var stdReg   = stdForm.find('.hiddenRegno').val();
          var stdDeg   = stdForm.find('.hiddenDegree').val();
          
          var url="<?php echo route('studentinactive');?>";
          var cur_url= document.URL;

          axios({
                method: 'POST',
                url: url,
                data: {
                  stdId:stdId,
                  stdReg:stdReg,
                  stdDeg:stdDeg,

                }
          }) 
          .then(function(res){
            var tos=res.data[0].message;

            var good=res.data[0].Good;
            if(good==true){
             setTimeout(()=>{toastr.success(tos);
             },1000);

             $('body').load(document.URL+'#specialUsersForm');
           }
         })
          .catch(function(err){
            setTimeout(()=>{toastr.warning("User status could not been changed.");
          },1000);
            $('body').load(document.URL+'#specialUsersForm')});


        }); 

        $('button.btn-active').click(function (ev) {
          ev.preventDefault();
          var stdForm1 = $(this).closest('form');
          var hiddenStudentActive   =  stdForm1.find('.hiddenStudentActive').val();
          var hiddenRegnoActive     =  stdForm1.find('.hiddenRegnoActive').val();
          
          var url1="<?php echo route('studentactive');?>";
          var cur_url1= document.URL;

          axios({
                method: 'POST',
                url: url1,
                data: {
                  hiddenStudentActive:hiddenStudentActive,
                  hiddenRegnoActive:hiddenRegnoActive

                }
          }) 
          .then(function(res){
            var tos=res.data[0].message;

            var good=res.data[0].Good;
            if(good==true){
             setTimeout(()=>{toastr.success(tos);
             },1000);

             $('body').load(document.URL+'#specialUsersForm');
           }
         })
          .catch(function(err){
            setTimeout(()=>{toastr.warning("User status could not been changed.");
          },1000);
            $('body').load(document.URL+'#specialUsersForm')});


        }); 

  
      </script>
@endsection