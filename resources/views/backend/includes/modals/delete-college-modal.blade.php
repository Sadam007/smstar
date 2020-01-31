<div class="modal fade" id="delete<?php echo $college->id;?>">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <h4 class="modal-title">
            <center>Are you sure to delete this item</center>
            </h4>
         </div>
         <div class="modal-footer">
            <div style="margin-top: 20px !important;">
               <a  href="{{route('college.delete',['id'=>$college->id])}}" data-id="<?php echo $college->id;?>" class="btn btn-sm btn-outline-primary  btn-del">Yes <i class="far fa fa-check" aria-hidden="true"></i>
               </a>
               <a type="button" class="btn btn-sm btn-outline-warning" data-dismiss="modal">Cancel <i class="fa fa-times" aria-hidden="true"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>