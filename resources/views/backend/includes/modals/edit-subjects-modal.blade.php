<div class="modal" id="edit<?php echo $subject->subject_id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title custom-title" title="{{ $subject->Na }}">
          <span style="color: black;">Update Subject :</span> {{ str_limit($subject->Na,60) }}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('subjectupdate',['id'=>$subject->subject_id])}}" method="POST">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label for="tf1" class="cus-label">Subject Code</label>
            <input type="number" name="edit_subcode" class="form-control" id="tf1" aria-describedby="tf1Help" value="{{$subject->code}}">
          </div>
          <div class="form-group">
            <label for="tf1" class="cus-label">Subject Name</label>
            <input type="text" name="edit_subname" class="form-control" id="tf1" aria-describedby="tf1Help" value="{{$subject->Na}}">
          </div>
          <div class="form-group">
            <label for="tf1" class="cus-label">Subject Marks</label>
            <input type="number" name="edit_submarks" class="form-control" id="tf1" aria-describedby="tf1Help" value="{{$subject->Marks}}">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-success" id="tf1" aria-describedby="tf1Help" value="Update">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>