<?php 

$sql = "SELECT * FROM  product_type";
         $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
         ?>
         
            
          

<div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b>สินค้าใหม่</b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="animate py-4" action="../api/uploadProduct.php" id="form-newproduct" method="post" enctype="multipart/form-data">
            <div class="container">
            <label for="uname"><b>ชื่อสินค้า</b></label>
                <input type="text" class='loin-input '  name="uname" required>

                <div class="form-group">
                    <label for="exampleFormControlSelect1"> <b> ประเภทสินค้า </b></label>
                    <select class="loin-input" name="product_type" id="exampleFormControlSelect1">
                        <?php while($row = mysqli_fetch_assoc($qr)){ ?>
                        <option class='rist-producttype' value="<?php echo $row["product_type_id"] ; ?>"><?php echo $row["product_type_name"] ; ?></option>
                        <?php  }?> ?>
                    </select>
                </div>

            <label for="uname"><b>ราคาสินค้า</b></label>
                <input type="number" class='loin-input '  name="price" >

            <label for="uname"><b>จำนวน</b></label>
                <input type="number" class='loin-input '  name="qty" >
                
            <label for="uname"><b>รายละเอียดสินค้า</b></label>
                <textarea rows="4" cols="50" name="comment" class='loin-input' ></textarea>
            
                   
                <input type="file" name="photos[]" class='loin-input' id="photoimg" multiple="true" />
            <button class='btn btn-custom' id="btn_new_product" >บันทึก</button>
            </div>
        </form>
    </div>
  </div>
</div>

