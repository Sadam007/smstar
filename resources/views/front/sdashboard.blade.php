@extends('layouts.special')

@section('page-title')
<title> Exam Portal | Special Users Dashboard </title>
@endsection

@section('custom-css')
    <style>
        /* ==== Custom Styles Area ====*/
        
    </style>
@endsection

@section('main')

        @include('front.specialusers.components.header-component')

        

@endsection
@section('page-js-plugins')
    @include('backend.includes.components.scripts.dashboard-chart-component')
@endsection
@section('custom-js')
    <script>
        /* ==== Custom Scripts Area ====*/
        
    </script>
@endsection
