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

  <style>
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

               <?php $degree = $subjects[0]->degree_id;?>
               <a href="{{ route('degAdmin.degrees.semesters',['degree'=>$degree]) }}" style="height: " class="btn btn-outline-primary btn-sm float-right">
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
                        <th> Code</th>
                        <th> Subject</th>
                        <th> Assign</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($subjects) > 0 )
                      <?php 
                       //dd($assignments);
                        $i=1;

                      ?>
                      @foreach($subjects as $subject)
                      
        
                      <tr>
                        <td class="align-middle">
                          {{ $subject->code }}

                        </td>
                        <td class="align-middle subject">{{ $subject->Na }}
                          <br>
                          @if(count($assignments) > 0)
                          <span class="assign-to"> 
                      
                              @foreach($assignments as $assignment)
                                @if($subject->code == $assignment->subject_code)
                                   ({{ ( $assignment->name )}})

                                @endif

                              @endforeach
                            
                          </span>
                          @else 
                          <span class="assign1">Subject not assigned to any teacher </span> 
                          @endif
                        </td>
                        <td class="align-middle">
                          <form action="SubjectAssignmentForm-{{ $subject->code}}" autocomplete="off">
                        <input type="hidden" class="hiddenSubCode" name="hiddenSubCode" value="{{ $subject->code }}">
                         <select name="" id="" class="form-control TeachSubjAssignment">
                           <option value="">select an option</option>
                           @if(count($teachers) > 0 )
                                @foreach($teachers as $teacher)
                                  <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach

                          @else

                          <option value="">Teacher(s) not  found.</option> 

                           @endif
                         </select>
                       </form>
                        </td>
                    
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

        $(".TeachSubjAssignment").on('change', function(event) {
          event.preventDefault();

              var form = $(this).closest('form');
              var teachId =  $(this).val();
              var subjectcode   = form.find('.hiddenSubCode').val();

              var url="<?php echo route('subject.assignment');?>";
              var cur_url= document.URL;

              axios({
                    method: 'POST',
                    url: url,
                    data: {
                      teachId:teachId,
                      subjectcode:subjectcode,

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
                setTimeout(()=>{toastr.warning("Could not assign subject to relevant teacher.");
              },1000);
                $('body').load(document.URL+'#table-students')});
    
        });
    
      </script>
      
    </body>
    </html>
