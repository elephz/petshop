<?php 
session_start();
include("api/config.php");
    $loged = false ;
    $h_orrder = false;
    if(isset($_SESSION["userid"])){
        $loged = true;
        $session_id = $_SESSION["userid"];
        $h_sql2 = "SELECT * FROM  tb_order  WHERE member_id = '$session_id'";
        $h_qr2 = mysqli_query($con,$h_sql2) or die ('error. '. mysqli_error($con));
        if($h_qr2->num_rows >= 1){
            $h_orrder = true;
        }
    }else{
        $loged = false ;
    }
    
    $h_sql = "SELECT * FROM  product_type";
    $h_qr = mysqli_query($con,$h_sql) or die ('error. '. mysqli_error($con));
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
                    <div class="top-logo">
                        <div class="inlogo">
                            <a href="index.php" class="a-logo">
                            <b> <span class="f-28"><span class="f-38">ชัช<br></span>เพ็ทช็อป</span></b>
                            </a>
                        </div>
                    </div>
                    <div class="top-logo2">
                        <div class="inlogo">
                            <a href="index.php" class="a-logo">
                            <b> <span class="f-28"><span class="f-38">ชัช</span>เพ็ทช็อป</span></b>
                            </a>
                        </div>
                    </div>
            <div class="row w-100 os mt-3 mx-auto">
                <div class="col-md-1 ">
                </div>
                <div class="col-md-5  ml-10">
                    <div class="list-inline">
                    <?php if(isset($index)){
                            if($index == true)
                        { ?>
                        <a href="#section1" class="list-inline-item">สินค้า</a>
                        <a href="#section2" class="list-inline-item">โปรโมชัน</a>
                        <a href="#section3" class="list-inline-item">สาระน่ารู้</a>
                        <a href="#section4" class="list-inline-item">กิจกรรม</a>
                        <a href="#section4" class="list-inline-item">ติดต่อ</a>
                        <?php }
                        } ?>
                    </div>
                </div>
                <div class="col-md-5 ">
                    <form action="" class='float-right'>
                        <div class="list-inline">
                            <?php  if($loged == true && $_SESSION["status"] =='2'){ ?>
                            
                                <a href="backend/index.php" class="list-inline-item"> <i class="fas fa-arrow-up"></i> ระบบบริหาร </a>
                            
                        <?php } ?>
                        <?php  if($loged == true){ ?>
                            
                                <a href="register.php?id=<?php echo $_SESSION["userid"]; ?>" id="profile" class="list-inline-item f-28"> 
                                <i class="fas fa-user"></i>  <?php /**  echo $_SESSION["firstname"]." ".$_SESSION["lastname"] */?> </a>

                                <a href="like.php" class="list-inline-item f-28"> <i class="fas fa-heart"></i></i></a>
                        <?php } ?>
                        <div class="oncardchage">
                            <div class="card_c">
                                <span id="card_cc"></span>
                            </div>
                            <a href="cart.php" class="list-inline-item f-28"> <i class="fas fa-shopping-cart"></i></a> 
                        </div>
                        <?php  if($loged == true && $h_orrder == true){ ?>
                            <a href="showorder.php" class="list-inline-item f-28"> 
                                <i class="fas fa-clipboard-list"></i>
                            </a> 
                        <?php } ?>
                        <?php  if($loged == false){ ?>
                            <span class="top_right_list login" ><a href="" class="list-inline-item f-28" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-sign-in-alt"></i></a> 
                        <?php } ?>
                        <?php  if($loged == true){ ?>
                            <a href="" id="log-out" type="1" class="list-inline-item f-28"> <i class="fas fa-power-off"></i> </a>
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