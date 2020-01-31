@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | Controller Details</title>
@endsection

@section('page-css-plugins')
   <link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
   <link href="{{asset('backend/css/fontawesome-all.min.css')}}" rel="stylesheet">
@endsection
@section('custom-css')
<style>
/* ==== Custom Styles Area ====*/

.custom-h4{
  font-size: 20px;
  font-weight: bold;
  text-transform: capitalize;
  color: #063;
}
.span4 img {
    margin-right: 20px;
}
.span4 .img-left {
    float: left;
}
.span4 .img-right {
    float: right;
}
#footer{
  padding: 10px;
}
.custom-para{
  line-height: 1.9rem;
}
#controller-details{
  background: #fff;
  padding: 20px;
  padding-bottom: 5px;
}
</style>
@endsection



@section('main')
    <div class="col-sm-12 col-md-12 col-xs-12" >
      <div class="span4" id="controller-details">
          @if(count($controller) > 0)
            <img class="img-left" src="{{ $controller[0]->avatar }}" title="{{ $controller[0]->title." ".$controller[0]->name }}" style="width: 250px;height: 250px;"/>
            <div class="content-heading"><h4 class="card-title custom-h4">Controller {{$controller[0]->title." ".$controller[0]->name}} message</h4></div>
            <p class="text-justify custom-para">{{ $controller[0]->message }}</p>

            @else
            <p style="color: red;">No record found.</p>
          @endif
          <a href="{{ route('homepage') }}" class="btn btn-sm btn-outline-success float-right">Back</a>
        </div>    
    </div>
@endsection

@section('page-js-plugins')
   
@endsection
@section('custom-js')
    <script>
        /* ==== Custom Scripts Area ====*/
    	 $(document).ready(function($) {
         var footer = document.querySelector("#footer");
            footer.setAttribute('class','fixed-bottom');
       });
    </script>
@endsection