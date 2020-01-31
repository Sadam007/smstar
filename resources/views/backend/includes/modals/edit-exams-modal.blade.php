<div class="modal" id="edit<?php echo $exam->exam_id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title custom-title" title="{{ $exam->description }}">
          <span style="color: #000;">Update Session :</span> 
          {{ str_limit($exam->description,70 ) }}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('examupdate',['id'=>$exam->exam_id])}}" method="POST">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label for="editExamcode" class="cus-label">Exam Code</label>
            <input type="text" name="editExamcode" class="form-control" id="editExamcode" value="{{$exam->examcode}}">
          </div>
          <div class="form-group">
            <label for="editExamname" class="cus-label">Exam Name</label>
            <input type="text" name="editExamname" class="form-control" id="editExamname" value="{{$exam->description}}">
          </div>
          <div class="form-group">
            <label for="editExamtype" class="cus-label">Exam Type</label>
            <input type="text" name="editExamtype" class="form-control" id="editExamtype" value="{{$exam->type}}">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-success" id="btnExamUpdate" value="Update">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>