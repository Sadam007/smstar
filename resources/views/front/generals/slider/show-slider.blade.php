@extends('layouts.app')

@section('page-title')
<title> Exam Portal | Slider Management | Show Slide</title>
@endsection

@section('theme-css-plugins')

@endsection
@section('custom-css')
<style>
/* ==== Custom Styles Area ====*/

.card-header legend{
 margin-bottom: 0px !important;
}
.caption{
  color: #E0055D;
}
.cus-image{
  height: 400px;
  width: 100%;
  object-fit: cover;
}
.js-btn{
  color:blue !important;
}
.js-btn:hover{
  color: blue !important;
  text-decoration: underline !important;
  cursor: pointer !important;
}
</style>
@endsection

@section('main')
<div class="wrapper">
 <div class="page has-sidebar">
  <div class="page-inner" id="page-inner">
   <header class="page-title-bar">
    <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
      <li class="breadcrumb-item active">
       <a href="{{route('dashboard')}}">
        <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Dashboard</a>
    </li>
</ol>
</nav>
</header>
<div class="page-section">
 <div class="d-xl-none">
  <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar">
   <i class="fa fa-th-list"></i>
</button>
</div>
<section id="base-style" class="card">
  <header class="card-header">
     <legend>
        <span class="caption">{{ ucwords($sliderImage->caption) }}</span>
        <span class="float-right">Author : <span class="caption">{{ ucwords($sliderImage->author) }}</span> </span>
     </legend>
  </header>
  <div class="card-body">
    <p>
      <img src="{{$sliderImage->img}}" alt="{{$sliderImage->caption}}" class="img-thumbnail cus-image">
    </p>
    <div class="js-container">
      <p class="text-justify js-details">
        @if($sliderImage->body === "" || $sliderImage->body === NULL)
          <span class="text-danger" style="color:red !important;font-weight: bold;">{{"Slide body is not available."}}</span>
          
          @else

            {{str_limit($sliderImage->body, 550)}}
            &nbsp;
            @if(strlen($sliderImage->body) > 200)
              <a href="" class="frmt-txt" title="{{ $sliderImage->body }}">Read More</a>
            @endif  

        @endif
    </p>
    <p>
      <a href="{{ route('add.slider-images') }}#table-show" class="btn btn-outline-primary float-right">Back</a>  
    </p>
    </div>
  </div>
</section>

</div>
<div class="page-sidebar page-sidebar-fixed">
  <p><br></p>
  <h3 class="page-title" style="font-size: 20px;margin-bottom:-20px;margin-top: 30px;margin-left: 12px;"> Relevant Links </h3>
  <nav id="nav-content" class="nav flex-column mt-4">
   <a href="{{ route('add.slider-images') }}" class="nav-link smooth-scroll">Add New Slider</a>
   <a href="{{ route('add.slider-images') }}#table-show" class="nav-link smooth-scroll">All Slides</a>
</nav>
</div>
</div>
</div>
</div>

@endsection
@section('page-js-plugins')

@endsection
@section('custom-js')
<script>

  $(document).ready(function($) {

    var jsdetails   = document.querySelector(".js-details");
    var jscontainer   = document.querySelector(".js-container");

    $(document).on('click','.frmt-txt',function(event){
      event.preventDefault();

          jsdetails.innerHTML = "{{ preg_replace('/\s+/', ' ', $sliderImage->body) }}";

          var link  = document.createElement("a")
              link.setAttribute("class","js-btn");
              link.innerHTML = "Show Less";
        jscontainer.appendChild(link);
    }); 

    $(document).on('click','.js-btn',function(evt){
        evt.preventDefault();
        jsdetails.innerHTML = "{{ str_limit( preg_replace('/\s+/', ' ', $sliderImage->body), 550) }}";
        $(this).hide();
        var link  = document.createElement("a");
            link.setAttribute("href","");
            link.setAttribute("class","frmt-txt");
            link.innerHTML = "Read More";
            link.style.marginLeft = "10px";
            jsdetails.appendChild(link);
    });

  });
 
</script>
@endsection
