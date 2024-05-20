
<div>
<div class="modal fade" id="view_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b>รายละเอียดการสั่งซื้อ</b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="grid_product">
                <div class="product_item">
                    <table class='mx-auto w-100'>
                        <thead>
                            <tr>
                                <th>
                                    รหัสสินค้า
                                </th>
                                <th>
                                    ชื่อสินค้า
                                </th>
                                <th>
                                    ราคา
                                </th>
                                <th>
                                    โปรโมชัน
                                </th>
                                <th>
                                    จำนวน
                                </th>
                                <th>
                                    รวม
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tb_view_order">
                            
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan='5' style="text-align:left">
                                    <span>รวม</span>
                               </td> 
                               <td  style="text-align:right">
                                    <span id='total_modal'></span>
                               </td> 
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="product_item">
                        <p> <span><b> รหัสการสั่งซื้อ : </b></span> <span id="modal_orid"></span></p>
                        <p > <span> <b> สถานะ : </b> </span> <span id="modal_stt"></span> </p> 
                        <p > <span> <b> วันที่ทำงานรายการ : </b> </span> <br> <span id="modal_date"></span> </p>
                        <p > <span> <b> รหัสสมาชิก : </b> </span> <span id="modal_id"></span> </p> 
                       <p> <span> <b> เบอร์โทร </b> </span> <br> <span id="modal_phone"></span> </p>
                       <p> <span> <b> ที่อยู่ </b> </span>  <br><span id="modal_address"></span></p> 
                </div>
            </div>
            <div class="row mt-3 rowpaystt mx-2">
               <div class="btm_content">
                   
               </div>
            </div>  
    </div>
  </div>
</div>
</div>