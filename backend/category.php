
<?php 
$fill = "all";
    if(isset($_GET["F"])){
        if($_GET["F"] == "neworder"){
            $fill = "neworder";
        }if($_GET["F"] == "wait"){
            $fill = "wait";
        }if($_GET["F"] == "payed"){
            $fill = "payed";
        }if($_GET["F"] == "logis"){
            $fill = "logis";
        }if($_GET["F"] == "cancle"){
            $fill = "cancle";
        }
       
    }
?>
<div class="container fixed-height">
    <div class="row  pl-5">
        <div class="grid-2 w-100">
            <div class="item">
                <input type="text" id="search_category" class="loin-input w-100" placeholder="ค้นหาชื่อ">
            </div>
            <div class="item">
                <input type="date" class="loin-input w-25 cata_datepicker" id="datepicker"></p>
            </div>
        </div>
    </div>
      <div class="row my-2">
            <div class="grid-4citem mx-auto">
            <div class="item_4">
                        <button class='btn-custom w-100 btn_type_cat' val="0">ทั้งหมด</button>
                </div>
                <div class="item_4">
                        <button class='btn-custom w-100 btn_type_cat' id="btn_prr_1" val="1">รายการใหม่</button>
                </div>
                <div class="item_4">
                        <button class='btn-custom w-100 btn_type_cat' id="btn_prr_11" val="1.5">รอการตรวจสอบ</button>
                </div>
                <div class="item_4">
                        <button class='btn-custom w-100 btn_type_cat' id="btn_prr_2" val="2">ชำระเงินแล้ว</button>
                </div>
                <div class="item_4">
                        <button class='btn-custom w-100 btn_type_cat' id="btn_prr_3" val="3">สินค้าส่งแล้ว</button>
                </div>
                <div class="item_4">
                    <button class='btn-custom w-100 btn_type_cat' id="btn_prr_1" val="4">ยกเลิการสั่งซื้อ</button>
            </div>
      </div> 


    </div>
   
    <div class="row">
        <table class="w-100 mx-5" id="tbl_category">
                <thead>
                    <tr id="first_tr">
                        <th>รหัสการสั่งซื้อ</th>
                        <th>ชื่อ-สกุล</th>
                        <th>วันที่ทำรายาการ</th>
                        <th>สถานะ</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>
                
                <tbody id="t6">
                    
                </tbody>
        </table>
        <?php 
        echo '<script type="text/javascript">';
        echo "var show = '$fill';"; 
        echo '</script>';
        ?> 
        <?php include("../modal/vieworderbackend.php") ?>
    </div>
    
</div>
<?php  include("../modal/viewProduct.php") ?>