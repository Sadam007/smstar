@extends('layouts.app')

@section('page-title')
<title> Exam Portal | Admin Dashbord </title>
@endsection

@section('custom-css')
    <style>
        /* ==== Custom Styles Area ====*/
        
    </style>
@endsection

@section('main')

        @include('backend.includes.components.header-component')

        {{-- @include('backend.includes.components.dashboard.stats-component') --}}
             
        {{-- @include('backend.includes.components.dashboard.charts-component') --}}
        
        {{-- @include('backend.includes.components.dashboard.projects-todo-component') --}}

@endsection
@section('page-js-plugins')
    @include('backend.includes.components.scripts.dashboard-chart-component')
@endsection
@section('custom-js')
    <script>
        /* ==== Custom Scripts Area ====*/
        
    </script>
@endsection