<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("cdn.php"); ?>.
    <link rel="stylesheet" href="css/slider.scss">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>

<body>
    <?php $index = true; ?>
    <?php include("header.php"); ?>
    <div >
        <?php include("modal/loginmodal.php");
        $sql = "SELECT * FROM  product_type";
        $qr = mysqli_query($con, $sql) or die('error. ' . mysqli_error($con));

        $sql2 = "SELECT * FROM  product_type";
        $qr2 = mysqli_query($con, $sql2) or die('error. ' . mysqli_error($con));

        $sql_rcm = "SELECT * FROM product  LEFT JOIN img on product.product_id = img.ref_id WHERE recommend = '1' GROUP BY product_id LIMIT 0,6";
        $qr_rcm = mysqli_query($con, $sql_rcm);
        $arr = [];
        $i = 1;
        while ($item = mysqli_fetch_assoc($qr_rcm)) {
            array_push($arr, $item);
        }

        $sql_cur = "SELECT * FROM product  LEFT JOIN img on product.product_id = img.ref_id ORDER BY product_id DESC LIMIT 0,6";
        $qr_cur = mysqli_query($con, $sql_cur);
        $arr_cur = [];
        $i_cur = 1;
        while ($item_cur = mysqli_fetch_assoc($qr_cur)) {
            array_push($arr_cur, $item_cur);
        }
        $sql_pro = "SELECT * FROM product  LEFT JOIN img on product.product_id = img.ref_id WHERE promotion != '0' ORDER BY product_id DESC LIMIT 0,6";
        $qr_pro = mysqli_query($con, $sql_pro);
        $arr_pro = [];
        $i_pro = 1;
        while ($item_pro = mysqli_fetch_assoc($qr_pro)) {
            array_push($arr_pro, $item_pro);
        }

        ?>
        <!-- slide img -->
        <div class="container-fluid pl-0 pr-0">
            <div class="" style="height:600px;">
                <img src="img/tar/banner.png" class="w-100 h-100" alt="">
            </div>
        </div>

        <!-- slide img -->
        <div class="container" id="section-home">
            <div class="bs-example mx-auto">
                <ul class="nav nav-tabs ">
                    <?php $i = 1;
                    while ($row = mysqli_fetch_assoc($qr)) { ?>
                        <li class="nav-item">
                            <a href="#<?php echo "p" . $row['product_type_id'] ?>" class="nav-link <?php if ($i == 1) {
                                                                                                        echo "active";
                                                                                                    } ?>" data-toggle="tab"><?php echo $row['product_type_name'] ?></a>
                        </li>
                    <?php $i++;
                    } ?>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="tab-content" id="">
                <?php $i = 1;
                while ($row2 = mysqli_fetch_assoc($qr2)) { ?>
                    <div class="tab-pane fade show <?php if ($i == 1) {
                                                        echo "active";
                                                    } ?>" id="<?php echo "p" . $row2['product_type_id'] ?>">
                        <div class="grid-area">
                            <?php
                            $pdt = $row2["product_type_id"];
                            $sql_item = "SELECT * FROM product LEFT JOIN img on product.product_id = img.ref_id WHERE product.product_type_id = '$pdt' GROUP BY product.product_id LIMIT 0,6";
                            $qr_item = mysqli_query($con, $sql_item) or die('error. ' . mysqli_error($con));
                            while ($item = mysqli_fetch_assoc($qr_item)) {

                            ?>
                                <?php if ($item['product_id'] != "") { ?>
                                    <div class="grid-item">
                                        <div class="out-img example example-cover">
                                            <?php if ($item['img_name'] == "") { ?>
                                                <img class="d-block w-100" src="uploads/defalitem.jpg">
                                            <?php } else { ?>
                                                <img class="d-block w-100" src="uploads/<?php echo $item['img_name'] ?>">
                                            <?php } ?>

                                            <div class="btm-producttab">
                                                <b> <span class="add-item" img="<?php echo $item['img_name'] ?>" id="<?php echo $item['product_id'] ?>" name="<?php echo $item['product_name'] ?>" price="<?php echo $item['price'] ?>"><i class="fas fa-cart-plus"></i> เพิ่มลงตะกร้า</span> </b>
                                            </div>

                                            <div class="btm-product-top">
                                                <b> <span class="view-item" id="<?php echo $item['product_id'] ?>"><i class="fas fa-search"></i> </span> </b> <br>
                                                <b> <span class="like-item" lid="<?php echo $item['product_id'] ?>"> <i class="fas fa-heart"></i> </span> </b>
                                            </div>
                                            <?php if ($item['promotion'] != "0") {
                                            ?>
                                                <div class="promo">
                                                    ลด<br><?php echo $item['promotion'];  ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <p><?php echo $item['product_name']; ?> </p>
                                        <p style="text-align:right"><?php echo number_format($item['price'], 2) . "บาท"; ?></p>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                <?php $i++;
                } ?>




            </div>
            <div class="row my-3">
                <div class="col text-center">
                    <button class="btn btn-viewall" id=""> ดูทั้งหมด <i class="fas fa-long-arrow-alt-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="background:#f2e1d9;" id="section-about">
            <div class="row">
                <div class="col-7 p-0">
                    <!-- <div class="parallax"></div> -->
                    
                    <img class="w-100" src="https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
                </div>
                <div class="col-md-4">
                    <div class="haha py-5">
                        <span class="f-38">ฟาร์มผู้ผลิตไข่ไก่แบบครบวงจร </span> <br>
                        <span>
                        เราให้ ”คุณภาพ” คือความสำคัญอันดับ 1 มานานกว่า 60 ปี ฟาร์มไก่ไข่ “สงวนฟาร์ม” เป็นผู้บุกเบิกการเลี้ยงไก่ไข่ในประเทศไทยมากว่า 60 ปี เราคัดสรรไก่ไข่สายพันธุ์พิเศษที่มีเพียงแห่งเดียวในประเทศไทย และเลี้ยงดูด้วยอาหารสูตรเฉพาะซึ่งผลิตมาจากวัตถุดิบธรรมชาติ ปราศจากฮอร์โมน ยาปฏิชีวนะ และสารตกค้าง
                        ไข่ไก่ของเราทุกฟองได้รับการเสริมแร่ธาตุซีลีเนียมในรูปอินทรีย์ ผ่านการล้างทำความสะอาด และเคลือบเปลือกไข่ด้วยสารชีวภาพเพื่อรักษาความสด ผ่านการฆ่าเชื้อโรคด้วยแสงอัลตราไวโอเลท ก่อนชั่งน้ำหนักและคัดแยกไข่ไก่ที่มีความผิดปรกติออกด้วยเครื่องจักรที่ทันสมัยและแม่นยำที่สุดในโลกจากประเทศญี่ปุ่น พร้อมทั้งส่งไข่ไก่ถึงมือท่านด้วยรถขนส่งควบคุมอุณหภูมิ
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="background:#f2e1d9;" id="section-about">
            <div class="row">
                <div class="col-md-7">
                    <div class="haha py-5">
                        <span class="f-38">แม่ไก่ </span> <br>
                        <span>
                        แม่ไก่ไข่สายพันธุ์ “ไทยบราวน์” : สงวนฟาร์มเป็นฟาร์มระดับอุตสาหกรรมเพียงแห่งเดียวในประเทศไทย ที่ไม่ได้ใช้แม่พันธุ์ไก่ไข่ที่นำเข้าจากต่างประเทศ แต่อาศัยการขยายและปรับปรุงพันธุ์ไก่ไข่ ที่รับช่วงต่อจาก โครงการวิจัยพันธุ์ไก่ไข่เพื่อทดแทนการนำเข้า ของศูนย์วิจัยและบำรุงพันธุ์สัตว์ กรมปศุสัตว์ โดยได้ตั้งชื่อว่าสายพันธุ์ “ไทยบราวน์”
แม่ไก่สายพันธุ์ไทยบราวน์มีความแข็งแรง สามารถปรับตัวเข้ากับสภาพภูมิอากาศ และ มีภูมิต้านทานโรคประจำท้องถิ่นสูงกว่าสายพันธุ์ไก่ไข่ที่นำเข้าจากต่างประเทศ ทำให้สามารถเลี้ยงดูได้โดยไม่ต้องกระตุ้นการเจริญเติบโตด้วยยาปฏิชีวนะและฮอร์โมน จึงสามารถผลิตไข่ไก่ปลอดสารให้แก่ผู้บริโภคได้ต่อเนื่องตลอดทั้งปี

                        </span>
                    </div>
                </div>
                <div class="col-5 p-0">
                    <!-- <div class="parallax"></div> -->
                    
                    <img class="w-100" src="https://images.unsplash.com/photo-1588597989061-b60ad0eefdbf?q=80&w=2669&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
                </div>
            </div>
        </div>

        <div id="Paris" class="tabcontent2">
            <!-- test -->
            <div class="row blog">
                <div class="col-md-12">
                    <div id="blogCarousel3" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators">
                            <li data-target="#blogCarousel3" data-slide-to="0" class="active" style="width:20px;height:0px;border-radius: 0%;"></li>
                            <li data-target="#blogCarousel3" data-slide-to="1" style="width:20px;height:0px;border-radius: 0%;"></li>

                        </ol>

                        <!-- Carousel items -->
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="row grid-area">
                                    <?php
                                    for ($i = 0; $i < count($arr_pro); $i++) {
                                        if ($i > 2) {
                                            continue;
                                        }
                                    ?>

                                        <div class="grid-item">
                                            <div class="out-img example example-cover">
                                                <?php if ($arr_pro[$i]['img_name'] == "") { ?>
                                                    <img class="d-block w-100" src="uploads/defalitem.jpg">
                                                <?php } else { ?>
                                                    <img class="d-block w-100" src="uploads/<?php echo $arr_pro[$i]['img_name'] ?>">
                                                <?php } ?>
                                                <div class="btm-producttab">
                                                    <b> <span class="add-item" img="<?php echo $arr_pro[$i]['img_name'] ?>" id="<?php echo $arr_pro[$i]['product_id'] ?>" name="<?php echo $arr_pro[$i]['product_name'] ?>" price="<?php echo $arr_pro[$i]['price'] ?>"><i class="fas fa-cart-plus"></i> เพิ่มลงตะกร้า</span> </b>
                                                </div>
                                                <div class="btm-product-top">
                                                    <b> <span class="view-item" id="<?php echo $arr_pro[$i]['product_id'] ?>"><i class="fas fa-search"></i> </span> </b> &nbsp;
                                                    <b> <span class="like-item" lid="<?php echo $arr_pro[$i]['product_id'] ?>"> <i class="fas fa-heart"></i> </span> </b>
                                                </div>
                                                <?php if ($arr_pro[$i]['promotion'] != "0") {   ?>
                                                    <div class="promo">
                                                        ลด<br><?php echo $arr_pro[$i]['promotion'];  ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <p><?php echo $arr_pro[$i]['product_name'] ?></p>
                                            <p style="text-align:right"><?php echo number_format($arr_pro[$i]['price'], 2) . "บาท"; ?></p>
                                        </div>

                                    <?php

                                    }
                                    ?>

                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                            <div class="carousel-item">
                                <div class="row grid-area">
                                    <?php
                                    for ($i = 0; $i < count($arr_pro); $i++) {
                                        if ($i < 3) {
                                            continue;
                                        }
                                    ?>

                                        <div class="grid-item">
                                            <div class="out-img example example-cover">
                                                <?php if ($arr_pro[$i]['img_name'] == "") { ?>
                                                    <img class="d-block w-100" src="uploads/defalitem.jpg">
                                                <?php } else { ?>
                                                    <img class="d-block w-100" src="uploads/<?php echo $arr_pro[$i]['img_name'] ?>">
                                                <?php } ?>
                                                <div class="btm-producttab">
                                                    <b> <span class="add-item" img="<?php echo $arr_pro[$i]['img_name'] ?>" id="<?php echo $arr_pro[$i]['product_id'] ?>" name="<?php echo $arr_pro[$i]['product_name'] ?>" price="<?php echo $arr_pro[$i]['price'] ?>"><i class="fas fa-cart-plus"></i> เพิ่มลงตะกร้า</span> </b>
                                                </div>
                                                <div class="btm-product-top">
                                                    <b> <span class="view-item" id="<?php echo $arr_pro[$i]['product_id'] ?>"><i class="fas fa-search"></i> </span> </b> &nbsp;
                                                    <b> <span class="like-item" lid="<?php echo $arr_pro[$i]['product_id'] ?>"> <i class="fas fa-heart"></i> </span> </b>
                                                </div>
                                                <?php if ($arr_pro[$i]['promotion'] != "0") {   ?>
                                                    <div class="promo">
                                                        ลด<br><?php echo $arr_pro[$i]['promotion'];  ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <p><?php echo $arr_pro[$i]['product_name'] ?></p>
                                            <p style="text-align:right"><?php echo number_format($arr_pro[$i]['price'], 2) . "บาท"; ?></p>
                                        </div>

                                    <?php

                                    }
                                    ?>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                        </div>
                        <!--.carousel-inner-->
                    </div>
                    <!--.Carousel-->

                </div>
            </div>
            <!-- test -->
        </div>

        <div id="Tokyo" class="tabcontent2">
            <!-- test -->
            <div class="row blog">
                <div class="col-md-12">
                    <div id="blogCarousel2" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators">
                            <li data-target="#blogCarousel2" data-slide-to="0" class="active" style="width:20px;height:0px;border-radius: 0%;"></li>
                            <li data-target="#blogCarousel2" data-slide-to="1" style="width:20px;height:0px;border-radius: 0%;"></li>

                        </ol>

                        <!-- Carousel items -->
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="row grid-area">
                                    <?php
                                    for ($i = 0; $i < count($arr_cur); $i++) {
                                        if ($i > 2) {
                                            continue;
                                        }
                                    ?>

                                        <div class="grid-item">
                                            <div class="out-img example example-cover">
                                                <img class='d-block w-100' src="uploads/<?php echo $arr_cur[$i]['img_name'] ?>">
                                                <div class="btm-producttab">
                                                    <b> <span class="add-item" img="<?php echo $arr_cur[$i]['img_name'] ?>" id="<?php echo $arr_cur[$i]['product_id'] ?>" name="<?php echo $arr_cur[$i]['product_name'] ?>" price="<?php echo $arr_cur[$i]['price'] ?>"><i class="fas fa-cart-plus"></i> เพิ่มลงตะกร้า</span> </b>
                                                </div>
                                                <div class="btm-product-top">
                                                    <b> <span class="view-item" id="<?php echo $arr_cur[$i]['product_id'] ?>"><i class="fas fa-search"></i> </span> </b> &nbsp;
                                                    <b> <span class="like-item" lid="<?php echo $arr_cur[$i]['product_id'] ?>"> <i class="fas fa-heart"></i> </span> </b>
                                                </div>
                                            </div>
                                            <p><?php echo $arr_cur[$i]['product_name'] ?></p>
                                            <p style="text-align:right"><?php echo number_format($arr_cur[$i]['price'], 2) . "บาท"; ?></p>
                                        </div>

                                    <?php

                                    }
                                    ?>

                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                            <div class="carousel-item">
                                <div class="row grid-area">
                                    <?php
                                    for ($i = 0; $i < count($arr_cur); $i++) {
                                        if ($i < 3) {
                                            continue;
                                        }
                                    ?>

                                        <div class="grid-item">
                                            <div class="out-img example example-cover">
                                                <img class='d-block w-100' src="uploads/<?php echo $arr_cur[$i]['img_name'] ?>">
                                                <div class="btm-producttab">
                                                    <b> <span class="add-item" img="<?php echo $arr_cur[$i]['img_name'] ?>" id="<?php echo $arr_cur[$i]['product_id'] ?>" name="<?php echo $arr_cur[$i]['product_name'] ?>" price="<?php echo $arr_cur[$i]['price'] ?>"><i class="fas fa-cart-plus"></i> เพิ่มลงตะกร้า</span> </b>
                                                </div>
                                                <div class="btm-product-top">
                                                    <b> <span class="view-item" id="<?php echo $arr_cur[$i]['product_id'] ?>"><i class="fas fa-search"></i> </span> </b> &nbsp;
                                                    <b> <span class="like-item" lid="<?php echo $arr_cur[$i]['product_id'] ?>"> <i class="fas fa-heart"></i> </span> </b>
                                                </div>
                                            </div>
                                            <p><?php echo $arr_cur[$i]['product_name'] ?></p>
                                            <p style="text-align:right"><?php echo number_format($arr_cur[$i]['price'], 2) . "บาท"; ?></p>
                                        </div>

                                    <?php

                                    }
                                    ?>
                                </div>
                                <!--.row-->
                            </div>
                            <!--.item-->

                        </div>
                        <!--.carousel-inner-->
                    </div>
                    <!--.Carousel-->

                </div>
            </div>
            <!-- test -->
        </div>

    </div>

    <div class="container-fluid two-spoort " id="section-news">
        <div class="box-red">
            <div class="white-box1"></div>
            <div class="white-box2"></div>
            <div class="w-75 mx-auto">
                <img src="img/tar/news.png" alt="">
            </div>
        </div>
    </div>
    <div class="container-fluid" id="section-contact">
        <div class="row py-3">
            <div class="col-md-3  py-3 p-10 text-center">
                <a href="https://www.facebook.com/fishtown.pet/posts/622912658455703/" class="logo-f mx-auto">
                    <b> <i class="fab fa-facebook-f"></i> </b><span>ฟิชทาวน์ ลำพูน - เพ็ทช็อป&กรูมมิ่ง</span>
                </a>
                <br>
                <span>ชัช เพ็ทช็อป สาขา ต้นธง 195/20 </span> <br>
                <span> หมู่ 2 ต.ต้นธง อ.เมือง จ.ลำพูน 51000 <br> จำหน่าย อาหารสัตว์เลี้ยง อุปกรณ์สัตว์เลี้ยง </span><br>
                <span> บริการรับส่ง เปิดบริการทุกวัน 09.00 - 19.30 น.<br> (เลยป้ายทางเข้าวิทยาลัยสงฆ์ลำพูน ตึกแถวที่ 3) </span>
            </div>
        </div>
        </section>

    </div>
    </div>
    <?php include("footer.php"); ?>
</body>
<script src="js/index.js"></script>
<script src="js/register.js"></script>
<script src="js/cart.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="js/slider.js"></script>

<script>
    $('#blogCarousel').carousel({
        interval: 10000
    });
    setvaltoallbtn();
    $("#tablinkfirst").click();

    function myFunction(imgs) {
        var expandImg = document.getElementById("expandedImg");
        var imgText = document.getElementById("imgtext");
        expandImg.src = imgs.src;
        imgText.innerHTML = imgs.alt;
        expandImg.parentElement.style.display = "block";
    }

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;

        tabcontent = $(".tabcontent2");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = $(".tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("active", "");
        }
        document.getElementById(cityName).style.display = "block";
        //   evt.currentTarget.className += " active";
        $(this).addClass("active").animate({
            opacity: 1
        }, 300);

    }

    function setvaltoallbtn() {
        let defaltval = $("a.active").attr("href");
        defaltval = defaltval.substring(2, 3);
        $(".btn-viewall").attr("id", defaltval);
    }
</script>

</html>