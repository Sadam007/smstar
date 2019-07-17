@extends('layouts.secrecy')

@section('page-title')
<title> Exam Portal | Secrecy Users | Subject List</title>
@endsection

@section('theme-css-plugins')

<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
@endsection
@section('custom-css')
    <style>
        /* ==== Custom Styles Area ====*/
      .circle{
      width: 26px;
      height: 26px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      padding: 5px 8px;

    }
        
    </style>
@endsection

@section('main')

        @include('front.secrecyusers.components.header-component')
         <div class="page-inner">
        <header class="page-title-bar">
          <button type="button" class="btn btn-success btn-floated">
            <span class="fa fa-plus"></span>
          </button>
        </header>
        <div class="page-section">
          <section class="card card-fluid">
            <header class="card-header">
             <legend style="font-size: 20px;">
               Subjects
               <a href="{{ route('secdashboard') }}" style="height: " class="btn btn-outline-primary btn-sm float-right">
                <span class="fa fa-arrow-left"></span></a>
             </legend>
           </header>
           <div class="card-body">
            <div class="form-group">
              <div class="input-group input-group-alt">
                <div class="input-group-prepend">
                  <select class="custom-select">
                    <option selected> Filter By </option>
                    <option value="1"> Tags </option>
                    <option value="2"> Vendor </option>
                    <option value="3"> Variants </option>
                    <option value="4"> Prices </option>
                    <option value="5"> Sales </option>
                  </select>
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <span class="oi oi-magnifying-glass"></span>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="Search record"> </div>
                </div>
              </div>
              <div class="text-muted"> Showing {{ $subjects->firstItem() }} to {{ $subjects->lastItem() }} of {{$subjects->total()}} entries </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Code</th>
                      <th>Name </th>
                      <th>Semester </th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php //dd($subjects);?>
                    @if(count($subjects) > 0 )
                      @foreach($subjects as $subject)
                           <tr>
                            <td class="align-middle">
                              {{ $subject->code }}
                            </td>
                            <td class="align-middle">
                               <a href="{{ route('secrecy.examcenters',['code'=>$subject->code]) }}">   {{ $subject->Na }}
                                </a>
                            </td>
                            <td class="align-middle">
                              <a href="">
                                <span class="badge badge-primary circle">{{ $subject->semester_id }}</span>
                              </a>
                            </td>
                          </tr>
                        @endforeach
                        @else
                        <tr>
                          <td colspan="4">No Subject Found in this degree</td>
                        </tr>
                      @endif  
          
                  </tbody>
                </table>
              </div>
              <ul class="pagination justify-content-center mt-4">
                 <li class="page-item">
                  {{ $subjects->links() }}
                </li>             
              </ul>
            </div>

        

@endsection
@section('page-js-plugins')
    {{-- @include('backend.includes.components.scripts.dashboard-chart-component') --}}

    <script src="{{asset('backend/js/toastr.min.js')}}"></script>
@endsection
@section('custom-js')
    <script>
        /* ==== Custom Scripts Area ====*/
        @if (Session::has('success'))
		 toastr.success("{{Session::get('success')}}")
		@endif 
    </script>
@endsection
