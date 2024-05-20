
<?php 
$sql = "SELECT * FROM  product_type";
         $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
         ?>
  <style>
      label{
        float: left;
      }
  </style>
  <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b>แก้ไขสินค้า</b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="grid-82">
            <div class="grid-item">
                <form class="animate py-4" action="../api/editProduct.php" id="form-newproduct" method="post" enctype="multipart/form-data">
                    <div class="container">
                    <label for="uname" style="text-align:left;"><b>ชื่อสินค้า</b></label>
                        <input type="text" class='loin-input ' id="ed_productname"  name="ed_productname" required>

                        <div class="form-group">
                            <label for="ed_product_type"> <b> ประเภทสินค้า </b></label>
                            <div class="id-100">
                                <select class="loin-input" name="product_type" id="ed_product_type">
                                    <?php while($row = mysqli_fetch_assoc($qr)){ ?>
                                    <option class='rist-producttype' value="<?php echo $row["product_type_id"] ; ?>"><?php echo $row["product_type_name"] ; ?></option>
                                    <?php  }?> ?>
                                </select>
                            </div>
                        </div>

                    <label for="uname"><b>ราคาสินค้า</b></label>
                        <input type="number" class='loin-input ' id="ed_price"  name="ed_price" >

                    <label for="uname"><b>จำนวนสินค้า</b></label>
                        <input type="number" class='loin-input ' id="ed_qty"  name="ed_qty" >

                    <label for="uname"><b>รายละเอียดสินค้า</b></label>
                        <textarea rows="4" cols="50"  id="ed_detail"  name="ed_detail" class='loin-input' ></textarea>
                        <input type="hidden" id="hidden_id" name="id" value="">
                    
                        
                        <input type="file" name="photos[]" class='loin-input' id="photoimg" multiple="true" />
                    <button class='btn btn-custom float-left' >บันทึก</button>
                    </div>
                </form>
            </div>
            <div class="grid-item">
                <div class="edit-img">
                        
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
