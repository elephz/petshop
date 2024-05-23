

<div class="container fixed-height">
    
    <div class="row mb-2">
        <div class="col text-center">
           <h4> <span>รายงานสินค้าคงเหลือ</span> </h4>
       </div>
    </div>
    <?php 
     $sql = "SELECT * FROM product ORDER BY qty ASC";
     $qr = mysqli_query($con,$sql) or die (mysqli_error($con));
          
         
  
     
?>
    <div class="row">
        <table class="w-75 mx-auto " id="leftinstock">
            <thead>
                <tr id="first_tr">
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                </tr>
            </thead>
                
            <tbody id="rp_leftinstock">
               <?php 
               while($row = mysqli_fetch_assoc($qr)){ 
                $id = $row['product_id'];
                $rid ;
                if($id < 10){
                   $rid = "P000".$id;
               }else if($id < 100){
                   $rid = "P00".$id;
               }else if($id < 1000){
                   $rid = "P0".$id;
               }
               ?>
                <tr>
                    <td><?= $rid; ?></td>
                    <td><?= $row['product_name']; ?></td>
                    <td><?= $row['qty']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
                
        </table>
    </div>
</div>

<?php 
        // echo '<script type="text/javascript">';
        // echo "var show = '$show';"; 
        // echo '</script>';
        ?> 

<script src="../js/leftinstock.js"></script>