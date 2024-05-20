

<h2>ประเภทสินค้า</h2>
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-custom float-right pl-3 pr-3"  data-toggle="modal" data-target="#newProduct_type"><i class="fas fa-plus-circle"></i> เพิ่ม</button>
        </div>
    </div>
    <div class="row">
        <table class="w-100 mt-2 mx-5">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อสินค้า</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                
                <tbody id="t3">
                    
                </tbody>
        </table>
        <?php include("../modal/edit_Product_type.php") ?>
    </div>
</div>
<?php include("../modal/new_Product_type.php") ?>
            