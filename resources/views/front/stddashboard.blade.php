@extends('layouts.student')

@section('page-title')
<title> Exam Portal | Student Dashboard </title>
@endsection

@section('custom-css')
    <style>
        /* ==== Custom Styles Area ====*/
        
    </style>
@endsection

@section('main')

        @include('front.students.components.header-component')

        

@endsection
@section('page-js-plugins')
    @include('backend.includes.components.scripts.dashboard-chart-component')
@endsection
@section('custom-js')
    <script>
        /* ==== Custom Scripts Area ====*/
        
    </script>
@endsection
