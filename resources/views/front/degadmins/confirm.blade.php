<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
</head>
<body>
  
  <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a>
  <div class="modal fade" id="modal-id">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script src="{{asset('backend/js/jquery.min.js')}}"></script>
  <script src="{{asset('backend/js/popper.min.js')}}"></script>
  <script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
</body>
</html>
