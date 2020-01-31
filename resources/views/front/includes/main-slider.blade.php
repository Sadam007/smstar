<div class="col-xs-12 col-sm-12 col-md-8">
    <div class="card p-3">
        <div class="card-block">
            <h4 class="card-title custom-h4">Slide Show</h4>
            <div id="portalMainSlider" class="carousel slide" data-ride="carousel">
                <!-- <ol class="carousel-indicators">
                    <li data-target="#portalMainSlider" data-slide-to="0" class="active"></li>
                    <li data-target="#portalMainSlider" data-slide-to="0"></li>
                    <li data-target="#portalMainSlider" data-slide-to="0"></li>
                </ol> -->
                <div class="carousel-inner" role="listbox">
                    @if(count($slides) > 0)
                    @foreach($slides as $key => $slide)
                        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                            <img src="{{$slide->img}}" alt="{{$slide->caption}}">
                            <div class="carousel-caption">
                                <h3>{{ ucwords(str_limit($slide->caption,65)) }}
                                    &nbsp;
                                    <a href="{{ route('slide.show',['id'=>$slide->id]) }}" style="color:yellow;text-decoration: none;">Read More</a>
                                </h3>
                            </div>
                        </div>
                    @endforeach
                        @else
                        <div class="carousel-item active">
                            <img src="{{asset('assets/images/slider/image1.jpg')}}" alt="Default Slider Image">
                        </div>
                    @endif
                </div>
                <a class="carousel-control-prev" href="#portalMainSlider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon icon-common"></span>
                </a>
                <a class="carousel-control-next" href="#portalMainSlider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon icon-common"></span>
                </a>
            </div>
        </div>
    </div>
</div>