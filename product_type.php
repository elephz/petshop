<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("cdn.php"); ?>
    <link rel="stylesheet" href="css/main.scss">
    <link rel="stylesheet" href="css/cart.scss">
    <link rel="stylesheet" href="css/product_type.scss">
   <style>
       .grid-area{
            grid-template-columns:  1fr 1fr 1fr 1fr !important;
       }
   </style>
</head>
<body>
    <?php include("header.php"); ?> 
    <div class="contentz">
    <?php include("modal/loginmodal.php"); ?>

<?php   
    $type = "all";
    if(isset($_GET['T'])){
        $type = $_GET['T'];
    }
    $sql = "SELECT * FROM  product_type";
    $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));

    $sql2 = "SELECT * FROM  product_type";
    $qr2 = mysqli_query($con,$sql2) or die ('error. '. mysqli_error($con));

    
    $sql_item3 = "SELECT * FROM product LEFT JOIN img on product.product_id = img.ref_id  GROUP BY product.product_id";
    $qr_item3 = mysqli_query($con,$sql_item3) or die ('error. '. mysqli_error($con));
    
?>
    <div class="container mt-5 ">
        <div class="bs-example mx-auto">
            <ul class="nav nav-tabs ">
            <li class="nav-item">
                    <a href="#pall" class="nav-link <?php if($type == "all"){echo "active" ;} ?> " data-toggle="tab">ทั้งหมด</a>
                </li>
                <?php $i = 1;  while($row = mysqli_fetch_assoc($qr)){ ?>
                <li class="nav-item">
                    <a href="#<?php echo "p".$row['product_type_id'] ?>" class="nav-link <?php if($type == $row['product_type_id']){echo "active" ;} ?>" data-toggle="tab"><?php echo $row['product_type_name'] ?></a>
                </li>
                <?php $i++; } ?>
            </ul>
        </div>
    </div>
    <div class="container my-5">
    <div class="tab-content">




    <div class="tab-pane fade show <?php if($type == "all"){echo "active" ;} ?>" id="pall">
            <div class="grid-area">
            <?php
               while($all_item = mysqli_fetch_assoc($qr_item3)){
             ?>
              <?php if($all_item['product_id'] != ""){ ?>
                <div class="grid-item">
                    <div class="out-img example example-cover">
                        <?php if($all_item['img_name'] == ""){ ?>
                        <img class="d-block w-100" src="uploads/defalitem.jpg">
                        <?php }else{?>
                            <img class="d-block w-100" src="uploads/<?php echo $all_item['img_name'] ?>">
                        <?php }?>

                        <div class="btm-producttab">
                           <b> <span class="add-item" img="<?php echo $all_item['img_name'] ?>" id="<?php echo $all_item['product_id'] ?>" name="<?php echo $all_item['product_name'] ?>" price="<?php echo $all_item['price'] ?>" ><i class="fas fa-cart-plus"></i> เพิ่มลงตะกร้า</span> </b>
                        </div>

                        <div class="btm-product-top">
                           <b> <span class="view-item" id="<?php echo $all_item['product_id'] ?>"   ><i class="fas fa-search"></i> </span> </b> <br>
                           <b> <span class="like-item" lid="<?php echo $all_item['product_id'] ?>"> <i class="fas fa-heart"></i> </span> </b>
                        </div>
                        <?php if($all_item['promotion'] != "0"){
                            ?>
                        <div class="promo">
                            ลด<br><?php echo $all_item['promotion'];  ?>
                        </div>
                        <?php } ?>
                    </div>
                    <p><?php echo $all_item['product_name'] ;?> </p>
                    <p style="text-align:right"><?php echo number_format($all_item['price'],2)."บาท"; ?></p>
                </div>
                <?php }?>
            <?php }?>
            
            </div>
        </div>






    <?php $i = 1;  while($row2 = mysqli_fetch_assoc($qr2)){ ?>
        <div class="tab-pane fade show <?php if($type == $row2['product_type_id']){echo "active" ;} ?>" id="<?php echo "p".$row2['product_type_id'] ?>">
            <div class="grid-area">
            <?php
                $pdt = $row2["product_type_id"];
                $sql_item = "SELECT * FROM product LEFT JOIN img on product.product_id = img.ref_id WHERE product.product_type_id = '$pdt' GROUP BY product.product_id ";
                $qr_item = mysqli_query($con,$sql_item) or die ('error. '. mysqli_error($con));
                while($item = mysqli_fetch_assoc($qr_item)){

             ?>
              <?php if($item['product_id'] != ""){ ?>
                <div class="grid-item">
                    <div class="out-img example example-cover">
                        <?php if($item['img_name'] == ""){ ?>
                        <img class="d-block w-100" src="uploads/defalitem.jpg">
                        <?php }else{?>
                            <img class="d-block w-100" src="uploads/<?php echo $item['img_name'] ?>">
                        <?php }?>

                        <div class="btm-producttab">
                           <b> <span class="add-item" img="<?php echo $item['img_name'] ?>" id="<?php echo $item['product_id'] ?>" name="<?php echo $item['product_name'] ?>" price="<?php echo $item['price'] ?>" ><i class="fas fa-cart-plus"></i> เพิ่มลงตะกร้า</span> </b>
                        </div>

                        <div class="btm-product-top">
                           <b> <span class="view-item" id="<?php echo $item['product_id'] ?>"   ><i class="fas fa-search"></i> </span> </b> <br>
                           <b> <span class="like-item" lid="<?php echo $item['product_id'] ?>"> <i class="fas fa-heart"></i> </span> </b>
                        </div>
                        <?php if($item['promotion'] != "0"){
                            ?>
                        <div class="promo">
                            ลด<br><?php echo $item['promotion'];  ?>
                        </div>
                        <?php } ?>
                    </div>
                    <p><?php echo $item['product_name'] ;?> </p>
                    <p style="text-align:right"><?php echo number_format($item['price'],2)."บาท"; ?></p>
                </div>
                <?php }?>
            <?php }?>
            
            </div>
        </div>
    <?php $i++; } ?>
       

       

    </div>
    </div>  
</div>
    <?php include("footer.php"); ?>
</body>
<script src="js/index.js"></script>
<script src="js/register.js"></script>
<script src="js/cart.js"></script>
</html>