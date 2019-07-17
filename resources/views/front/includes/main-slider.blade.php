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