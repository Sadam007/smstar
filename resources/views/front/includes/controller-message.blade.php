<div class="col-xs-12 col-sm-12 col-md-4" id="sidebar" >
	<div class="card">
    <div class="card-body">

      @if(count($controller) > 0)
    	<h4 class="card-title custom-h4">Controller {{$controller[0]->title." ".$controller[0]->name}} message</h4>
    	<img class="img-fluid mx-auto d-block" src="{{ $controller[0]->avatar }}" alt="Controller Image" style="width: 200px;height: 200px;border-radius: 50%;">
      
      <p class="card-text text-justify">
      	{{ str_limit($controller[0]->message,250) }}
      </p>
        @if(strlen($controller[0]->message) > 100)
        <a href="{{ route('controller.details') }}" class="btn btn-outline-success btn-sm">Read More</a>
        @endif
      @else
      <p style="color: red;">No record found.</p>

      @endif
    </div>
  </div>
</div>