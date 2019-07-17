<!DOCTYPE html>
<html lang="en">
<head>

  @include('backend.includes.metas')
  
  @yield('page-title')
  
  <link rel="icon"  href="{{asset('backend/images/favicon.ico')}}">

  @include('backend.includes.theme-css-dependencies')

  @yield('theme-css-plugins')
  
  @yield('custom-css')
  
</head>

<body>
  <!-- .app -->
  <div class="app">

    @include('front.specialusers.navbar')
    
    @include('front.specialusers.sidebar')

    <main class="app-main">
      @yield('main')
    </main>
    
  </div>

  @include('backend.includes.theme-js-dependencies')
  
  @yield('page-js-plugins') 

  @yield('custom-js')
  
</body>
</html>
