<?php
    session_start();
    include("config.php");
    $today = date("Y-m-d");
    if($_POST['action'] == "register"){
        $uname = $_POST['uname'];
        $psw = $_POST['psw'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $id = "00000";
        $email = $_POST['email'];
        $tell = $_POST['tell'];


        $sql = "SELECT * FROM `user` WHERE `username` = '$uname'";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));

        if($qr->num_rows > 0) {
            echo json_encode([
                "success"=> false,
                "text"=>"บัญชีผู้ใช้งานนี้มีในระบบแล้ว!",
                "num" => $qr->num_rows
            ]);
            return;
        }
 
        $sql = "INSERT INTO `user`(`username`,`password`,`email`,`firstname`,`lastname`,`idcard`,`phone`,`date`) VALUES ('$uname','$psw','$email','$name','$lastname','$id','$tell','$today')";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        if($qr){
            echo json_encode([
                "success"=>true,
                "text"=>"บันทึกสำเร็จ",
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"บันทึกไม่สำเร็จ",
            ]);  
        }
    }else if($_POST['action'] == "login"){
        $uname = $_POST['uname'];
        $psw = $_POST['psw'];

        $sql = "SELECT * FROM `user` WHERE `username`='$uname' AND `password` = '$psw'";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        
        if($qr->num_rows == 1){
            $row = mysqli_fetch_array($qr);
            if($row['role'] == "Y"){
                $_SESSION["userid"] = $row["user_id"];
                $_SESSION["firstname"] = $row["firstname"];
                $_SESSION["lastname"] = $row["lastname"];
                $_SESSION["status"] = $row["status"];

                if($_SESSION["status"]=="1"){ 
                    echo json_encode([
                        "success"=>true,
                        "text"=>"user"
                    ]);
                }
                if($_SESSION["status"]=="2"){ 
                    echo json_encode([
                        "success"=>true,
                        "text"=>"admin"
                    ]);
                }
            }else if($row['role'] == "N"){
                echo json_encode([
                    "success"=>"ban",
                    "text"=>"ban"
                ]);
            }
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"fail"
            ]);
        }
    }else if($_POST['action'] == "update_profile"){
        $uname = $_POST['uname'];
        $psw = $_POST['psw'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $id = $_POST['id'];
        $email = $_POST['email'];
        $tell = $_POST['tell'];
        $uid = $_POST['uid'];
        
        $sql = "UPDATE user SET username = '$uname',password = '$psw',firstname = '$name',lastname = '$lastname',idcard = '$id',phone = '$tell' WHERE user_id = '$uid'";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        if($qr){
            echo json_encode([
                "success"=>true,
                "text"=>"บันทึกสำเร็จ",
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"บันทึกไม่สำเร็จ",
            ]);  
        }
    }else if($_POST['action'] == "new_type_product"){
       $data = $_POST['data'];
        $sql = "INSERT INTO product_type (product_type_name) VALUES ('$data') ";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        if($qr){
            echo json_encode([
                "success"=>true,
                "text"=>"บันทึกสำเร็จ",
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"บันทึกไม่สำเร็จ",
            ]);  
        }
    }else if($_POST['action'] == "getall_type_product"){
         $sql = "SELECT * FROM  product_type";
         $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
         $arr = [];
         while($row = mysqli_fetch_assoc($qr)){
             array_push($arr,$row);
            }
            echo json_encode($arr);
    }else if($_POST['action'] == "edit_type_product"){
        $data = $_POST['data'];
        $id = $_POST['id'];
        $sql = "UPDATE product_type SET  product_type_name = '$data' WHERE product_type_id = '$id' ";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        if($qr){
            echo json_encode([
                "success"=>true,
                "text"=>"บันทึกสำเร็จ",
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"บันทึกไม่สำเร็จ",
            ]);  
        }
    }else if($_POST['action'] == "del_type_product"){
        $id = $_POST['id'];
        $sql = "DELETE FROM product_type  WHERE product_type_id = '$id' ";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        if($qr){
            echo json_encode([
                "success"=>true,
                "text"=>"บันทึกสำเร็จ",
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"บันทึกไม่สำเร็จ",
            ]);  
        }
    }else if($_POST['action'] == "getall_product"){
        $fill = $_POST['fill'];
        $sql = "";
        if($fill == "all"){
             $sql = "SELECT * FROM  product INNER JOIN product_type ON product.product_type_id = product_type.product_type_id";
        }else if($fill == "less"){
            $sql = "SELECT * FROM  product INNER JOIN product_type ON product.product_type_id = product_type.product_type_id WHERE product.qty < 10";
        }else if($fill == "over"){
            $sql = "SELECT * FROM  product INNER JOIN product_type ON product.product_type_id = product_type.product_type_id WHERE product.qty = 0";
        }
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        $arr = [];
        while($row = mysqli_fetch_assoc($qr)){
            array_push($arr,$row);
           }
           echo json_encode($arr);
    }else if($_POST['action'] == "get_one_product"){
        $id = $_POST['id'];

        $sql = "SELECT * FROM  product INNER JOIN product_type ON product.product_type_id = product_type.product_type_id WHERE product_id = '$id'";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        $row = mysqli_fetch_assoc($qr);

        $sql2 = "SELECT * FROM  img WHERE ref_id = '$id'";
        $qr2 = mysqli_query($con,$sql2) or die ('error. '. mysqli_error($con));
        $arr = [];
        while($row2 = mysqli_fetch_assoc($qr2)){
            array_push($arr,$row2);
           }
        echo json_encode(["right"=>$row,"left"=>$arr]);
   
    }else if($_POST['action'] == "del-img"){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $sql = "DELETE FROM img  WHERE img_id = '$id' ";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        if($qr){
            $file = "../uploads/".$name;
            unlink($file);
            echo json_encode([
                "success"=>true,
                "text"=>"บันทึกสำเร็จ",
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"บันทึกไม่สำเร็จ",
            ]);  
        }
    }else if($_POST['action'] == "del-product"){
        $id = $_POST['id'];
        $sql = "DELETE FROM product  WHERE product_id = '$id' ";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        if($qr){
            echo json_encode([
                "success"=>true,
                "text"=>"บันทึกสำเร็จ",
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"บันทึกไม่สำเร็จ",
            ]);  
        }
    }else if($_POST['action'] == "getmember"){
        $sql = "SELECT * FROM  user WHERE status = '1'";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        $arr = [];
        while($row = mysqli_fetch_assoc($qr)){
            array_push($arr,$row);
           }
           echo json_encode($arr);
    }else if($_POST['action'] == "set-role"){
        $id = $_POST['id'];
        $role = $_POST['role'];
        $sql = "UPDATE user SET role ='$role'  WHERE user_id = '$id' ";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        if($qr){
            echo json_encode([
                "success"=>true,
                "text"=>"บันทึกสำเร็จ",
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"บันทึกไม่สำเร็จ",
            ]);  
        }
    }else if($_POST['action'] == "get-one-member"){
        $id = $_POST['id'];
        $sql = "SELECT * FROM  user  WHERE user_id = '$id'";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        $row = mysqli_fetch_assoc($qr);
       
            echo json_encode($row);
        
    }else if($_POST['action'] == "del-member"){
        $id = $_POST['id'];
        $sql = "DELETE FROM user  WHERE user_id = '$id' ";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        if($qr){
            echo json_encode([
                "success"=>true,
                "text"=>"บันทึกสำเร็จ",
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"บันทึกไม่สำเร็จ",
            ]);  
        }
    }else if($_POST['action'] == "add-tem"){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $qty = "1";
        $img = $_POST['img'];

        $sql = "SELECT promotion FROM  product  WHERE product_id = '$id'";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        $row = mysqli_fetch_assoc($qr);
        $promo = $row['promotion'];

        if(isset($_SESSION['cart'])){
            $item_array_id = array_column($_SESSION['cart'],"item_id");
            if(!in_array($id,$item_array_id)){
                $count =count($_SESSION['cart']);
                $item_array = array(
                    'item_id'  =>  $id,
                    'item_name' => $name,
                    'item_price' => $price,
                    'item_quantity' => $qty,
                    'item_img' => $img,
                    'promo' =>$promo
                );
                $_SESSION["cart"][$count] = $item_array;
                echo json_encode([
                    "success"=>true,
                    "text"=>"success",
                ]);
            }
            else{
                echo json_encode([
                    "success"=>false,
                    "text"=>"haveitem",
                ]);
            }
        }
        else {
            $item_array = array(
                'item_id'  =>  $id,
                    'item_name' => $name,
                    'item_price' => $price,
                    'item_quantity' => $qty,
                    'item_img' => $img,
                    'promo' =>$promo
            );
            $_SESSION["cart"][0] = $item_array;
            echo json_encode([
                "success"=>true,
                "text"=>"success",
            ]);
        }
       
        // echo '<pre>'.print_r($_SESSION,TRUE) .'</pre>';
    }else if($_POST['action'] == "cart"){
         
        if(!empty($_SESSION["cart"])){ 
            $cart = $_SESSION['cart'];
             echo json_encode([
                    "success"=>true,
                    "text"=>$cart,
                ]);
        }else{
             echo json_encode([
                    "success"=>false,
                    "text"=>"empty",
                ]);
        }
        
    }else if($_POST['action'] == "getpromotion"){
        $idd = $_POST['id'];
        $sql = "SELECT promotion FROM  product  WHERE product_id = '$idd'";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        $row = mysqli_fetch_assoc($qr);
            echo json_encode($row);
    }else if($_POST['action'] == "remove-item"){
        $idd = $_POST['id'];
        //   echo '<pre>'.print_r($_SESSION,TRUE) .'</pre>';
        //   exit;
        foreach($_SESSION['cart'] as $key=>$value){
			if($value['item_id'] == $idd){
				unset($_SESSION['cart'][$key]);
			}
		}
        echo json_encode([
            "success"=>true,
            "text"=>"success",
        ]);
    }else if($_POST['action'] == "order"){

        $name = $_POST['adname'];
        $item = $_POST['years'];
        $phone = $_POST['phone'];
        $adress = $_POST['adress'];
        $id = $_POST['ssid'];
        $NewDate=Date('Y-m-d', strtotime('+3 days'));
        
        foreach ($item as $key => $value) {
            $it_id = $value["id"];
            $it_qty = $value["qty"];
            $it_total = $value["total"];
        $qr3 = mysqli_query($con,"SELECT qty,product_name FROM product WHERE product_id = '$it_id'");
        $row3 = mysqli_fetch_assoc($qr3);
        $count = $qr3->num_rows;  
            for($i=0 ; $i < $count ; $i++){
                $mg =  $row3['qty'] - $it_qty  ;
                $pname = $row3['product_name'];
                if($row3['qty'] < $it_qty){
                    echo json_encode([
                        "success"=>false,
                        "text"=>"nostock",
                        "product"=> $pname
                    ]);
                    exit;
                }
            } 
        }


        $sql = "INSERT INTO `tb_order`(`member_id`,`order_date`,`order_end`,`person_name`,`person_detail`,`person_phone`) 
        VALUES ('$id',now(),'$NewDate','$name','$adress','$phone')";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        $mc = mysqli_insert_id($con);

        foreach ($item as $key => $value2) {
            $it_id2 = $value2["id"];
            $it_qty2 = $value2["qty"];
            $it_total3 = $value2["total"];

        $sql2 = "INSERT INTO order_detail (order_ref,product_id,qty,total)
        VALUES ('$mc','$it_id2','$it_qty2','$it_total3')";
        $qr2 = mysqli_query($con,$sql2) or die ('error. '. mysqli_error($con));

        $qr4 = mysqli_query($con,"SELECT qty,product_name FROM product WHERE product_id = '$it_id2'");
        $row3 = mysqli_fetch_assoc($qr4);
        $count = $qr4->num_rows;  

        // for($i=0 ; $i < $count ; $i++){
        //     $mg2 =  $row3['qty'] - $it_qty2  ;
            
        //     $sql5 = "UPDATE product SET  qty = $mg2 WHERE  product_id = $it_id2 ";
        //     $query9 = mysqli_query($con, $sql5);
        // }

        }
        if($qr && $qr2 && $qr4){
            unset($_SESSION['cart']);
            echo json_encode([
                "success"=>true,
                "text"=>"success"
                
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"false",
            ]);
        }
    }else if($_POST['action'] == "get-one-orderdetail"){
        $id = $_POST['id'];
        $sql = "SELECT product.product_name,img.img_name,product.price,order_detail.order_ref,
                        tb_order.order_date,tb_order.person_name,tb_order.person_detail,
                        tb_order.person_phone,tb_order.order_status,order_detail.qty,tb_order.member_id,
                        product.product_id,tb_order.pay_date,tb_order.pay_slip,tb_order.pay_amount,
                        tb_order.order_id,order_detail.total,product.promotion, tb_order.order_status, tb_order.logis_method, tb_order.tracking_code  
                FROM order_detail 
                INNER JOIN product ON order_detail.product_id = product.product_id 
                INNER JOIN tb_order ON order_detail.order_ref = tb_order.order_id 
                INNER JOIN img ON product.product_id = img.ref_id 
                WHERE order_detail.order_ref = '$id' GROUP BY product.product_id";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        $arr = [];
        while($row = mysqli_fetch_assoc($qr)){
            array_push($arr,$row);
           }
            echo json_encode($arr);
    }else if($_POST['action'] == "del-order"){
        $id = $_POST['id'];

        $sql2 = "UPDATE tb_order SET order_status = '4' WHERE  order_id = $id ";
        $qr2 = mysqli_query($con,$sql2) or die ('error. '. mysqli_error($con));

        //คำสั่งลบออเดอร์ และ ข้อมูลออเดอร์สินค้า
        // $sql = "DELETE FROM tb_order  WHERE order_id = '$id' ";
        // $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));

        // $sql2 = "DELETE FROM order_detail  WHERE order_ref = '$id' ";
        // $qr2 = mysqli_query($con,$sql2) or die ('error. '. mysqli_error($con));

        $sql = "SELECT * FROM order_detail WHERE order_ref = '$id'";
        $qr1 = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        while($row = mysqli_fetch_assoc($qr1)){
                $pid = $row['product_id'];
                $qty = $row['qty'];
            
            $qr4 = mysqli_query($con,"SELECT qty FROM product WHERE product_id = '$pid'");
            $f4 = mysqli_fetch_assoc($qr4);
            $sum = $f4['qty'] + $qty;

            $sql3 = "UPDATE product SET qty = '$sum' WHERE  product_id = '$pid' ";
            $qr3 = mysqli_query($con,$sql3) or die ('error. '. mysqli_error($con));
          
            
        }
       
        if($qr2 && $qr4 && $qr3 && $qr1){
            echo json_encode([
                "success"=>true,
                "text"=>"บันทึกสำเร็จ",
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "text"=>"บันทึกไม่สำเร็จ",
            ]);  
        }
    }else if($_POST['action'] == "get_order"){
        $id = $_POST['id'];
        $sql = "SELECT * FROM  tb_order  WHERE member_id = '$id' ORDER BY order_id DESC";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        
        $arr = [];
        while($row = mysqli_fetch_assoc($qr)){
            array_push($arr,$row);
           }
            echo json_encode($arr);
       
            
        
    }else if($_POST['action'] == "getall_category"){
        $type = $_POST['type'];
        $val = $_POST['val'];
        $filter = " ";
            if($type == 'pay_stt'){
                $filter = "tb_order.order_status = ".$val;
                if($val == "1.5"){
                    $filter = "tb_order.order_status = '1' AND tb_order.pay_slip != ''";
                }else if($val == "1"){
                    $filter = "tb_order.order_status = '1' AND tb_order.pay_slip = ''";
                }
                
            }else if($type == 'key'){
                $filter = "user.firstname LIKE '%".$val."%'";
            }else if($type == 'all'){
                $filter = "tb_order.order_id > 0";
            }else if($type == 'date'){
                $filter = " CAST(tb_order.order_date AS DATE) = '".$val."'";
            }
        //    echo $filter;
        //    exit;
        $sql = "SELECT * FROM  tb_order 
                INNER JOIN user ON tb_order.member_id = user.user_id
                WHERE tb_order.order_id > 0
                AND $filter
                ";
        $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
        $arr = [];
        while($row = mysqli_fetch_assoc($qr)){
            array_push($arr,$row);
           }
           echo json_encode($arr);
   }else if($_POST['action'] == "save_slip"){
    $id = $_POST['id'];
    $val = $_POST['val']; 


    //เช็คสต๊อคพอมั้ย 

    $sql = "SELECT product.product_name FROM order_detail 
            INNER JOIN product ON order_detail.product_id = product.product_id 
            WHERE order_ref = $id AND product.qty < order_detail.qty"; 

    $qr2 = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));

    $arr = [];
    if($qr2->num_rows > 0) {
        while($row = mysqli_fetch_assoc($qr2)){
            array_push($arr,$row['product_name']);
        }

        $string = implode(", ",$arr);
        echo json_encode([
            "success"=> false,
            "message" => "สินค้า " . $string . " จำนวนไม่เพียงพอ"
        ]);
        return;
    }

    //ตัดสต๊อค
    $sqlCutStock = "UPDATE product INNER JOIN order_detail ON (order_detail.product_id = product.product_id)
        SET product.qty = product.qty - order_detail.qty
        WHERE order_ref = $id ";
    
    $cutstock = mysqli_query($con,$sqlCutStock) or die ('error. '. mysqli_error($con));

    $sql2 = "UPDATE tb_order SET  pay_amount = $val , order_status = '2' WHERE  order_id = $id ";
    $qr2 = mysqli_query($con,$sql2) or die ('error. '. mysqli_error($con));

    if($qr2 && $sqlCutStock){
        echo json_encode([
            "success"=>true,
            "text"=>"บันทึกสำเร็จ",
        ]);
    }else{
        echo json_encode([
            "success"=>false,
            "text"=>"บันทึกไม่สำเร็จ",
        ]);  
    }
   }else if($_POST['action'] == "sentpsd"){
    $id = $_POST['id'];
    
    $tracking_code = $_POST['tracking_code'] ?? null;

    $sql2 = "UPDATE tb_order SET order_status = '3', tracking_code = '$tracking_code' WHERE  order_id = $id ";
    $qr2 = mysqli_query($con,$sql2) or die ('error. '. mysqli_error($con));
    if($qr2){
        echo json_encode([
            "success"=>true,
            "text"=>"บันทึกสำเร็จ",
        ]);
    }else{
        echo json_encode([
            "success"=>false,
            "text"=>"บันทึกไม่สำเร็จ",
        ]);  
    }
   }else if($_POST['action'] == "rp_day"){
        $val = $_POST['val'];
       
        $type = $_POST['type'];
      
        $sql2 = "";
            if($type == 'day'){

                $start = $_POST['val']['start'];
                $end = $_POST['val']['end'];

                $sql2 = "SELECT tb_order.order_id , sum(order_detail.total) AS total , tb_order.order_date 
                    FROM tb_order 
                    INNER JOIN order_detail ON tb_order.order_id = order_detail.order_ref
                    WHERE  tb_order.order_status != '1' AND tb_order.order_status != '4'
                    ";

                if(!!$start) {
                    $sql2 .= "AND DATE(tb_order.order_date) >= '$start'";
                }

                if(!!$end) {
                    $sql2 .= "AND DATE(tb_order.order_date) <= '$end'";
                }

                $sql2 .= "GROUP BY tb_order.order_id";
               
            }else if($type == 'month'){
                $val = $val."%";
                $sql2 = "SELECT tb_order.order_id , sum(order_detail.total) AS total , tb_order.order_date, COUNT(DISTINCT tb_order.order_id) as cnt 
                    FROM tb_order INNER JOIN order_detail ON tb_order.order_id = order_detail.order_ref 
                    WHERE tb_order.order_date LIKE '$val' AND tb_order.order_status != '1' AND tb_order.order_status != '4' 
                    GROUP BY DATE(tb_order.order_date)";
            }else if($type == 'year'){
                $val = $val."%";
                $sql2 = "SELECT tb_order.order_id , sum(order_detail.total) AS total , tb_order.order_date ,  COUNT(DISTINCT tb_order.order_id) as cnt 
                    FROM tb_order INNER JOIN order_detail ON tb_order.order_id = order_detail.order_ref 
                    WHERE tb_order.order_date LIKE '$val' AND tb_order.order_status != '1' AND tb_order.order_status != '4' 
                    GROUP BY MONTH(tb_order.order_date)";
            }
        $qr = mysqli_query($con,$sql2) or die ('error. '. mysqli_error($con));
        $arr = [];
            while($row = mysqli_fetch_assoc($qr)){
                array_push($arr,$row);
            }
           echo json_encode($arr);
   }else if($_POST['action'] =="rp_bestsale" ){
    
    $sql = "SELECT product_id,sum(qty) AS qty,sum(total) AS total,status FROM order_detail WHERE status!='1' GROUP BY product_id ORDER BY sum(total) DESC LIMIT 5";
    $qr = mysqli_query($con,$sql) or die (mysqli_error($con));
    $arr =[];         
    while($row = mysqli_fetch_assoc($qr)){         
     array_push($arr,$row);
    } 
        echo json_encode($arr);
}else if($_POST['action'] =="get_product_name" ){
    $id = $_POST['id'];
   $sql = "SELECT product_name FROM product WHERE product_id = '$id'";
   $qr = mysqli_query($con,$sql) or die (mysqli_error($con));
   $row = mysqli_fetch_assoc($qr);
   echo json_encode($row["product_name"]);
}
else if($_POST['action'] =="save_bank" ){
    $bank_name = $_POST['bank_name'];
    $bank_type = $_POST['bank_type'];
    $bank_number = $_POST['bank_number'];
    $ownner_number = $_POST['ownner_number'];
    $sql = "INSERT INTO `tb_bank`(`b_name`,`b_type`,`b_number`,`b_owner`,`b_date`) 
    VALUES ('$bank_name','$bank_type','$bank_number','$ownner_number','$today')";
    $qr = mysqli_query($con,$sql) or die (mysqli_error($con));
    if($qr){
        echo json_encode([
            "success"=>true,
            "text"=>"บันทึกสำเร็จ",
        ]);
    }else{
        echo json_encode([
            "success"=>false,
            "text"=>"บันทึกไม่สำเร็จ",
        ]);  
    }
}else if($_POST['action'] =="getbank" ){
    
    $sql = "SELECT * FROM tb_bank";
    $qr = mysqli_query($con,$sql) or die (mysqli_error($con));
    $arr =[];         
    while($row = mysqli_fetch_assoc($qr)){         
     array_push($arr,$row);
    } 
        echo json_encode($arr);
}else if($_POST['action'] =="edit_bank" ){
    $id = $_POST['id'];
    $sql = "SELECT * FROM tb_bank WHERE b_id = '$id'";
    $qr = mysqli_query($con,$sql) or die (mysqli_error($con));
         
  $row = mysqli_fetch_assoc($qr);       
  
        echo json_encode($row);
}else if($_POST['action'] =="edit_btn_new_bank" ){
    $bank_name = $_POST['bank_name'];
    $bank_type = $_POST['bank_type'];
    $bank_number = $_POST['bank_number'];
    $ownner_number = $_POST['ownner_number'];
    $id = $_POST['id'];
    $sql = "UPDATE tb_bank SET b_name = '$bank_name',b_type = '$bank_type',b_number = '$bank_number',
            b_owner = '$ownner_number',b_date = '$today' WHERE b_id = '$id'";
    $qr = mysqli_query($con,$sql) or die (mysqli_error($con));
    if($qr){
        echo json_encode([
            "success"=>true,
            "text"=>"บันทึกสำเร็จ",
        ]);
    }else{
        echo json_encode([
            "success"=>false,
            "text"=>"บันทึกไม่สำเร็จ",
        ]);  
    }
}else if($_POST['action'] == "remove_bank"){
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_bank  WHERE b_id = '$id' ";
    $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
    if($qr){
        echo json_encode([
            "success"=>true,
            "text"=>"บันทึกสำเร็จ",
        ]);
    }else{
        echo json_encode([
            "success"=>false,
            "text"=>"บันทึกไม่สำเร็จ",
        ]);  
    }
}else if($_POST['action'] == "add_promotion"){
    $id = $_POST['id'];
    $val = $_POST['val'];
    $sql = "UPDATE  product SET promotion = '$val'  WHERE product_id = '$id' ";
    $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
    if($qr){
        echo json_encode([
            "success"=>true,
            "text"=>"บันทึกสำเร็จ",
        ]);
    }else{
        echo json_encode([
            "success"=>false,
            "text"=>"บันทึกไม่สำเร็จ",
        ]);  
    }
}else if($_POST['action'] == "del_promotion"){
    $id = $_POST['id'];
    $sql = "UPDATE  product SET promotion = '0'  WHERE product_id = '$id' ";
    $qr = mysqli_query($con,$sql) or die ('error. '. mysqli_error($con));
    if($qr){
        echo json_encode([
            "success"=>true,
            "text"=>"บันทึกสำเร็จ",
        ]);
    }else{
        echo json_encode([
            "success"=>false,
            "text"=>"บันทึกไม่สำเร็จ",
        ]);  
    }
}else if($_POST['action'] == "rp_year"){
    $val = $_POST['val'];
    $val =$val."%";
    $sql2 = "SELECT tb_order.order_id , sum(order_detail.total) AS total , tb_order.order_date 
                    FROM tb_order INNER JOIN order_detail ON tb_order.order_id = order_detail.order_ref 
                    WHERE tb_order.order_date LIKE '$val' AND tb_order.order_status != '1' AND tb_order.order_status != '4' 
                    GROUP BY MONTH(tb_order.order_date)";
       
        $qr = mysqli_query($con,$sql2) or die ('error. '. mysqli_error($con));
        $arr = [];
            while($row = mysqli_fetch_assoc($qr)){
                array_push($arr,$row);
            }
           echo json_encode($arr);
}else if($_POST['action'] == "get-one-bank"){
    $val = $_POST['val'];
    $sql = mysqli_query($con,"SELECT * FROM tb_bank WHERE b_id = '$val'")or die ('error. '. mysqli_error($con));
    $row = mysqli_fetch_assoc($sql);
    echo json_encode($row);
}else if($_POST['action'] == "like-tem"){
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $sql1 = mysqli_query($con,"SELECT * FROM whitelist WHERE wl_user_id = '$user_id' AND wl_product_id='$id'")or die ('error. '. mysqli_error($con));
    $row = mysqli_fetch_assoc($sql1);
    $row_id = $row['wl_id'];
    if($sql1->num_rows >= 1){

        $sql2 = mysqli_query($con,"DELETE FROM whitelist WHERE wl_id = '$row_id'")or die ('error. '. mysqli_error($con));
        if($sql2){
        echo json_encode([
            "success"=>false,
            "text"=>"unlike",
        ]);
        exit;
        }
    }
    $sql = mysqli_query($con,"INSERT INTO whitelist (wl_user_id,wl_product_id) VALUES ('$user_id','$id')")or die ('error. '. mysqli_error($con));
    if($sql){
        
        echo json_encode([
            "success"=>true,
            "text"=>"like",
        ]);
    }else{
        echo json_encode([
            "success"=>false,
            "text"=>"บันทึกไม่สำเร็จ",
        ]);  
    }
}else if($_POST['action'] == "getheart"){
    $val = $_POST['user_id'];
    $sql = mysqli_query($con,"SELECT * FROM whitelist WHERE wl_user_id = '$val'")or die ('error. '. mysqli_error($con));
    $arr = [];
    while($row = mysqli_fetch_assoc($sql)){
        array_push($arr,$row);
    }
   echo json_encode($arr);
}else if($_POST['action'] == "getlike-person"){
    $val = $_POST['user_id'];
    $qr = "SELECT img.img_name,product.product_name,product.promotion,product.qty,product.product_id,product.price,whitelist.* 
            FROM product INNER JOIN product_type ON product.product_type_id = product_type.product_type_id 
            INNER JOIN whitelist ON product.product_id = whitelist.wl_product_id 
            INNER JOIN img ON product.product_id = img.ref_id 
            WHERE whitelist.wl_user_id = '$val' GROUP BY product.product_id";
    $sql = mysqli_query($con,$qr)or die ('error. '. mysqli_error($con));
    $arr = [];
    while($row = mysqli_fetch_assoc($sql)){
        array_push($arr,$row);
    }
   echo json_encode($arr);
}else if($_POST['action'] == "del-whitelise"){
    $id = $_POST['id'];
    $sql2 = mysqli_query($con,"DELETE FROM whitelist WHERE wl_id = '$id'")or die ('error. '. mysqli_error($con));
    if($sql2){
        echo json_encode([
            "success"=>true,
            "text"=>"บันทึกสำเร็จ",
        ]);
    }else{
        echo json_encode([
            "success"=>false,
            "text"=>"บันทึกไม่สำเร็จ",
        ]);  
    }
}


?>