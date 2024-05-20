<div>
<div class="modal fade" id="addpromotion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b>เพิ่มโปรโมชัน</b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="animate py-4 w-50 mx-auto"  id="form-newproduct" method="post" >
                
                <label for="uname"><b>ส่วนลด</b></label>
                    <input type="number" class='loin-input '  id="amount_sale" >

                <div class="form-group">
                    <label for="exampleFormControlSelect1"> <b> ลดเป็น </b></label>
                    <select class="loin-input" id="sale_type" name="product_type" id="exampleFormControlSelect1">
                        <option class='rist-producttype' value="%">%</option>
                        <option class='rist-producttype' value="฿">฿</option>
                    </select>
                </div>
                    <input type="hidden" id='promotion_product_id' val="">
                    <button class='btn btn-custom' id="btn_savepromotion" >บันทึก</button>
            </form>
    </div>
    <div class="modal-footer">
        <div class="remove_promotion_area">

        </div>
      </div>
  </div>
</div>
</div>