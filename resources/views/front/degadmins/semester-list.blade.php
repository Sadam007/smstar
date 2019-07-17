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
                
                <div class="table-responsive">
                  <table class="table" id="table-students">
                    <thead>
                      <tr>
                        <th> Serial No</th>
                        <th> Semester</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($semesters) > 0 )
                      <?php 
                       // dd($semesters);
                        $i=1;

                      ?>
                      @foreach($semesters as $semester)
                      <tr>
                        <td class="align-middle"><?php echo $i;$i++;?></td>
                        <td class="align-middle"><a href="{{ route('semester.subjects', ['semester' => $semester->semester_id,'degree'=>$semester->degree_id] )}}">Semester {{ $semester->semester_id }}</a></td>
                        <td class="align-middle"></td>
                    
                     </tr>
                     @endforeach
                     @endif  
                   </tbody>
                 </table>
               </div>
               <ul class="pagination justify-content-center mt-4">
                 <li class="page-item">
                 
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
