

<div class="container fixed-height">
    <div class="row">
        <div class="col-md-12 pt-2">
            <input type="text" id="search" class="loin-input w-50 float-left" placeholder="ค้นหาสินค้า">
            <button class="btn btn-custom float-right pl-3 pr-3 mt-3"  data-toggle="modal" data-target="#newProduct"><i class="fas fa-plus-circle"></i> เพิ่มสินค้าใหม่</button>
        </div>
    </div>
    <?php include("../modal/addpromotion.php") ;
        $fill = "all";
        if(isset($_GET["F"])){
            if($_GET["F"] == "less"){
                $fill = "less";
            }if($_GET["F"] == "over"){
                $fill = "over";
            }
           
        }
    ?>
    <div class="row" style="width: 100%; ">
        <table class="w-100 " id="tbl_emp">
                <thead>
                    <tr id="first_tr">
                        <th>รหัส<?= $fill;?></th>
                        <th>ชื่อสินค้า</th>
                        <th>ประเภทสินค้า</th>
                        <th >ราคา</th>
                        <th>โปรโมชัน</th>
                        <th colspan='3'>จัดการ</th>
                    </tr>
                </thead>
                
                <tbody id="t4">
                    
                </tbody>
                
                    
        </table>
        <?php 
        echo '<script type="text/javascript">';
        echo "var show = '$fill';"; 
        echo '</script>';
        ?> 
        <?php include("../modal/newproduct.php") ?>
    </div>
    <?php include("../modal/edit_Product.php") ?>
</div>
<?php  include("../modal/viewProduct.php") ?>
