

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <b>เข้าสู่ระบบ</b> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="modal-content animate py-4" action="" id="form-login" method="post">
            <div class="container">
            <label for="uname"><b>บัญชีผู้ใช้</b></label>
                <input type="text" class='loin-input' placeholder="บัญชีผู้ใช้" name="uname" required>

            <label for="psw"><b>รหัสผ่าน</b></label>
                <input type="password" class='loin-input' placeholder="รหัสผ่าน" name="psw" required>
                <input type="hidden" name="action" value="login">   
            <button class='btn btn-custom' type="submit">เข้าสู่ระบบ</button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <a href="register.php" type="button" class="btn btn-custom">สมัครสมาชิก</a>
      </div>
    </div>
  </div>
</div>