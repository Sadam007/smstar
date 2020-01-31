<div class="modal fade" id="edit<?php echo $slider->id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title custom-title" title="{{$slider->caption}}">
        <span style="color:black;" >Updating Slider :</span>
        {{ str_limit($slider->caption,70) }}
        
        </h5>
      </div>
      <div class="modal-body">
        <form  id="editSliderForm" action = "{{ route('editSliderProcess') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label class="col-form-label cus-label" for="editSliderTitle">Title</label>
            <input type="text" name="editSliderTitle" class="form-control sliderTitle placeholder-shown"  id="editSliderTitle" value="{{ $slider->caption }}">
          </div>
          <div class="form-group">
            <label class="col-form-label cus-label" for="editSliderBody">Body</label>
            <textarea  name="editSliderBody" class="form-control newsBody placeholder-shown" id="editSliderBody">{{ $slider->body }}</textarea>
          </div>
          <div class="form-group">
            <label class="col-form-label" for="editSliderLink">Link &nbsp; <span class="optional">(Optional)</span></label>
            <input type="text"  name="editSliderLink" class="form-control editSliderLink placeholder-shown" id="editSliderLink" value="{{ $slider->link }}">
          </div>
          <div class="form-group">
            <label for="tf4" class="cus-label">File input</label>
            <div class="custom-file">
              <input type="file" name="editiSliderImage" class="custom-file-input" id="tf4" multiple>
              <label class="custom-file-label" for="tf4">Choose file</label>
            </div>
          </div>
          <div class="form-group">
            <label  class="cus-label">Slider Photo</label>
          <p>
            <img src="{{ $slider->img }}" alt="Slider Image" class="image-fluid" style="width: 250px;height: 250px;">
          </p>
          </div>
          <div class="form-group">
            <div class="list-group-item d-flex justify-content-between align-items-center">
              <span style="margin-left: -15px;" class="cus-label">Status</span>
                @php
                  $status =  $slider->is_active;
                @endphp
              <label class="switcher-control" style="margin-right: -12px;">
                <input type="checkbox" name="editSliderStatus" class="switcher-input" {{ $status == 1 ? 'checked' : '' }}>
                <span class="switcher-indicator"></span>
              </label>
            </div>
          </div>
          <input type="hidden" name="editSliderId" value="{{ $slider->id }}">
          <div class="form-group btn-toggle">
            <button type="submit" id="editNewsSubmit" class="btn btn-success">Update</button>
          </div>
          
          <div id="loader"></div>
        </form>
      </div>
      
    </div>
  </div>
</div>