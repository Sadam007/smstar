<div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="newsModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h5 class="modal-title" id="newsModalTitle">News Updates</h5> 
          <div class="float-right">
            <a href="{{ route('all.news') }}" style="color:white;text-decoration: none;">All News</a>
            <button type="button" id="btnNewsClose" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button> 
          </div>
      </div>
      <div class="modal-body">
        <ul class="list-group" id="newsList">

          @if(count($news) > 0)
            @foreach($news as $new)

              <li class="list-group-item">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-8">
                    <a href="{{ route('news.show',['id'=>$new->news_id]) }}" class="news-link">
                      <i class="fa fa-star blink_me"></i>&nbsp;&nbsp;
                        {{ ucwords(str_limit($new->title,50))}}
                      </a>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4 custom-query">
                    <strong class="news-published">Published On : </strong> {{$new->published_on}}
                  </div>
                </div>
               
                 </li>
            @endforeach

            @else
            <li class="list-group-item">
              <a href="#" class="news-link">No published news.</a>
            </li>

          @endif  

        </ul>
      </div>
    </div>
  </div>
</div>