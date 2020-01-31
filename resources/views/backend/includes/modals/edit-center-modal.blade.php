<div class="modal" id="edit<?php echo $center->ccode_id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title custom-title"><span style="color: #000;">Update Session :</span> 
          {{$center->cname}}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('centerupdate',['id'=>$center->ccode_id])}}" method="POST">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label for="centerCode" class="cus-label">Center Code</label>
            <input type="number" name="centerCode" class="form-control" id="centerCode" value="{{$center->ccode}}">
          </div>
          <div class="form-group">
            <label for="centerName" class="cus-label">Name</label>
            <input type="text" name="centerName" class="form-control" id="centerName" value="{{$center->cname}}">
          </div>
          <div class="form-group">
            <label for="centerName" class="cus-label">Examcode</label>
            <input type="text" name="centerEcode" class="form-control" id="centerEcode" value="{{$center->examcode}}">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-success" id="btnCenterUpdate" value="Update">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>