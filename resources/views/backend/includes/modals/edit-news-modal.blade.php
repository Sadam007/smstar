<div class="modal fade" id="edit<?php echo $new->news_id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title custom-title" title="{{$new->title}}">
        <span style="color:black;" >Updating News :</span>
        {{ str_limit($new->title,70) }}
        
        </h5>
      </div>
      <div class="modal-body">
        <form  id="editNewsForm" action = "{{ route('editNewsProcess') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label class="col-form-label cus-label" for="editNewsTitle">Title</label>
            <input type="text" name="editNewsTitle" class="form-control news_title placeholder-shown"  id="editNewsTitle" value="{{ $new->title }}">
          </div>
          <div class="form-group">
            <label class="col-form-label cus-label" for="editNewsBody">Body</label>
            <textarea  name="editNewsBody" class="form-control newsBody placeholder-shown" id="editNewsBody">{{ $new->body }}</textarea>
          </div>
          <div class="form-group">
            <label for="tf4" class="cus-label">File input</label>
            <div class="custom-file">
              <input type="file" name="editNewsAttachments[]" class="custom-file-input" id="tf4" multiple>
              <label class="custom-file-label" for="tf4">Choose file</label>
            </div>
          </div>
          <div class="form-group">
            <label  class="cus-label">Attachments</label>
            <ul class="list-inline">
              @php
              $counter = 1;
              $filesCount = json_decode($new->attachment);
              @endphp
              @if(count($filesCount) > 0)
              @foreach(json_decode($new->attachment) as $new1)
              <li class="list-inline-item">
                <a href="{{  URL::to('documents/news/'.$new1) }}" target="_blank" class="btn btn-outline-success">View File {{ $counter++ }}</a>
              </li>
              
              @endforeach
              @else
              <h3 class="heading-h3">No Attachment.</h3>
              @endif
              
            </ul>
          </div>
          <div class="form-group">
            <div class="list-group-item d-flex justify-content-between align-items-center">
              <span style="margin-left: -15px;" class="cus-label">Status</span>
              <label class="switcher-control" style="margin-right: -12px;">
                <input type="checkbox" name="newsStatus" class="switcher-input" checked="checked">
                <span class="switcher-indicator"></span>
              </label>
            </div>
          </div>
          <input type="hidden" name="editNewsId" value="{{ $new->news_id }}">
          <div class="form-group btn-toggle">
            <button type="submit" id="editNewsSubmit" class="btn btn-success">Update</button>
          </div>
          
          <div id="loader"></div>
        </form>
      </div>
      
    </div>
  </div>
</div>