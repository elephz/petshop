<?php  ?>

<div class="container fixed-height">
    
    <div class="row mb-2">
        <div class="col text-center">
           <h4> <span>5 อันดับสินค้าขายดี</span> </h4>
       </div>
    </div>
<?php 
     $sql = "SELECT product_id,sum(qty) AS qty,sum(total) AS total,status FROM order_detail WHERE status!='1' GROUP BY product_id ORDER BY sum(total) DESC LIMIT 5";
     $qr = mysqli_query($con,$sql) or die (mysqli_error($con));
          
         
  
     
?>
<div class="row my-2">
    <div class="col text-right">
        <button class="btn-custom py-2 px-4 btntopdf_bestsale"><i class="fas fa-print"></i> PDF</button>
    </div>
</div>
    <div class="row">
        <table class="w-75 mx-auto " id="rp_tb_bestsale">
            <thead>
                <tr id="first_tr">
                    <th>ลำดับ</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>รวม</th>
                    <th >รายละเอียด</th>
                </tr>
            </thead>
                
            <tbody id="rp_bestsale">
                <?php $i=1; while($row = mysqli_fetch_assoc($qr)){   
                     
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
                    <td><?= $i++; ?></td>
                    <td><?= $rid; ?></td>
                    <td><?php 
                        $sql3 = "SELECT product_name FROM product WHERE product_id = '$id'";
                        $qr3 = mysqli_query($con,$sql3) or die (mysqli_error($con));
                        $row3 = mysqli_fetch_assoc($qr3);
                        echo $row3['product_name'];
                    ?></td>
                    <td><?= $row["qty"]; ?></td>
                    <td><?=  number_format($row["total"],2); ?></td>
                    <td><a href='' class='view_product mng-btn' data-toggle='modal' data-target='#viewProduct2' id='<?= $id; ?>' ><i class='fas fa-search'></i></a></td>
                 </tr>
                <?php 
             } ?>
            </tbody>
                
        </table>
    </div>
</div>
<?php include("../modal/viewProduct2.php"); ?>
<?php 
        // echo '<script type="text/javascript">';
        // echo "var show = '$show';"; 
        // echo '</script>';
        ?> 

<script src="../js/bestsale.js"></script>