<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("cdn.php"); ?>
    <link rel="stylesheet" href="css/main.scss">
    <link rel="stylesheet" href="css/showorder.scss">
</head>
<body>
  
    <?php include("header.php"); ?> 
    <div class="contentz">
    <?php include("modal/loginmodal.php"); ?>
    
        <div class="container my-5" >
            <div class="row">
                <div class="col-md-6">
                    <button class='btn btn-primary btn1'>ยังไม่ได้ชำระเงิน</button>
                    <button class='btn btn-warning btn2'>ชำระเงินแล้ว</button>
                    <button class='btn btn-success btn3'>สำเร็จ</button>
                    <button class='btn btn-danger btn4'>ยกเลิกออเดอร์</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                  
                <div id="soorder_left" class='py-3'></div>
                        
                                
                       
                   
                </div>
                <div class="col-md-7 hide">
                    <div class="row">
                        <div class="col-8">
                            <p><span>รหัสการสั่งซื้อ : </span><span id="rihgt_orid"></span></p> 
                            <p><span>สถานะ : </span><span id="rihgt_stt"></span></p>
                            <p class='hide' id='shipment'><span>ขนส่ง : </span><span class="text"></span>  </p>
                            <p class='hide' id='tracking_code'><span>หมายเลขพัสดุ : </span><span class="text"></span> <i class="far fa-copy ml-2"></i></p>
                            <p><span>วันที่ทำงานรายการ : </span><span id="rihgt_date"></span></p>
                            <p><span>รหัสสมาชิก : </span><span id="rihgt_id"></span></p>
                            <p><span>เบอร์โทร : </span><span id="rihgt_phone"></span></p>
                            <p><span>ที่อยู่ : </span><span id="rihgt_address"></span></p>
                        </div>
                        <div class="col-4" >
                            <button class="btn-custom so_pay_btn hide float-right" data-toggle="modal" data-target="#modal_pay" bid="" >ชำระเงิน</button> <br>
                            <button class="btn-custom so_pay_btn_show p-3 hide  float-right" id="" data-toggle="modal" data-target="#view_order" bid="" >ข้อมูลการชำระเงิน</button>
                            
                        </div>
                    </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>รหัสสินค้า</th>
                                    <th>รูปภาพ</th>   
                                    <th>ชื่อ</th>
                                    <th>ราคา</th>
                                    <th>โปรโมชัน</th>
                                    <th>จำนวน</th>
                                    <th>รวม</th>
                                </tr>
                            </thead>
                            <tbody id="torder">
           
          
                            </tbody>
                            <tbody >
                                <tr>
                                    <th colspan='6'>รวม</th>
                                    <th id='so_total' price=''></th>
                                </tr>
          
                            </tbody>
                            </table>
                </div>
            
        </div>
       
        <div class="row mt-3">
                <div class="col text-center">
                    
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
    <div>
        <?php include("modal/modal_pay.php"); ?>
    </div>
    <div class="clear-fix">
        <?php include("modal/vieworderbackend.php"); ?>
    </div>
    <?php 
        echo '<script type="text/javascript">';
        echo "var ssid = '$session_id';"; 
        echo '</script>';
        ?> 
        
</body>
<script src="js/index.js"></script>
<script src="js/register.js"></script>
<script src="js/cart.js"></script>
<script src="js/showorder.js"></script>
</html>