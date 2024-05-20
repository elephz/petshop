<?php


include('config.php');
$today = date("Y-m-d");

$product_name = $_POST['ed_productname'];
$product_type = $_POST['product_type'];
$price = $_POST['ed_price'];
$detail = $_POST['ed_detail'];
$qty = $_POST['ed_qty'];
$id = $_POST['id'];
    

$sql = "UPDATE product SET qty = '$qty', product_name = '$product_name',product_description ='$detail',product_type_id= '$product_type',price ='$price'
         WHERE  product_id = '$id'";
$qr1 = mysqli_query($con,$sql) or die ('Unable to execute query. '. mysqli_error($con));



define ("MAX_SIZE","2000"); // 2MB MAX file size
function getExtension($str){
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
        }
// ตรวจสอบนามสกุลของภาพที่อัพโหลด 
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") 
{
$uploaddir = "../uploads/"; //โฟลเดอร์ที่เก็บภาพ อย่าลืมสร้างนะครับ!!
foreach ($_FILES['photos']['name'] as $name => $value)
{
$filename = stripslashes($_FILES['photos']['name'][$name]);
$size=filesize($_FILES['photos']['tmp_name'][$name]);
//Convert extension into a lower case format
$ext = getExtension($filename);
$ext = strtolower($ext);
//File extension check
if(in_array($ext,$valid_formats))
{
//ขนาดของภาพหน้ามเกิน 1mb
if ($size < (MAX_SIZE*1024))
{ 
$image_name=time().$filename; 
// echo "<img src='".$uploaddir.$image_name."' class='imgList'>"; 
$newname=$uploaddir.$image_name; 
//อัพโหลดไฟล์ไปในโฟลเดอร์ที่กำหนด
if (move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname)) 
{ 

//เพิ่มเข้าฐานข้อมูล
$sqluplado = "INSERT INTO img(ref_id,img_name)VALUES('$id','$image_name')";
$qr = mysqli_query($con,$sqluplado) ;
}
else 
{ 
echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>'; } 
}

else 
{ 
echo '<span class="imgList">You have exceeded the size limit!</span>'; 
} 

} 

else 
{ 
echo '<span class="imgList">Unknown extension!</span>'; 
} 

} //foreach end

} 

if($qr || $qr1){echo "<script> window.location = '../backend/index.php?P=product'</script>";}

                
?>