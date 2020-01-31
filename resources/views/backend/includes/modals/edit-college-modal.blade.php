<div class="modal" id="edit<?php echo $college->id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title custom-title" title="{{ $college->name }}">
          <span style="color: black;">Update Session :</span> {{ str_limit($college->name,70)}}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('college.update',['id'=>$college->id])}}" method="POST" autocomplete="off">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label for="editCollegeName" class="cus-label">College Name</label>
            <input type="text" name="editCollegeName" class="form-control" id="editCollegeName" value="{{ $college->name }}">
          </div>
          <div class="form-group">
            <label for="editCollegeDistrict" class="cus-label">District</label>
            <input type="text" name="editCollegeDistrict" class="form-control" id="editCollegeDistrict" value="{{ $college->district }}" disabled>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-success" id="tf1"" value="Update">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>