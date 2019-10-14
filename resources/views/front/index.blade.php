@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | Home Page</title>
@endsection

@section('page-css-plugins')
   <link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
@endsection
@section('custom-css')
<style>
/* ==== Custom Styles Area ====*/

</style>
@endsection



@section('main')
        @include('front.includes.director-message')
        @include('front.includes.main-slider')
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
    </script>
@endsection