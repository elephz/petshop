
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("cdn.php"); ?>
    <link rel="stylesheet" href="css/main.scss">
    <link rel="stylesheet" href="css/cart.scss">
</head>
<body>
    <?php 
    
    include("header.php");
    $item_stt = false;
    if(isset($_SESSION['cart'])){
        $item_stt = true;
    }
     ?> 
     <div class="contentz">
    <?php include("modal/loginmodal.php"); ?>

    <div class="container my-5 py-5" style="background:#F5F5F5">
        <div class="row" >
        <table class="w-100 my-5 mx-5" id="attendees">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th>ชื่อสินค้า</th>
                <th>ราคา</th>
                <th>โปรโมชัน</th>
                <th>จำนวน</th>
                <th>ผลรวม</th>
            </tr>
            </thead>
            <tbody id="tcard">
           
          
            </tbody>
            <tr style="line-height:18px;">
                <td colspan='6' style='text-align:left' > ผลรวมทั้งหมด  </td>
               
                <td style='text-align:right'>
                        <span id="fintal_total" ></span>
                </td>
            </tr>
            <tr  >
                <td colspan='2' style="border-right:1px solid #F5F5F5">
                  
                </td>
                <td colspan='1' style="text-align:left;border-right:1px solid #F5F5F5" >
                        
                </td>
                <td colspan='1' style="padding:50px;border-right:1px solid #F5F5F5" >
                       
                </td>
                <td colspan='3' style="text-align:center" >
                    <button data-toggle="modal" ssid="<?php echo $session_id ; ?>" btn-stt="<?php if($loged == true){echo "true";}else{echo "false";} ?>"  class='btn-custom mx-auto btn-address' style="padding:12px 30px;" >ที่อยู่ที่จัดส่ง</button>
                </td>
            </tr>
        </table>
        </div>
        <div class="row">
            <table class='mx-auto mb-3'>
                <tbody>
                    <tr>
                        <td>
                        ราคารวมสุทธิ
                        </td>
                        <td width="250px" style="text-align:right">
                          <span id="fintal_total2"></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mb-5 pb-5">
            <button class='btn-custom mx-auto checkout' itemstt="<?php if($item_stt == true){echo "true";}else{echo "false";} ?>"
             ssid="<?php echo $session_id ; ?>" btn-stt="<?php if($loged == true){echo "true";}else{echo "false";} ?>" style="padding:12px 30px;" >สั่งซื้อ</button>
        </div>
    </div>


    </div>
        <?php include("footer.php"); ?>
       
</body>
<?php include("modal/address.php"); ?>
<script src="js/index.js"></script>
<script src="js/register.js"></script>
<script src="js/cart.js"></script>

</html>