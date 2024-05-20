
<div class="modal fade" id="upprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b>แผนที่</b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <form class="animate py-4 text-center" action="upProfile.php"  method="post" enctype="multipart/form-data">
                <?php if($row["user_img"] == ""){ ?>
                    <img src="https://www.w3schools.com/howto/img_avatar2.png"  class="avatar mx-auto" >
                <?php }else { ?>
                    <img src="uploads/<?php echo $row["user_img"]; ?>"  class="avatar mx-auto" >
                <?php } ?>
                <input type="hidden" name="id" value="<?php echo $row["user_id"]; ?>">
                <input type="file" name="photos[]" class='loin-input' id="photoimg"/>
                <?php if($row["user_img"] == ""){ ?>
                    <input type="hidden" name='check_old_img' value="no_img">
                <?php }else { ?>
                  <input type="hidden" name='check_old_img' value="<?php echo $row["user_img"]; ?>">
                <?php } ?>
                <button class='btn btn-custom'  >บันทึก</button>
        </form>
   
    </div>
  </div>
</div>
