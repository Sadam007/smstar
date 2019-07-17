<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>University of Malakand | Exam Portal | Home Page</title>
        <link rel="icon"  href="{{asset('backend/images/favicon.ico')}}">
        <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}

        <!-- Styles -->
        <style>
            html,body{
                margin: 0;
                padding: 0;
            }
            body{
                background: #f5f5f5;
            }
            .navbar{
                background: #2E5F9B !important;

            }
            .navbar-brand{
                color: white !important;
            }
            .navbar-nav li a{
                color: white !important;
            }
            .dropdown-menu{
                background: #2E5F9B !important;
            }
            .spacer{
                margin-top: 30px;
            }
           
            .banner{
                width: 100%;
                vertical-align: middle;
            } 
            .card{
                min-height: 400px;
            }
            .carousel-item img{
                width: 100%;
                height: 320px;
                object-fit: cover;
            }
            #footer{
                background: #143a66 !important;

            }
            #footer a{
                padding-top: 5px;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
               <a class="navbar-brand" href="/">Exam Portal</a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                          <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                        </div>
                      </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" tabindex="-1">Downloads</a>
                    </li>
                </ul>
            </div>
            </div>
        </nav>
        <div class="clearfix"></div>
        <div class="spacer"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 hidden-print">
                    <a href="/">
                    <img class="img-responsive banner" style="" src="{{asset('assets/images/banner.jpg')}}" alt="" title="" />
                </a>
            </div>  
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="spacer"></div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4" id="sidebar">
                    <div class="card p-3">      
                        <div class="card-block">
                            <h4 class="card-title">Controller Message</h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Read More...</a>
                        </div>
                            </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="card p-3">
                        <div class="card-block">
                                    <h4 class="card-title">Slide Show</h4>
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="0"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="0"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img src="{{asset('assets/images/slider/image1.jpg')}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('assets/images/slider/image2.jpg')}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset('assets/images/slider/image5.jpg')}}" alt="First slide">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="icon-prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                                </div>
                            </div>
                </div>
            </div>        
        </div>
        <div class="clearfix"></div>
        <div class="spacer"></div>
        <footer class="navbar navbar-expand-lg navbar-light bg-light" id="footer">
            <div class="container">
                <div class="row text-center">
                <a href="/" style="color:#fff;">Copyright &copy; <?= date('Y'); ?> University of Malakand</a>
            </div>
            </div>
        </footer>
        <script src="{{asset('backend/js/jquery.min.js')}}"></script>
        <script src="{{asset('backend/js/popper.min.js')}}"></script>
        <script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
    </body>
</html>
