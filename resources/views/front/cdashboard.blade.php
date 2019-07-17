@extends('layouts.clerk')

@section('page-title')
<title> Exam Portal | Clerks Dashboard </title>
@endsection

@section('custom-css')
    <style>
        /* ==== Custom Styles Area ====*/
     .circle{
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        padding: 13px 8px; 
        border: 2px solid #000;
        font-size: 13.5px;
        letter-spacing: .5px;
    }
        
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
              <div class="text-muted"> Showing {{ $degrees->firstItem() }} to {{ $degrees->lastItem() }} of {{$degrees->total()}} entries </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>List of Degrees</th>
                      <th><center> No of Registered Students </center></th>
                      <th><center> Verified Students </center></th>
                      <th><center> Non-verified Students </center></th>
                    </tr>
                  </thead>
                  <tbody>

                    @if(count($degrees) > 0)
                      @foreach($degrees as $degree)
                           <tr>
                            <td class="align-middle">
                              <a href="{{ route('clerk.student.degrees',['degree'=>$degree->degree_id,'department'=>$degree->college_id]) }}"> {{ $degree->Det1 }} 
                              </a>
                            </td>
                            <td class="align-middle">
                            <center>
                              <a href="">
                                <span class="badge badge-primary circle">
                                <?php 
                                $degCount  =  $degree->degCount;
                                if ($degCount < 10) {
                                   echo $degCount = "0".$degCount;
                                }
                                else{
                                   echo $degCount;
                                }

                                ?>


                                </span>
                              </a>
                            </center> 
                          </td>
                                
                             
                            <td class="align-middle"> 
                             <center>
                               <a href="">
                                <span class="badge badge-success circle"> 
                                {{-- @if($degree->activeCount !== 0)  --}}
                                <?php  
                                    $activeCount = $degree->activeCount;

                                    if ($activeCount < 10) {
                                      echo $activeCount = "0".$activeCount;
                                    }
                                    else{
                                        echo $activeCount;
                                    }

                                ?>    
                                </span>
                               </a>
                              </center>
                              
                             </td>
                       
                            <td class="align-middle"> 
                              <center>
                                <a href="">
                                  <span class="badge badge-danger circle"> 
                                    <?php   
                                       $notVerifiedCount = ($degree->degCount) - ($degree->activeCount);

                                       if ($notVerifiedCount < 10) {
                                            
                                            echo $notVerifiedCount = "0".$notVerifiedCount;
                                       }
                                       else{
                                        echo $notVerifiedCount;
                                       }

                                    ?>
                                  </span>
                                </a>
                            </center>
                            </td>
                          </tr>
                          
                        @endforeach

                        @else 
                        <tr>
                          <td colspan="4">No degrees found.</td>
                        </tr>
                    @endif

                  </tbody>
                </table>
              </div>
              <ul class="pagination justify-content-center mt-4">
                 <li class="page-item">
                  {{ $degrees->links() }}
                </li>             
              </ul>
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
