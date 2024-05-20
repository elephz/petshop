<div class="container fixed-height">
    <?php
    $type = "";
    $show = "";
     if(isset($_GET['P'])){
        if($_GET["P"] == 'report_day'){
            $show = "เวลา";
            $type = "day";
        }else if($_GET["P"] == 'report_month'){
            $show = "วันที่";
            $type = "month";
        }else if($_GET["P"] == 'report_year'){
            $show = "เดือน";
            $type = "year";
        }
    } 


    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    function validateMonth($date, $format = 'Y-m')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    ?>
    <div class="row">
        <div class="col-md-12 pt-2">
            <?php if($type == "day"){ ?>
                <div class="row">
                    <div class="col-10">
                        <div class="row">
                            <div class="col-10">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="w-50">วันที่เริ่มต้น : </div>
                                    <input type="date" id='datepick-start'  class="loin-input float-left ml-2" value="<?php echo (isset($_GET["val"]) && $_GET["val"] && validateDate($_GET["val"]) ? $_GET["val"] : date( "Y-m-d", strtotime( date("Y-m-d"). "-7 day" ))); ?>" >
                                    <div class="mx-3"></div>
                                    <div class="w-50">สิ้นสุดวันที่ :</div>
                                    <input type="date" id='datepick-end'  class="loin-input float-left ml-2" value="<?php echo (isset($_GET["val"]) && $_GET["val"]  && validateDate($_GET["val"])  ? $_GET["val"] : date("Y-m-d")); ?>" >
                                </div>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary mt-3" id="search">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-custom float-right rp_day py-2 px-4 mt-3" ><i class="fas fa-print"></i> PDF</button>
                    </div>
                </div>
            <?php }else if($type == "month"){ ?>
                <input type="month" id='monthpick'  class="loin-input w-25 float-left" value="<?php echo (isset($_GET["val"]) && $_GET["val"] &&  validateMonth($_GET["val"]) ? $_GET["val"] : date("Y-m")); ?>" >
                <button class="btn btn-custom float-right rp_month py-2 px-4 mt-3" ><i class="fas fa-print"></i> PDF</button>
            <?php }else if($type == "year"){ ?>
                <select name="cars" id="yearpick"  class="loin-input w-25 float-left">
                        <?php for($i = date("Y")-3; $i <= date("Y");$i++ ){ ?>
                            <option value="<?php echo $i; ?>"  <?php  echo (date("Y") + 543 == $i ? 'selected' : '' ) ?>  selected ><?php echo $i+543; ?></option>
                       <?php } ?>
                </select>
                <button class="btn btn-custom rp_year float-right py-2 px-4 mt-3" ><i class="fas fa-print"></i> PDF</button>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <table class="w-75 mx-auto " id="rp_tb_day">
            <thead>
                <tr id="first_tr">
                    <th>ลำดับ</th>
                    <th><?php 
                    switch ($show) {
                        case 'เวลา':
                            echo 'หมายเลขคำสั่งซื้อ';
                            break;
                        case 'วันที่':
                            echo 'จำนวนคำสั่งซื้อ';
                            break;
                        case 'เดือน':
                            echo 'จำนวนคำสั่งซื้อ';
                            break;
                    }
                    ?></th>
                    <th><?php echo $show; ?></th>
                    <th style="text-align:right">ยอดขาย</th>
                </tr>
            </thead>
                
            <tbody id="rp_day">
                
            </tbody>
            <tbody >
                <tr>
                    <td colspan='3'>
                            รวม
                    </td>
                    <td style="text-align:right">
                       <span id="total_byse"></span> 
                    </td>
                </tr>
            </tbody>   
        </table>
    </div>
</div>
<?php 
        echo '<script type="text/javascript">';
        echo "var show = '$show';"; 
        echo '</script>';
        ?> 
<script src="../js/report.js"></script>