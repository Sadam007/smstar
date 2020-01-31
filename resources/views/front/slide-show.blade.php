@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | Show Slider</title>
@endsection

@section('page-css-plugins')
   
@endsection
@section('custom-css')
<style>
.card-header legend{
 margin-bottom: 0px !important;
}
.caption{
  color: #063;
  font-size: 18px;
  margin-left: 5px;
  font-weight: bold;
}
.cus-image{
  height: 450px;
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
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <section id="base-style" class="card">
        <header class="card-header">
          <legend>
            <span class="caption">{{ ucwords($slide->caption) }}</span>
          </legend>
        </header>
        <div class="card-body">
          <p>
            <img src="{{$slide->img}}" alt="{{$slide->caption}}" class="img-thumbnail cus-image">
          </p>
          <div class="js-container">
            <p class="text-justify js-details">
              @if($slide->body === "" || $slide->body === NULL)
              <span class="text-danger" style="color:red !important;font-weight: bold;">{{"Slide body is not available."}}</span>
              
              @else
              {{str_limit($slide->body, 900)}}
              &nbsp;
              @if(strlen($slide->body) > 200)
              <a href="" class="frmt-txt">Read More</a>
              @endif
              @endif
            </p>
            <p>
              <a href="{{ route('homepage') }}" class="btn btn-outline-primary float-right">Back</a>
            </p>
          </div>
        </div>
      </section>
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

          jsdetails.innerHTML = "{{ preg_replace('/\s+/', ' ', $slide->body) }}";

          var link  = document.createElement("a")
              link.setAttribute("class","js-btn");
              link.innerHTML = "Show Less";
        jscontainer.appendChild(link);
    }); 

    $(document).on('click','.js-btn',function(evt){
        evt.preventDefault();
        jsdetails.innerHTML = "{{ str_limit( preg_replace('/\s+/', ' ', $slide->body), 900) }}";
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