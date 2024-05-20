<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("cdn.php"); ?>
    <link rel="stylesheet" href="css/main.scss">
    <link rel="stylesheet" href="css/product.scss">
</head>
<body>
    <?php include("header.php"); ?> 
    <div class="contentz">
    <?php include("modal/loginmodal.php"); 
     if(isset($_GET['P'])){
      $type = $_GET['P'];
      $sql9 = "SELECT * FROM product LEFT JOIN img on product.product_id = img.ref_id WHERE product.product_id = '$type' GROUP BY product.product_id";
    $qr9 = mysqli_query($con,$sql9) or die ('error. '. mysqli_error($con));
    $row9 = mysqli_fetch_assoc($qr9);
    
}
?>

<div class="container mt-5 my-5">
        
        <div class="row">
        <!-- drop zone -->
            <div class="col-md-7">
                <div class="product_item">
                    <span id="product_left1"></span>
                </div>
            </div>
                <div class="col-md-5">
                    <?php 
                    $num = $row9['product_id'];
                        if($num < 10){
                            $num = "P000".$num;
                        }else if($num < 100){
                            $num = "P00".$num;
                        }else if($num < 1000){
                            $num = "P0".$num;
                        }

                        if($row9['qty'] > 0){
                            $stt = "<span>มีสินค้า</span>";
                        }else{
                            $stt = "<span style='color:red'>สินค้าหมด</span>";
                        }
                      
                    ?>
                        <p> <span><b> รหัสสินค้า : </b></span> <span><?php echo $num;  ?></span></p>
                   
                    
                        <p > <span> <b> ชื่อสินค้า : </b> </span>      <span><?php echo $row9['product_name']; ?> </span> </p> 
                        <p > <span> <b> ประเภทสินค้า : </b> </span>   <span> </span> <?php echo $row9['product_type_id']; ?></span> </p> 
                        <p > <span> <b> โปรโมชัน : </b> </span>        <?php if($row9['promotion'] == "0"){echo "สินค้าไม่มีโปรโมชัน" ;}else{ echo "ลด".$row9['promotion']; } ?>   <span> </span> </p> 
                        <p > <span> <b> ราคา : </b> </span>           <span> <?php echo number_format($row9['price'],2)." บาท"; ?></span> </p> 
                        <p > <span> <b> สถานะ : </b> </span>           <span> <?php echo $stt; ?> </p>
                       <p> <span> <b> รายละเอียดสินค้า </b> </span> </p> <span ><?php echo $row9['product_description']; ?> </span>
                        <br><button class='btn-custom add-item mt-2'
                        img="<?php echo $row9['img_name'] ; ?>"
                        id="<?php echo $row9['product_id'] ; ?>"
                        name="<?php echo $row9['product_name']; ?>"
                        price="<?php echo $row9['price']; ?>"
                         style="padding:15px 25px;" >เพิ่มในตระกร้าสินค้า</button>
                </div>
           
           <!-- drop zone -->
        </div>
        <div class="row mt-3">
            <div class="grid-item-gp">
            </div>
        </div>
    </div>
</div>
    <?php include("footer.php"); ?>
    <?php 
        echo '<script type="text/javascript">';
        echo "var id = '$type';"; 
        echo '</script>';
        ?> 
</body>

<script src="js/index.js"></script>
<script src="js/register.js"></script>
<script src="js/cart.js"></script>
<script>
$(document).ready(function(){ 
    getoneproduct();
    function getoneproduct(){
        $("#product_left1").html("");
        $(".grid-item-gp").html("");
        $.post("api/api.php",{action:"get_one_product",id:id},function(res){
            let ps =$.parseJSON(res);
            let left = ps.left;
            $("#product_left1").append("<img src='uploads/"+((isEmpty(left))? "defalitem.jpg" : left[0].img_name)+"'  class='w-100  head_img' alt=''>");
            $.each(ps.left,function(k,v){
            $(".grid-item-gp").append("<img src='uploads/"+v.img_name+"'  class='img-grall product_imd'  alt=''>");
        });
        });
    }
    $("body").on("click",".product_imd",function(e){
    
    let data = $(this).attr("src");
    console.log(data);
    $("#product_left1").html("");
   
    $("#product_left1").append("<img src='"+data+"'  class='w-100 head_img' alt=''>")
   
});
function isEmpty(obj) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
      }
});
</script>
</html>