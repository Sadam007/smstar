@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | Home Page</title>
@endsection

@section('page-css-plugins')
   
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
   
@endsection
@section('custom-js')
    <script>
        /* ==== Custom Scripts Area ====*/
    
    </script>
@endsection