<!DOCTYPE html>
<html lang="en">
<head>

  @include('backend.includes.metas')
  
  @yield('page-title')
  
  <link rel="icon"  href="{{asset('backend/images/favicon.ico')}}">
  <link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">

  @include('backend.includes.theme-css-dependencies')

  @yield('theme-css-plugins')
  
  @yield('custom-css')
  
</head>

<body>
  <!-- .app -->
  <div class="app">

    @include('front.degadmins.navbar')
    
    @include('front.degadmins.sidebar')

    <main class="app-main">
      @yield('main')
      
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
               <a href="{{ route('degAdmindashboard') }}" style="height: " class="btn btn-outline-primary btn-sm float-right">
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
                  <table class="table" id="table-students">
                    <thead>
                      <tr>
                        <th> Reg No</th>
                        <th> Name</th>
                        <th> Father Name </th>
                       {{--  <th> Status </th> --}}
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($students) > 0 )
                      @foreach($students as $student)
                      <tr>
                        <td class="align-middle">{{ $student->regno }}</td>
                        <td class="align-middle">{{ $student->stdName }}</td>
                        <td class="align-middle">{{ $student->stdfName }}</td>
                        {{-- <td class="align-middle">
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
                       </td> --}}
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
          </section>
        </main>
      </div>

      @include('backend.includes.theme-js-dependencies')
      
      @yield('page-js-plugins') 

      <script src="{{asset('backend/js/axios.min.js')}}"></script>
      <script src="{{asset('backend/js/toastr.min.js')}}"></script>
      <script>
        @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}")
        @endif
        @if (Session::has('info'))
        toastr.info("{{Session::get('success')}}")
        @endif

        var base_url  = '{{ URL::to("/") }}/';

      
  
      </script>
      
    </body>
    </html>
