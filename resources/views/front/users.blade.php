@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | College</title>
@endsection

@section('page-css-plugins')
<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/fontawesome-all.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('front/css/animate.min.css') }}">
@endsection
@section('custom-css')
<style>
/* ==== Custom Styles Area ====*/

.btn-primary:hover,
.btn-primary:focus {
    background-color: #2E5F9B;
    border-color: #2E5F9B;
    box-shadow: none;
    outline: none;
}

.btn-primary {
    color: #fff;
    background-color: #063;
    border-color: #063;
    font-size: 15px;
    letter-spacing: 1px;  
}

section {
    padding: 0px 0;
}

section .section-title {
    text-align: center;
    color: #063;
    margin-bottom: 50px;
    text-transform: uppercase;
}

.image-flip:hover .backside,
.image-flip.hover .backside {
    -webkit-transform: rotateY(0deg);
    -moz-transform: rotateY(0deg);
    -o-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    transform: rotateY(0deg);
    border-radius: .25rem;
}


.mainflip {
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -ms-transition: 1s;
    -moz-transition: 1s;
    -moz-transform: perspective(1000px);
    -moz-transform-style: preserve-3d;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
    position: relative;
}

.frontside {
    position: relative;
    -webkit-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    z-index: 2;
    margin-bottom: 30px;
}



.frontside,
.backside {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -moz-transition: 1s;
    -moz-transform-style: preserve-3d;
    -o-transition: 1s;
    -o-transform-style: preserve-3d;
    -ms-transition: 1s;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
}

.frontside .card,
.backside .card {
    min-height: 312px;
}

.frontside .card .card-title,
.backside .card .card-title {
    color: #063 !important;
    font-size: 15px;
    text-transform: uppercase;
    font-weight: bold;
    letter-spacing: 1px;
}

.frontside .card .card-body img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
}
.card-text {
  font-size: 15px;
  text-transform: capitalize;
  font-weight: 600;
}

.animatedd {
  animation-duration: 2s;
}

</style>
@endsection



@section('main')
<section id="team" class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="{{ asset('assets/images/college/clerkProfile.png') }}" alt="card image"></p>
                                    <h4 class="card-title">Secrecy Login</h4>
                                    <p class="card-text">Secrecy Login area.</p>
                                    <a href="{{ route('secrecyuser.login') }}" class="btn btn-primary btn-sm">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="{{ asset('assets/images/college/colAdmin.png') }}" alt="card image"></p>
                                    <h4 class="card-title">Department Admin</h4>
                                    <p class="card-text">Department Admin login area.</p>
                                    <a href="{{ route('specialuser.login') }}" class="btn btn-primary btn-sm">Login</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="{{ asset('assets/images/college/graduatinCap.jpg') }}" alt="card image"></p>
                                    <h4 class="card-title">Degree Admin</h4>
                                    <p class="card-text">Degree Admin Login Area.</p>
                                    <a href="{{ route('degadmin.login') }}" class="btn btn-primary btn-sm">Login</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="{{ asset('assets/images/college/techLogin.png') }}" alt="card image"></p>
                                    <h4 class="card-title">Teachers Login</h4>
                                    <p class="card-text">Teachers Login area.</p>
                                    <a href="{{ route('teacher.create') }}" class="btn btn-primary btn-sm">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="{{ asset('assets/images/college/studentLogin.png') }}" alt="card image"></p>
                                    <h4 class="card-title">Students Login</h4>
                                    <p class="card-text">Students Login area.</p>
                                    <a href="{{ route('login.student') }}" class="btn btn-primary btn-sm">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="{{ asset('assets/images/college/clerkProfile.png') }}" alt="card image"></p>
                                    <h4 class="card-title">Clerk Login</h4>
                                    <p class="card-text">Clerk Login area.</p>
                                    <a href="{{ route('clerk.login') }}" class="btn btn-primary btn-sm">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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

    $(document).ready(function($) {
      $('.card-body').on('mouseover',function(event) {
        event.preventDefault();
        $(this).addClass('animated animatedd heartBeat')
    });

      $('.card-body').on('mouseout',function(event) {
        event.preventDefault();
        $(this).removeClass('animated animatedd heartBeat')
    });
  });
</script>
@endsection