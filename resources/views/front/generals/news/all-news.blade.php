@extends('layouts.master')

@section('page-title')
<title>University of Malakand | Exam Portal | All Published News</title>
@endsection

@section('page-css-plugins')
   <link href="{{asset('backend/css/fontawesome-all.min.css')}}" rel="stylesheet">
@endsection
@section('custom-css')
<style>
.card-header legend{
 margin-bottom: 0px !important;
}
.caption{
  color: #063;
  font-size: 18px;
  margin-left: 5px;
  font-weight: bolder;
}
#newsList li {
  font-size: 14px;
  font-weight: 600;
}
#newsList li .news-link{
  text-decoration: none;
}
.news-published,.list-group-item span:nth-child(2){
  color:#555;
  font-size: 13px;
}
.list-group-item span:nth-child(2){
  color: #063;
  font-weight: bolder;
  opacity: .9;
}
.err{
  color: red;
  font-weight: bolder;
}
.blinkk{
  color: red;
 }


</style>
@endsection



@section('main')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <section id="base-style" class="card">
        <header class="card-header">
          <legend>
            <span class="caption">News Updates</span>
          </legend>
        </header>
        <div class="card-body">
          <ul class="list-group" id="newsList">
          @if(count($allNews ) > 0)
            @foreach($allNews  as $news)
              <li class="list-group-item">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-9">
                    <a href="{{ route('news.show',['id'=>$news->news_id]) }}" class="news-link">
                      <i class="fa fa-star blink_me"></i>&nbsp;&nbsp;
                        {{ ucwords(str_limit($news->title,100))}}
                      </a>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-3">
                    {{-- $news->published_on --}}
                    <strong class="news-published">Published On : </strong> {{$news->published_on}}
                  </div>
                </div>
               
                 </li>

            @endforeach
            @else
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-9">
                <ul class="list-group">
                  <li class="list-group-item err"> No News are available.</li>
                </ul>
               
              </div>
            </div>
          @endif
        </ul> 
        <ul class="pagination justify-content-center mt-4">
          <li class="page-item">
            {{ $allNews->links() }}
          </li>
        </ul>
        </div>
        <header class="card-header">
          <legend>
            <span class="caption">News Archieves</span>
          </legend>
        </header>
        <div class="card-body">
          <ul class="list-group" id="newsList">
          @if(count($allNews1 ) > 0)
            @foreach($allNews1  as $news1)
              <li class="list-group-item">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-9">
                    <a href="{{ route('news.show',['id'=>$news1->news_id]) }}" class="news-link">
                      <i class="fa fa-star blinkk"></i>&nbsp;&nbsp;
                        {{ ucwords(str_limit($news1->title,100))}}
                      </a>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-3">
                    <strong class="news-published">Published On : </strong> {{$news1->published_on}}
                  </div>
                </div>
              </li>
            @endforeach
            @else
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-9">
                <ul class="list-group">
                  <li class="list-group-item err"> No archieves.</li>
                </ul>
               
              </div>
            </div>
          @endif
        </ul> 
        <ul class="pagination justify-content-center mt-4">
          <li class="page-item">
            {{ $allNews1->links() }}
          </li>
        </ul>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection

@section('page-js-plugins')
   
@endsection
@section('custom-js')
    
<script>
 
</script>

@endsection