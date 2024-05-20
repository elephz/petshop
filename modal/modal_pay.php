
<style>
    .containerr {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.containerr input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.containerr:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.containerr input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.containerr input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.containerr .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
</style>

<div class="modal fade" id="modal_pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b>รายละเอียดการโอนเงิน</b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            
      <form class="animate py-4" action="api/uploadslip.php" id="form-newproduct" method="post" enctype="multipart/form-data">
      
          <div class="container">
              <!-- <div class="row"> 
                <div class="col text-center">
                    <img src="img/web.png" alt="" class='w-100'>
                </div>
              </div> -->
              <select name="" id="tb_bank" class='loin-input'>
                <option value="" disabled>เลือกธนาคาร</option>
                <?php 
                  $number = "";
                  $owner = "";
                  $sql = mysqli_query($con,"SELECT * FROM tb_bank")or die ('error. '. mysqli_error($con)); 
                  $i = 0;
                  while($row = mysqli_fetch_assoc($sql)){
                    if($i == 0) {
                      $number = $row['b_number'];
                      $owner = $row['b_owner'];
                    }
                    $i++;
                ?>
                <option value="<?= $row['b_id'] ?>"><?= $row['b_name'] ?></option>
                  <?php } ?>
              </select>
            <p><span> <b>เลขที่บัญชี : </b></span><span id="pay_id_modal"><?= $number?></span></p>
            <p><span> <b>ชื่อบัญชี : </b></span><span id="pay_name_modal"><?= $owner?></span></p>
            <p><span> <b>จำนวน :  </b></span><span id="pay_amount_modal"></span></p>
            <p><span> <b>ช่องทางการจัดส่ง  </b></span></p>
            <label class="containerr">ไปรษณีย์ไทย
                <input type="radio" value="ไปรษณีย์ไทย" checked="checked" name="radio">
                <span class="checkmark"></span>
            </label>
            <label class="containerr">kerry express
                <input type="radio" value="kerry express" name="radio">
                <span class="checkmark"></span>
            </label>
            <label class="containerr">j & t express
                <input type="radio" value="j & t express" name="radio">
                <span class="checkmark"></span>
            </label>
            <label class="containerr">flash express
                <input type="radio" value="flash express" name="radio">
                <span class="checkmark"></span>
            </label>
            <input type="hidden" id="nf_ref_id" name="nf_ref_id" val="">
            <p><span> <b>หลักฐานการโอนเงิน : </b></span></p>
                <input type="file" name="photos[]" class='loin-input' id="photoimg"  />
            <button class='btn btn-custom' type="submit"  >บันทึก</button>
            </div>
      </form>
    </div>
  </div>
</div>