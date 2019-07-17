<!DOCTYPE html>
<html lang="en">
<head>

  @include('backend.includes.metas')
  
  @yield('page-title')
  
  <link rel="icon"  href="{{asset('backend/images/favicon.ico')}}">

  @include('backend.includes.theme-css-dependencies')

  @yield('theme-css-plugins')
  
  @yield('custom-css')
  <style>
    .circle{
      width: 28px;
      height: 28px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      padding: 5px 8px;
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
                    
                    </tr>
                  </thead>
                  <tbody>
                    <?php //dd($degrees);?>
                    @if(count($degrees) > 0)
                      @foreach($degrees as $degree)
                           <tr>
                            <td class="align-middle">
                              <a href="{{ route('crossTabDegreespdf',['degree'=>$degree->DegCode]) }}"> {{ $degree->Det1 }} 
                              </a>
                            </td>

                          </tr>
                          
                        @endforeach
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
          </section>
        </main>
      </div>

  @include('backend.includes.theme-js-dependencies')
  
  @yield('page-js-plugins') 

  @yield('custom-js')
  
</body>
</html>
