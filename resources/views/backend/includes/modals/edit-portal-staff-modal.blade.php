<div class="modal fade" id="edit<?php echo $user->pstaff_id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title custom-title" title="{{$user->title}}">
        <span style="color:black;" >Updating Portal Staff :</span>
        {{ $user->title . $user->name }}
        
        </h5>
      </div>
      <div class="modal-body">
        <form  id="addPortalStaffForm" action = "{{ route('editPortalStaffProcess') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    {{ csrf_field() }}
    <fieldset>
     <div class="form-group">
      <label class="col-form-label cus-label" for="edit_staff_title">Staff Title</label>
      <input type="text" name="edit_staff_title" class="form-control staff_title placeholder-shown"  id="staff_title" value="{{ $user->title }}"> 
      </div>

      <div class="form-group">
      <label class="col-form-label cus-label" for="edit_staff_name">Staff Name</label>
      <input type="text" name="edit_staff_name" class="form-control staff_name placeholder-shown" placeholder="Staff Name" id="staff_name" value="{{ $user->name }}"> 
      </div>
      <div class="form-group">
      <label class="col-form-label cus-label" for="edit_staff_email">Staff Email</label>
      <input type="email" name="edit_staff_email" class="form-control staff_email placeholder-shown" placeholder="Staff Name" id="staff_email" value="{{ $user->email }}"> 
      </div>
      <div class="form-group">
      <label class="col-form-label cus-label" for="edit_staff_designation">Staff Designation</label>
      <input type="text" name="edit_staff_designation" class="form-control staff_designation placeholder-shown" placeholder="Staff Designation" id="staff_designation" value="{{ $user->designation }}"> 
      </div>
      <div class="form-group">
        <label class="col-form-label cus-label" for="edit_staff_message">Message</label>
        <textarea  name="edit_staff_message" class="form-control staff_message placeholder-shown" id="staff_message">{{$user->message}}</textarea>
      </div>
      
      <div class="form-group">
        <label for="edit_avatar" class="cus-label">Update Profile Photo</label>
        <div class="custom-file">
          <input type="file" name="edit_avatar" class="custom-file-input" id="edit_avatar">
          <label class="custom-file-label" for="edit_avatar">Choose file</label>
        </div>
      </div>
      <div class="form-group">
         <label  class="cus-label">Profile Photo</label>
          <p>
            <img src="{{ $user->avatar }}" alt="Profile Image" class="image-fluid" style="width: 250px;height: 250px;">
          </p>
      </div>
      <div class="form-group">
      <div class="list-group-item d-flex justify-content-between align-items-center">
        <span style="margin-left: -15px;" class="cus-label">Portal Staff Status</span>
        <label class="switcher-control" style="margin-right: -12px;">
          <input type="checkbox" name="edit_is_active" class="switcher-input" checked="checked">
          <span class="switcher-indicator"></span>
        </label>
      </div>
    </div>
    <input type="hidden" name="edit_staffId" value="{{ $user->pstaff_id }}">
    <div class="form-group btn-toggle">
      <button type="submit" id="BtnSubmit" class="btn btn-primary">Update</button>
    </div>   
</fieldset>
<div id="loader"></div>
</form>
      </div>
      
    </div>
  </div>
</div>