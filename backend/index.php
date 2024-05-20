<?php session_start();
include("../api/config.php");
?>

<?php 
 
if ($_SESSION["status"]!="2"){
 
	  Header("Location: ../index.php");
 
}else{
    $loged = false ;
    if(isset($_SESSION["userid"])){
        $session_id = $_SESSION["userid"];
        $loged = true;
        echo '<script type="text/javascript">';
        echo "var h_id = '$session_id';"; 
        echo '</script>';
    }else{
        $loged = false ;
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Chut-Petshop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300&family=Prompt:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" integrity="sha512-f8gN/IhfI+0E9Fc/LKtjVq4ywfhYAVeMGKsECzDUHcFJ5teVwvKTqizm+5a84FINhfrgdvjX8hEJbem2io1iTA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/bn-index.scss">
    <link rel="stylesheet" href="../css/main.scss">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body style="background-color: #eee;">

    
<div class="container-fluid mb-3 mt-3 " style="overflow:hidden" >
    
    <div class="row rowa bx">
        <div class="row first-row" >
            <div class="col-md-12 ">
                <div class="top_left">   
                        <h2 style="color:white;"> <b> <span style="color:#ff6666;font-size:36px;">ชัช</span></b>เพ็ทช็อป</h2>
                </div>
                <div class="top_right">

                        <?php  if($loged == true){ ?>
                            <span class="top_right_list">
                                <a href="../index.php" class="top_right_list_b"> หน้าร้าน </a>
                            </span>
                        <b> <span  style="color:white;font-size:24px"> | </span> </b>
                            <span class="top_right_list">
                                <a href="../register.php?id=<?php echo $_SESSION["userid"]; ?>" id="profile" class="top_right_list_b"> 
                                <?php echo "Admin : ".$_SESSION["firstname"]." ".$_SESSION["lastname"] ?> </a>
                            </span>
                        <?php } ?>
                       <b> <span  style="color:white;font-size:24px"> | </span> </b>
                    <span class="top_right_list"><a href="" id="log-out" type="2" class="top_right_list_b" > <i class="fas fa-power-off"></i> </a></span>
                </div>
            </div>
        </div>
        <div class="row row-content">
        <div class="left" style="background-color:#666;">
            <?php $P = "graph"; if(isset($_GET["P"])){ $P = $_GET["P"];} ?>
            <ul id="myMenu">
                <li class="static">เมนูข้อมูล</li>
                <li><a href="index.php?P=graph" class="<?php if($P == "graph"){echo "click" ;} ?>" >สถิติ</a></li>
                <li><a href="index.php?P=category" class="<?php if($P == "category"){echo "click" ;} ?>" >ข้อมูลการสั่งซื้อ</a></li>
                <li><a href="index.php?P=member" class="<?php if($P == "member"){echo "click" ;} ?>" >ข้อมูลสมาชิก</a></li>
                <li><a href="index.php?P=product" class="<?php if($P == "product"){echo "click" ;} ?>" >ข้อมูลสินค้า</a></li>
                <li><a href="index.php?P=product_type" class="<?php if($P == "product_type"){echo "click" ;} ?>" >ข้อมูลประเภทสินค้า</a></li>
                <li><a href="index.php?P=bank" class="<?php if($P == "bank"){echo "click" ;} ?>" >ข้อมูลธนาคาร</a></li>
                <li class="static pt-3">เมนูรายงาน</li>
                <li><a href="index.php?P=leftinstock" class="<?php if($P == "leftinstock"){echo "click" ;} ?>" >รายงานสินค้าคงเหลือ</a></li>
                <li><a href="index.php?P=bestsale" class="<?php if($P == "bestsale"){echo "click" ;} ?>" >รายงานสินขายดี</a></li>
                <li><a href="index.php?P=report_day" class="<?php if($P == "report_day"){echo "click" ;} ?>" >รายงานยอดขาย(วัน)</a></li>
                <li><a href="index.php?P=report_month" class="<?php if($P == "report_month"){echo "click" ;} ?>" >รายงานยอดขาย(เดือน)</a></li>
                <li><a href="index.php?P=report_year" class="<?php if($P == "report_year"){echo "click" ;} ?>" >รายงานยอดขาย(ปี)</a></li>
            </ul>
        </div>
        
        <div class="right" style="background-color:#fff;">
           <?php 
                $realtime;
                if(isset($_GET["P"])){
                    if($_GET["P"] == 'graph'){
                        $realtime = "graph";
                        include("graph.php");
                    }else if($_GET["P"] == 'category'){
                        include("category.php");
                        $realtime = "category";
                    }else if($_GET["P"] == 'member'){
                        $realtime = "member";
                        include("member.php");
                    }else if($_GET["P"] == 'product'){
                        $realtime = "product";
                        include("product.php");
                    }else if($_GET["P"] == 'product_type'){
                        $realtime = "product_type";
                        include("product_type.php");
                    }else if($_GET["P"] == 'leftinstock'){
                        $realtime = "leftinstock";
                        include("leftinstock.php");
                    }else if($_GET["P"] == 'report_day'){
                        $realtime = "report_day";
                        include("report.php");
                    }else if($_GET["P"] == 'report_month'){
                        $realtime = "report_month";
                        include("report.php");
                    }else if($_GET["P"] == 'report_year'){
                        $realtime = "report_year";
                        include("report.php");
                    }else if($_GET["P"] == 'bestsale'){
                        $realtime = "bestsale";
                        include("bestsale.php");
                    }else if($_GET["P"] == 'bank'){
                        $realtime = "bank";
                        include("bank.php");
                    }
                }else{
                    $realtime = "graph";
                    include("graph.php");
                }
           ?>
        </div>
        </div>
    </div>
</div>
<div style="position:absolute;bottom:0px;width:100%;">
    
</div>
<?php 
        echo '<script type="text/javascript">';
        echo "var type = '$realtime';"; 
        echo '</script>';
        ?> 

</body>
<script src="../js/index.js"></script>
<script src="../js/register.js"></script>
<script src="../js/bn-index.js"></script>
</html>
<?php } ?>