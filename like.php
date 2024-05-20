
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("cdn.php"); ?>
    <link rel="stylesheet" href="css/main.scss">
    <link rel="stylesheet" href="css/cart.scss">
    <style>
        .del-whitelise{
            text-decoration: none;
            color:#ff6666;
            transition: 0.3s;
            cursor: pointer;
        }
        .del-whitelise:hover{
            color:#1d2547;
        }
    </style>
</head>
<body>
    <?php 
    
    include("header.php");
    
     ?> 
    <div class="contentz">
    <?php include("modal/loginmodal.php"); ?>
        <div class="container my-5 py-5" style="background:#F5F5F5">
        <div class="row" >
            <table class="w-100 my-5 mx-5" id="tb-like">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th>โปรโมชัน</th>
                        <th>สถานะ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="like">
            
            
                </tbody>
            </table>
        </div>
        </div>
    </div>
        <?php include("footer.php"); ?>
       
</body>
<?php include("modal/address.php"); ?>
<script src="js/index.js"></script>
<script src="js/register.js"></script>
<script src="js/cart.js"></script>
<script src="js/like.js"></script>
</html>