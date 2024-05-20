<div class="modal fade" id="edit_bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b>แก้ไขบัญชีธนาคาร</b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="animate py-4"  id="form-newproduct" method="post" >
            <div class="container">
            <label for="uname"><b>ชื่อธนาคาร</b></label>
                <input type="text" class='loin-input '  id="edit_bank_name" required>

            <label for="uname"><b>ประเภทบัญชี</b></label>
                <input type="text" class='loin-input '  id="edit_bank_type" required> 

            <label for="uname"><b>เลขบัญชี</b></label>
                <input type="text" class='loin-input '  id="edit_bank_number" >

            <label for="uname"><b>ชื่อ - สุกล</b></label>
                <input type="text" class='loin-input '  id="edit_ownner_number" >
              
                <input type="hidden" id="edit_bank_id" value="">
         
            <button class='btn btn-custom' id="edit_btn_new_bank" >บันทึก</button>
            </div>
        </form>
    </div>
  </div>
</div>