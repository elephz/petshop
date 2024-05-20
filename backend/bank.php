

<div class="container fixed-height">
    <div class="row py-2">
        <div class="col-md-12 ">
            <button class="btn btn-custom float-right pl-3 pr-3 mt-3"  data-toggle="modal" data-target="#newbank"><i class="fas fa-plus-circle"></i> เพิ่มบัญชีธนาคาร</button>
        </div>
    </div>
  
    <div class="row" style="width: 100%; ">
        <table class="w-100 " id="tb_bank">
                <thead>
                    <tr id="first_tr">
                        <th>รหัส</th>
                        <th>ธนาคาร</th>
                        <th>เลขบัญชี</th>
                        <th >ชื่อ - สกุล</th>
                        <th colspan='2'>จัดการ</th>
                    </tr>
                </thead>
                
                <tbody id="bank">
                    
                </tbody>
                
                    
        </table>
        
        <?php include("../modal/newbank.php") ?>
    </div>
    <?php include("../modal/edit_bank.php") ?>
</div>
<?php  include("../modal/viewProduct.php") ?>
