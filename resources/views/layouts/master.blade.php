<!doctype html>
<html lang="en">
<head>
    @include('backend.includes.metas')

    @yield('page-title')

    <link rel="icon"  href="{{asset('backend/images/favicon.ico')}}">
    @include('front.includes.theme-css-dependencies')
    @yield('page-css-plugins')

    @yield('custom-css')
</head>
<body>
    @include('front.includes.navbar')

    @include('front.includes.banner')


    @yield('spacer')
    <div class="container">
        <div class="row">
             @yield('main')
         </div>        
    </div>


 @include('front.includes.footer')

 @include('front.includes.theme-js-dependencies')

 @yield('page-js-plugins') 

 @yield('custom-js')
</body>
</html>
