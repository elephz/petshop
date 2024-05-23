<?php  ?>

<div class="container fixed-height">
    
    <div class="row mb-2">
        <div class="col text-center">
           <h4> <span>5 อันดับสินค้าขายดี</span> </h4>
       </div>
    </div>
<?php 
     $sql = "SELECT product.product_id,sum(order_detail.qty) AS qty,sum(order_detail.total) AS total,order_detail.status, product.product_name as product_name 
            FROM order_detail 
                INNER JOIN product on product.product_id = order_detail.product_id 
            WHERE status!='1' GROUP BY order_detail.product_id 
            ORDER BY sum(total) DESC LIMIT 5;";
     $qr = mysqli_query($con,$sql) or die (mysqli_error($con));
     
?>
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
                         echo $row['product_name'];
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