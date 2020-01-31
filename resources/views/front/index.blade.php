@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | Home Page</title>
@endsection

@section('page-css-plugins')
   <link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
   <link href="{{asset('backend/css/fontawesome-all.min.css')}}" rel="stylesheet">
@endsection
@section('custom-css')
<style>
/* ==== Custom Styles Area ====*/
.carousel-caption{
  background: #000 !important;
  opacity: 0.7 !important;
  width: 100% !important;
  height: 30px;
  position: absolute;
  left: 0px;
  bottom: 0px;
}

 .carousel-caption h3{
  text-align: left;
  padding: 5px;
  font-size: 16px;
  top: 50%;
  transform: translateY(-50%);
  
}

.carousel-caption h3 a {
  text-decoration: none;
  color: white;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
  height: 50px;
  width: 50px;
  outline: #2e5f9b;
  background-size: 100%, 100%;
  border-radius: 50%;
  border: 1px solid #2e5f9b;
  background-image: none;
  background: #2e5f9b;
}

.carousel-control-next-icon:after
{
  content: '>';
  font-size: 30px;
  color: white;
}

.carousel-control-prev-icon:after {
  content: '<';
  font-size: 30px;
  color: white;
}

/* .modal-content{
  background: rgba(2, 56, 122, 0.4);
  color: white;
} */

.modal-dialog {
    min-height: calc(100vh - 60px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: auto;
}
@media(max-width: 768px) {
  .modal-dialog {
    min-height: calc(100vh - 20px);
  }
}
.modal-header{
  background: #990033;
  outline: #990033;
  border-radius: 0;
}
#newsModalTitle{
  color: white;
  font-weight: normal;
  font-size: 1.25rem;
  letter-spacing: .9px;
}
#btnNewsClose span{
  color: white;
  font-weight: bolder !important;
}
.modal-body{
  height: 300px;
  overflow-y:auto;
  border-radius: 0;
}
#newsList li {
  font-size: 14px;
  font-weight: 600;
}
#newsList li .news-link{
  text-decoration: none;
}
.news-published,.list-group-item span:nth-child(2){
  color:#555;
  font-size: 13px;
}
.list-group-item span:nth-child(2){
  color: #063;
  font-weight: bolder;
  opacity: .9;
}
.custom-h4{
  font-size: 16px;
  font-weight: bold;
  text-transform: capitalize;
  color: #063;
}
</style>
@endsection



@section('main')
        @include('front.includes.controller-message')
        @include('front.includes.main-slider')
        @include('front.includes.news-modal')        
@endsection

@section('page-js-plugins')
   <script src="{{asset('backend/js/toastr.min.js')}}"></script>
@endsection
@section('custom-js')
    <script>
        /* ==== Custom Scripts Area ====*/
    	@if (Session::has('emailConfirm'))
		   toastr.success("{{Session::get('emailConfirm')}}")
		   @endif

       $(window).on('load',function(){
        $('#newsModal').modal('show');
    });
    </script>
@endsection