<h2>ข้อมูลสมาชิก</h2>

<div class="container">
    <div class="row">
        <div class="col-md-12 pt-2">
            <input type="text" id="search_member" class="loin-input w-50 float-left" placeholder="ค้นหาสมาชิก">
        </div>
    </div>
   
    <div class="row">
        <table class="w-100 mx-5" id="tbl_member">
                <thead>
                    <tr id="first_tr">
                        <th>รหัส</th>
                        <th>ชื่อ-สกุล</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th >สิทธ์เข้าใช้งาน</th>
                        <th colspan='3'>จัดการ</th>
                    </tr>
                </thead>
                
                <tbody id="t5">
                    
                </tbody>
        </table>
        <?php include("../modal/viewmember.php") ?>
    </div>
    
</div>
<?php  include("../modal/viewProduct.php") ?>