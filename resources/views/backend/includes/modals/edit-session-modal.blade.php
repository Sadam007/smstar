<div class="modal" id="edit<?php echo $sess->id;?>">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
          <h4 class="modal-title custom-title"><span style="color: black;">Update Session :</span> {{$sess->session}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form action="{{ route('sessionupdate',['id'=>$sess->id])}}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group">
              <label for="tf1" class="cus-label">Session Code</label>
              <input type="number" name="sessionCode" class="form-control" id="tf1" aria-describedby="tf1Help" value="{{$sess->sessionCode}}">
          </div>
          <div class="form-group">
              <label for="tf1" class="cus-label">Session</label>
              <input type="text" name="session" class="form-control" id="tf1" aria-describedby="tf1Help" value="{{$sess->session}}">
          </div>
          <div class="form-group">
              <label for="tf1" class="cus-label">Status</label>
              <input type="number" name="status" class="form-control" id="tf1" aria-describedby="tf1Help" value="{{$sess->status}}">
          </div>
          <div class="form-group">
              <input type="submit" class="btn btn-success" id="tf1" aria-describedby="tf1Help" value="Update">
          </div>
      </form>
  </div>
</div>
</div>
</div>