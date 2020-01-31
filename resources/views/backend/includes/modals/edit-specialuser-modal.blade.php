<div class="modal" id="edit<?php echo $user->id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title custom-title"><span style="color: #000;">Update Session :</span> {{$user->username}}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="{{ route('specialuser.update',['id'=>$user->id])}}" method="POST">
          {{ csrf_field() }}
               
          <div class="form-group">
            <label for="edit_specialuser" class="cus-label">Special Username</label>
            <input type="text" name="edit_specialuser" class="form-control" id="edit_specialuser" value="{{$user->username}}">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-success" id="btnSpecialUserUpdate" value="Update">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>