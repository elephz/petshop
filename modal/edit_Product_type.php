<div class="modal fade" id="editProduct_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b>ประเภทสินค้า</b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class=" animate py-4" action="" id="form-login" method="post">
            <div class="container">
            <label for="uname"><b>ชื่อประเภทสินค้า</b></label>
                <input type="text" class='loin-input input_edit_type_product'  name="uname" required>
                <input type="hidden" name="action" value="edit_product_type"> 
                <input type="hidden" id="edit_product_id" name="edit_product_id" value="">     
            <button class='btn btn-custom' id="btn_edit_type_product" >แก้ไข</button>
            </div>
        </form>
    </div>
  </div>
</div>