<div>
  <div class="modal fade" id="address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <b>ข้อมูลการจัดส่งสินค้า</b> </h5> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="modal-content animate py-4" id="add-form" action="" id="form-login" method="post">
              <div class="container">
              <label for="uname"><b>ชื่อ</b></label>
                  <input type="text" class='loin-input' id="ad_name"  name="add[]" >

              <label for="psw"><b>ที่อยู่</b></label>
                  <textarea rows="4" cols="50" name="add[]" id="ad_ad" class='loin-input' ></textarea>   

              <label for="uname"><b>เบอร์โทร</b></label>
                  <input type="text" class='loin-input' id="ad_phone"  name="add[]" > 
              <button class='btn btn-custom' type="submit" id='ad-save'>บันทึกข้อมูล</button>
              </div>
          </form>
        </div>
        <div class="modal-footer">
        
        </div>
      </div>
    </div>
  </div>
</div>