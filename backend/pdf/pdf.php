<?php 
include '../../api/config.php';
session_start();
$Aname = $_SESSION['firstname'];
$lname = $_SESSION['lastname'];
$type = "";
$date = "";
$type_day = "วันที่";
if(isset($_GET['type'])){
    $type = $_GET['type'];
}
if($type == 'left'){
    $type = 'รายงานสินค้าคงเหลือ';
    $date = date("Y-m-d");
    $lastX = 150;
}else if($type == 'bestsale'){
    $type = 'รายงานการขายสินค้า 5 อันดับ';
    $date = date("Y-m-d");
    $lastX = 150;
}else if($type == 'day'){
    $type= 'รายงานยอดขายแยกตามวัน';
    $day = $_GET['url_date'];
    $date = substr($day,0,10);
    $lastX = 150;
}else if($type == 'month'){
    $type= 'รายงานยอดขายแยกตามเดือน';
    $day = $_GET['url_date'];
    $date = substr($day,5,2);
    $year = substr($day,0,4);
    $realvalue = $year."-".$date;
    $lastX = 150;
    switch($date)
            {
            case "1":
            $date = " มกราคม";
            break;
            case "2":
            $date = "กุมภาพันธ์";
            break;
            case "3":
            $date = "มีนาคม";
            break;
            case "4":
            $date = "เมษายน";
            break;
            case "5":
            $date = "พฤษภาคม";
            break;
            case "6":
            $date = "มิถุนายน";
            break;
            case "7":
            $date = "กรกฎาคม";
            break;
            case "8":
            $date = "สิงหาคม";
            break;
            case "9":
            $date = "กันยายน";
            break;
            case "10":
            $date = "ตุลาคม";
            break;
            case "11":
            $date = "พฤศจิกายน";
            break;
            case "12":
            $date = "ธันวาคม";
            break;
            }

    $type_day = "เดือน";
    $date = $date." ".$year;
}else if($type == 'year'){
    $type= 'รายงานยอดขายแยกตามปี';
    $day = $_GET['url_date'];
    $type_day = "ปี";
    $year = substr($day,0,4);
    $date = $year;
    $lastX = 150;
}
require('fpdf.php');
define('FPDF_FONTPATH','font/');

class PDF extends FPDF
{
    
  
    // Page header
    function Header()
    {
        // $this->Image('logo.png',30,10,19);
        // $this->Image('watermark.png',65,110,80);

        $this->SetFont('THSarabunNew','B',16);

        

        // Line break
        $this->Ln(20);
    }

    // Page footer
   
}
    $pdf = new PDF();
    
	
    
    $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
    $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');

$pdf->AddPage();
$pdf->Image('logo.jpg',175,5,25,25);
$compayname = 'Eggshop ';
$address = 'หมู่ 2 ต.ต้นธง อ.เมือง จ.ลำพูน 51000';
$tall = '065-019-3663';


$pdf->SetY(20);
$pdf->Cell(73);
$pdf->Cell(40, 10, iconv('UTF-8', 'cp874', $type));

$pdf->SetXY(35,30);
$pdf->Cell(40, 10, iconv('UTF-8', 'cp874', 'ชื่อร้าน  '.$compayname.'  ที่อยู่  '.$address.'  เบอร์โทร  '.$tall),0,0,'L');


$pdf->SetXY(65,40);
$pdf->Cell(82, 10, iconv('UTF-8', 'cp874', 'รายงาน ณ '.$type_day.' '.$date),0,0,'C');


if($type == 'รายงานสินค้าคงเหลือ'){
$pdf->SetXY(40,50);
// set จำนวนช่องและขนาดของตาราง
$pdf->Cell(25,10, iconv( 'UTF-8', 'cp874', 'รหัส'),1,0,'C');
$pdf->Cell(80,10, iconv( 'UTF-8', 'cp874', 'ชื่อสินค้า' ),1,0,'C');
$pdf->Cell(30,10, iconv( 'UTF-8', 'cp874', 'จำนวน' ),1,0,'C');

$sql = "SELECT * FROM product ORDER BY qty ASC";
$result=mysqli_query($con,$sql);
$i = 60 ;
while($row = mysqli_fetch_assoc($result)){ 
    $p_id = $row['product_id'];
    $rid ;
    if($p_id < 10){
       $rid = "P000".$p_id;
   }else if($p_id < 100){
       $rid = "P00".$p_id;
   }else if($p_id < 1000){
       $rid = "P0".$p_id;
   }
    $pdf->SetFont('THSarabunNew','',14);
    $pdf->SetXY(40,$i);
    $pdf->Cell(25,10, iconv( 'UTF-8', 'cp874', $rid),1,0,'C');
    $pdf->Cell(80,10, iconv( 'UTF-8', 'cp874', $row['product_name'] ),1,0,'C');
    $pdf->Cell(30,10, iconv( 'UTF-8', 'cp874', $row['qty'] ),1,0,'C');
    $i+=10;
}
}else if($type == 'รายงานการขายสินค้า 5 อันดับ'){
$pdf->SetXY(33,50);
// set จำนวนช่องและขนาดของตาราง
$pdf->Cell(15,10, iconv( 'UTF-8', 'cp874', 'ลำดับ'),1,0,'C');
$pdf->Cell(25,10, iconv( 'UTF-8', 'cp874', 'รหัสสินค้า' ),1,0,'C');
$pdf->Cell(60,10, iconv( 'UTF-8', 'cp874', 'ชื่อสินค้า'),1,0,'C');
$pdf->Cell(15,10, iconv( 'UTF-8', 'cp874', 'จำนวน' ),1,0,'C');
$pdf->Cell(25,10, iconv( 'UTF-8', 'cp874', 'รวม' ),1,0,'C');
$sql="SELECT product_id,sum(qty) AS qty,sum(total) AS total,status FROM order_detail WHERE status!='1' GROUP BY product_id ORDER BY sum(total) DESC LIMIT 5";
$result=mysqli_query($con,$sql)or die("Error :Database ERROR on tableproduct");
$i = 60 ;
$o = 1 ;
while(list($p_id,$qty,$sum) =@ mysqli_fetch_array($result)){ 
            $sql4 = "SELECT product_name FROM product WHERE product_id = '$p_id'";
                 $result4 = mysqli_query($con,$sql4) or die("Error :Database ERROR on productname");
                 $select_name=mysqli_fetch_array($result4);
                 $name = $select_name['product_name'];
                 $rid ;
                 if($p_id < 10){
                    $rid = "P000".$p_id;
                }else if($p_id < 100){
                    $rid = "P00".$p_id;
                }else if($p_id < 1000){
                    $rid = "P0".$p_id;
                }
    $pdf->SetFont('THSarabunNew','',14);
    $pdf->SetXY(33,$i);
    $pdf->Cell(15,10, iconv( 'UTF-8', 'cp874', $o++),1,0,'C');
    $pdf->Cell(25,10, iconv( 'UTF-8', 'cp874', $rid ),1,0,'C');
    $pdf->Cell(60,10, iconv( 'UTF-8', 'cp874',  $name ),1,0,'C');
    $pdf->Cell(15,10, iconv( 'UTF-8', 'cp874', $qty),1,0,'C');
    $pdf->Cell(25,10, iconv( 'UTF-8', 'cp874', number_format($sum,2) ),1,0,'C');
    $i+=10;
}

}else if($type == 'รายงานยอดขายแยกตามวัน'){
    
    $pdf->SetXY(43,50);
    // set จำนวนช่องและขนาดของตาราง
    $pdf->Cell(20,10, iconv( 'UTF-8', 'cp874', 'ลำดับ'),1,0,'C');
    $pdf->Cell(60,10, iconv( 'UTF-8', 'cp874', 'เวลา' ),1,0,'C');
    $pdf->Cell(50,10, iconv( 'UTF-8', 'cp874', 'ยอดขาย'),1,0,'R');
    $date = $date."%";
    $sql = "SELECT tb_order.order_id , sum(order_detail.total) AS total , tb_order.order_date 
            FROM tb_order 
            INNER JOIN order_detail ON tb_order.order_id = order_detail.order_ref 
            WHERE tb_order.order_date LIKE '$date' AND tb_order.order_status != '1' AND tb_order.order_status != '4'
            GROUP BY tb_order.order_id";
    $qr = mysqli_query($con,$sql) or die (mysqli_error($con));
    $i = 60 ;
    $o = 1 ;
    $total = 0;
   
    while($row =  mysqli_fetch_array($qr)){ 
        
    $pdf->SetFont('THSarabunNew','',14);
    $subdate = $row['order_date'];
  
    $price = $row['total'];
    $total += $price;
    $pdf->SetXY(43,$i);
    $pdf->Cell(20,10, iconv( 'UTF-8', 'cp874', $o++),1,0,'C');
    $pdf->Cell(60,10, iconv( 'UTF-8', 'cp874', substr($subdate,11,16) ),1,0,'C');
    $pdf->Cell(50,10, iconv( 'UTF-8', 'cp874', number_format($price,2)),1,0,'R');
    $i+=10;
}
// echo "<pre>";
// print_r($row,false);
// echo "</pre>";
// exit;
    // $total = $total + $price ;
    $pdf->SetFont('THSarabunNew','B',16);
    $pdf->SetXY(43,($i));
    $pdf->Cell(130, 10, iconv('UTF-8', 'cp874', 'รวม'),1,0,'L');
    $pdf->SetXY(43,($i));
    $pdf->Cell(130, 10, iconv('UTF-8', 'cp874', number_format($total,2)),1,0,'R');
    
    
}else if($type == 'รายงานยอดขายแยกตามเดือน'){
    $pdf->SetXY(43,50);
    // set จำนวนช่องและขนาดของตาราง
    $pdf->Cell(20,10, iconv( 'UTF-8', 'cp874', 'ลำดับ'),1,0,'C');
    $pdf->Cell(60,10, iconv( 'UTF-8', 'cp874', 'วันที่' ),1,0,'C');
    $pdf->Cell(50,10, iconv( 'UTF-8', 'cp874', 'ยอดขาย'),1,0,'R');
    $month = $realvalue."-%";
    
    $sql = "SELECT tb_order.order_id , sum(order_detail.total) AS total , tb_order.order_date 
                    FROM tb_order INNER JOIN order_detail ON tb_order.order_id = order_detail.order_ref 
                    WHERE tb_order.order_date LIKE '$month' AND tb_order.order_status != '1' AND tb_order.order_status != '4' 
                    GROUP BY DATE(tb_order.order_date)";
        $qr = mysqli_query($con,$sql) or die (mysqli_error($con));
          
        $o = 1;   
        $i = 60 ; 
        $total = 0;
        while($row = mysqli_fetch_assoc($qr)){         
            $pdf->SetFont('THSarabunNew','',14);
            
            $total += $row['total'];
            $pdf->SetXY(43,$i);
            $pdf->Cell(20,10, iconv( 'UTF-8', 'cp874', $o++),1,0,'C');
            $pdf->Cell(60,10, iconv( 'UTF-8', 'cp874', substr($row['order_date'],0,11) ),1,0,'C');
            $pdf->Cell(50,10, iconv( 'UTF-8', 'cp874',  number_format($row['total'],2)),1,0,'R');
            $i+=10;
            
        } 
    $pdf->SetFont('THSarabunNew','B',16);
    $pdf->SetXY(43,($i));
    $pdf->Cell(130, 10, iconv('UTF-8', 'cp874', 'รวม'),1,0,'L');
    $pdf->SetXY(43,($i));
    $pdf->Cell(130, 10, iconv('UTF-8', 'cp874', number_format($total,2)),1,0,'R');
}else if($type ==  'รายงานยอดขายแยกตามปี'){
    $pdf->SetXY(43,50);
    // set จำนวนช่องและขนาดของตาราง
    $pdf->Cell(20,10, iconv( 'UTF-8', 'cp874', 'ลำดับ'),1,0,'C');
    $pdf->Cell(60,10, iconv( 'UTF-8', 'cp874', 'เดือนที่' ),1,0,'C');
    $pdf->Cell(50,10, iconv( 'UTF-8', 'cp874', 'ยอดขาย'),1,0,'R');

    $year = $year."-%";
       
        $sql = "SELECT tb_order.order_id , sum(order_detail.total) AS total , tb_order.order_date 
        FROM tb_order INNER JOIN order_detail ON tb_order.order_id = order_detail.order_ref 
        WHERE tb_order.order_date LIKE '$year' AND tb_order.order_status != '1' AND tb_order.order_status != '4' 
        GROUP BY MONTH(tb_order.order_date)";
        $qr = mysqli_query($con,$sql) or die (mysqli_error($con));

        $o = 1;   
        $i = 60 ; 
        $total = 0;
        while($row = mysqli_fetch_assoc($qr)){         
            $pdf->SetFont('THSarabunNew','',14);
            
            $total += $row['total'];
            $pdf->SetXY(43,$i);
            $pdf->Cell(20,10, iconv( 'UTF-8', 'cp874', $o++),1,0,'C');
            $pdf->Cell(60,10, iconv( 'UTF-8', 'cp874', substr($row['order_date'],0,7) ),1,0,'C');
            $pdf->Cell(50,10, iconv( 'UTF-8', 'cp874', number_format($row['total'],2)),1,0,'R');
            $i+=10;
        } 
    $pdf->SetFont('THSarabunNew','B',16);
    $pdf->SetXY(43,($i));
    $pdf->Cell(130, 10, iconv('UTF-8', 'cp874', 'รวม'),1,0,'L');
    $pdf->SetXY(43,($i));
    $pdf->Cell(130, 10, iconv('UTF-8', 'cp874', number_format($total,2)),1,0,'R');
}





$pdf->Output();
?>