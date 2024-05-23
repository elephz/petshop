<?php
session_start();
include("api/config.php");
$loged = false;
$h_orrder = false;
if (isset($_SESSION["userid"])) {
    $loged = true;
    $session_id = $_SESSION["userid"];
    $h_sql2 = "SELECT * FROM  tb_order  WHERE member_id = '$session_id'";
    $h_qr2 = mysqli_query($con, $h_sql2) or die('error. ' . mysqli_error($con));
    if ($h_qr2->num_rows >= 1) {
        $h_orrder = true;
    }
} else {
    $loged = false;
}

$h_sql = "SELECT * FROM  product_type";
$h_qr = mysqli_query($con, $h_sql) or die('error. ' . mysqli_error($con));
echo '<script type="text/javascript">';
echo "var h_id = '$session_id';";
echo '</script>';
?>
<header>


    <a id="button"></a>
    <!-- <div class="fixtop">
        <div class="bg transition">sdsdsdsd</div>
    </div> -->
    <div class="container-fluid first_row_header fixtop">
        <div class="row w-100 os mt-3 mx-auto">
            <div class="col-md-1 ">
            </div>
            <div class="col-md-5  ml-10">
                <div class="list-inline">
                    <?php if (isset($index)) {
                        if ($index == true) { ?>
                            <a href="#section-home" class="list-inline-item">Home</a>
                            <a href="#section-about" class="list-inline-item">เกี่ยวกับเรา</a>
                            <a href="#section-news" class="list-inline-item">ข่าวสาร</a>
                            <a href="cart.php" class="list-inline-item">ตะกร้าสินค้า(<span id="card_cc">0</span>)</a>
                            <a href="#section-contact" class="list-inline-item">ติดต่อเรา</a>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="col-md-5 ">
                <form action="" class='float-right'>
                    <div class="list-inline">
                        <?php if ($loged == true && $_SESSION["status"] == '2') { ?>

                            <a href="backend/index.php" class="list-inline-item"> <i class="fas fa-arrow-up"></i> ระบบบริหาร </a>

                        <?php } ?>
                        <?php if ($loged == true) { ?>
                            <a href="register.php?id=<?php echo $_SESSION["userid"]; ?>" id="profile" class="list-inline-item f-28">
                                <i class="fas fa-user"></i> <?php /**  echo $_SESSION["firstname"]." ".$_SESSION["lastname"] */ ?> </a>
                        <?php } ?>
                        <?php if ($loged == true && $h_orrder == true) { ?>
                            <a href="showorder.php" class="list-inline-item f-28">
                                <i class="fas fa-clipboard-list"></i>
                            </a>
                        <?php } ?>
                        <?php if ($loged == false) { ?>
                            <span class="top_right_list login"><a href="" class="list-inline-item f-28" data-toggle="modal" data-target="#exampleModal"> เข้าสู่ระบบ</a>
                            <?php } ?>
                            <?php if ($loged == true) { ?>
                                <a href="" id="log-out" type="1" class="list-inline-item f-28"> ออกจากระบบ </a>
                            <?php } ?>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- seconed-row -->

    <!-- nave -->


    <!--nave -->


</header>