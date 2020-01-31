<div class="modal" id="edit<?php echo $degree->id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title custom-title" title="{{ $degree->Det1 }}">
          <span style="color: black;">Update Degree :</span> {{ str_limit($degree->Det1,60) }}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('degreeupdate',['id'=>$degree->id])}}" method="POST">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label for="tf1" class="cus-label">Degree Code</label>
            <input type="number" name="DegCode" class="form-control" id="tf1" aria-describedby="tf1Help" value="{{ $degree->DegCode }}">
          </div>
          <div class="form-group">
            <label for="tf1" class="cus-label">Degree Title</label>
            <input type="text" name="Det1" class="form-control" id="tf1" aria-describedby="tf1Help" value="{{ $degree->Det1 }}">
          </div>
          @php
          $degYears   = $degree->degYears;
          $selected  = "selected";
          @endphp
          <div class="form-group">
            <label for="degYears" class="cus-label">Degree Years</label>
            <select class="custom-select" name="degYears" id="degYears" required>
              <option value=""> select an option </option>
              <option value="2" <?php echo ($degYears==2 ? $selected : '');?>> 2</option>
              <option value="4" <?php echo ($degYears==4 ? $selected : '');?>> 4</option>
              <option value="5" <?php echo ($degYears==5 ? $selected : '');?>> 5</option>
            </select>
          </div>
          
          <div class="form-group">
            <input type="submit" class="btn btn-success" id="tf1" aria-describedby="tf1Help" value="Update">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>