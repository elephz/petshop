

<link rel="stylesheet" href="../css/graph.scss">
<?php 

    $sql_ast = "SELECT product_id FROM product";
        $qr_ast = mysqli_query($con,$sql_ast);
        $count = $qr_ast->num_rows;

    $sql_ast2 = "SELECT product_id FROM `product` WHERE qty < 10";
        $qr_ast2 = mysqli_query($con,$sql_ast2);
        $count2 = $qr_ast2->num_rows;

    $sql_ast3 = "SELECT product_id FROM `product` WHERE qty = 0";
        $qr_ast3 = mysqli_query($con,$sql_ast3);
        $count3 = $qr_ast3->num_rows;

    $sql_ast4 = "SELECT order_id,pay_slip,order_status FROM `tb_order`";
        $qr_ast4 = mysqli_query($con,$sql_ast4);
        $count4 = $qr_ast4->num_rows;
        $neworder = 0;
        $wait = 0;
        $payed = 0;
        $logis = 0;
        $cancle = 0;
        while($rowast4 = mysqli_fetch_assoc($qr_ast4)){
            $stt = $rowast4["order_status"];
            $pay_slip = $rowast4["pay_slip"];
            if($stt == "1" && $pay_slip == ""){
                $neworder +=1;
            }else if($stt == "1" && $pay_slip != ""){
                $wait +=1;
            }else if($stt == "2" ){
                $payed +=1;
            }else if($stt == "3" ){
                $logis +=1;
            }else if($stt == "4" ){
                $cancle +=1;
            }
        }
       
?>
<div class="container fixed-height">
    
    <div class="row">
        <div class="grid-3area">
            <div class="grid-3item">
                <div class="icon_g">
                    <i class="fas fa-box-open"></i>
                </div>
                <span class="title_g">จำนวนสินค้าทั้งหมด</span><br>
                <span style="font-size:32px"> <?= $count; ?></span> <span>ชิ้น</span>
                <div class="row row_btm_g">
                   <a class='link_g' href="index.php?P=product"><i class="fas fa-external-link-square-alt"></i> จำนวนสินค้าทั้งหมด</a>
                </div>
            </div>
            <div class="grid-3item">
                <div class="icon_g">
                    <i class="fas fa-sticky-note"></i>
                </div>
                <span class="title_g">จำนวนอุปกรณ์ใกล้หมดสต๊อค</span><br>
                <span style="font-size:32px"> <?= $count2; ?></span> <span>ชิ้น</span>
                <div class="row row_btm_g">
                   <a class='link_g' href="index.php?P=product&F=less"><i class="fas fa-external-link-square-alt"></i> จำนวนอุปกรณ์ใกล้หมดสต๊อค</a>
                </div>
            </div>
            <div class="grid-3item">
                <div class="icon_g">
                    <i class="fas fa-folder-minus"></i>
                </div>
                <span class="title_g">จำนวนอุปกรณ์หมดสต๊อค</span><br>
                <span style="font-size:32px"> <?= $count3; ?></span> <span>ชิ้น</span>
                <div class="row row_btm_g">
                   <a class='link_g' href="index.php?P=product&F=over"><i class="fas fa-external-link-square-alt"></i> จำนวนอุปกรณ์หมดสต๊อค</a>
                </div>
            </div>
        </div>
    </div>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card w-100">
            <div class="card-header">
                รายงานยอดขายประจำปี
            </div>
            <div class="card-body">
            <select name="cars" id="yearpick2" class="loin-input w-50 float-right">
                    <?php for($i = date("Y")-3; $i <= date("Y");$i++ ){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i+543; ?></option>
                <?php } ?>
            </select>
                <canvas id="graphCanvas" class='w-100'></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                ออเดอร์
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class='list-group-item'> <a class='link_g' href="index.php?P=category" style="color:#102526" >ทั้งหมด <span class="float-right" id="A"><?= $count4 ;?></span></a></li>
                    <li class='list-group-item'> <a class='link_g' href="index.php?P=category&F=neworder" style="color:#102526" >รายการใหม่ <span class="float-right" id="Bp"><?= $neworder  ;?></span> </a></li>
                    <li class='list-group-item'> <a class='link_g' href="index.php?P=category&F=wait" style="color:#102526" >รอการตรวจสอบ <span class="float-right" id="B"><?= $wait ;?></span></a></li>
                    <li class='list-group-item'> <a class='link_g' href="index.php?P=category&F=payed" style="color:#102526" >ชำระเงินแล้ว <span class="float-right" id="Cp"><?= $payed ;?></span></a></li>
                    <li class='list-group-item'> <a class='link_g' href="index.php?P=category&F=logis" style="color:#102526" >การจัดส่ง <span class="float-right" id="C"><?= $logis ;?></span></a></li>
                    <li class='list-group-item' > <a class='link_g' href="index.php?P=category&F=cancle" style="color:#102526" >ยกเลิกออเดอร์ <span class="float-right" id="F"><?= $cancle ;?></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>

<?php 
        // echo '<script type="text/javascript">';
        // echo "var show = '$show';"; 
        // echo '</script>';
        ?> 
 
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="../js/graph.js"></script>