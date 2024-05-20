
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("cdn.php"); ?>
    <link rel="stylesheet" href="css/register.scss">
</head>
<body>
    <?php include("header.php"); ?>
    <?php 

    $void = false;
    if(isset($_GET['id'])){
        $void = true;
        $id = $_GET['id'];
        $sql = "SELECT * FROM user WHERE user_id = '$id'";
        $qr = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($qr) or die ('error. '. mysqli_error($con));
    }
?>
<div class="contentz">
    <?php include("modal/loginmodal.php"); ?>

        <div class="container my-5">
            <div class="row">
                <div class="col w-75 mx-auto">
                    <div class="row py-2 w-50 mx-auto" style="border-bottom:1px solid black;font-size:28px">
                    <?php if($void == false){ ?>
                       <b> <span>สมัครสมาชิก</span></b>
                       <?php }else{ ?>
                        <b> <span>แก้ไขบัญชี</span></b>
                       <?php }?>
                    </div>

                    <?php if($void == false){ ?>

                    <form class=" animate py-4 mt-3 w-50 mx-auto" action="" id="regis-form" method="post">
                        <div class="container">
                            <label for="uname"><b>บัญชีผู้ใช้</b></label>
                                <input type="text" class='loin-input' placeholder="บัญชีผู้ใช้" name="uname" required>

                            <label for="psw"><b>รหัสผ่าน</b></label>
                                <input type="password" class='loin-input' placeholder="รหัสผ่าน" name="psw" id="psw" required>

                            <label for="psw"><b>ยืนยันรหัสผ่าน</b></label>
                                <input type="password" class='loin-input' placeholder="ยืนยันรหัสผ่าน" name="cfpsw" id="cfpsw" required>

                            <label for="name"><b>ชื่อ</b></label>
                                <input type="text" class='loin-input' placeholder="ชื่อ" name="name" required>

                            <label for="lastname"><b>นามสกุล</b></label>
                                <input type="text" class='loin-input' placeholder="นามสกุล" name="lastname" required>

                            <label for="email"><b>อีเมล</b></label>
                                <input type="email" class='loin-input' placeholder="อีเมล" name="email" required>

                            <label for="tell"><b>เบอร์โทร</b></label>
                                <input type="text" class='loin-input' placeholder="เบอร์โทร" name="tell" required>
                                <input type="hidden" name="action" value="register">
                            <button class='btn btn-custom ' type="submit">สมัครสมาชิก</button>
                        </div>
                    </form>

                    <?php }else{ ?>

                        <form class=" animate py-4 mt-3 w-50 mx-auto" action="" id="update-profile-form" method="post">
                        <div class="container">
                            <label for="uname"><b>บัญชีผู้ใช้</b></label>
                                <input type="text" class='loin-input' placeholder="บัญชีผู้ใช้" name="uname" value="<?php echo $row["username"] ?>" required>

                            <label for="psw"><b>รหัสผ่าน</b></label>
                                <input type="password" class='loin-input' placeholder="รหัสผ่านใหม่" name="psw" id="psw" required>

                            <label for="psw"><b>ยืนยันรหัสผ่าน</b></label>
                                <input type="password" class='loin-input' placeholder="ยืนยันรหัสผ่าน" name="cfpsw" id="cfpsw" required>

                            <label for="name"><b>ชื่อ</b></label>
                                <input type="text" class='loin-input' placeholder="ชื่อ" name="name" value="<?php echo $row["firstname"] ?>" required>

                            <label for="lastname"><b>นามสกุล</b></label>
                                <input type="text" class='loin-input' placeholder="นามสกุล" name="lastname" value="<?php echo $row["lastname"] ?>" required>

                            <label for="email"><b>อีเมล</b></label>
                                <input type="email" class='loin-input' placeholder="อีเมล" name="email" value="<?php echo $row["email"] ?>" required>

                            <label for="tell"><b>เบอร์โทร</b></label>
                                <input type="text" class='loin-input' placeholder="เบอร์โทร" name="tell" value="<?php echo $row["phone"] ?>" required>
                                <input type="hidden" name="action" value="update_profile">
                                <input type="hidden" name="uid" value="<?php echo $id; ?>">
                            <button class='btn btn-custom ' type="submit">บันทึกข้อมูล</button>
                            <button class='btn btn-custom ' data-toggle="modal" data-target="#upprofile">อัปโหลดรูปภาพ</button>
                        </div>
                    </form>

                    <?php } ?>
                </div>
            </div>
        </div>    
    </div>
        
    <?php include("footer.php"); ?>
    <?php include("modal/upprofile.php"); ?>
    <script src="js/index.js"></script>
    <script src="js/register.js"></script>
</body>
</html>