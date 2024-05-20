$(document).ready(function(){ 
    $("body").on("submit","#regis-form",function(e){
        e.preventDefault();
        let psw = $("#psw").val();
        let cfpsw = $("#cfpsw").val();
        if(psw != cfpsw){
            swal("รหัสผ่านไม่ตรงกัน", "", "error");
            $("#psw").val("");
            $("#cfpsw").val("");
            $("#psw").focus();
            return
        }
        let data = $(this).serialize();
        $.post("api/api.php",data,function(res){
            let eresponse =$.parseJSON(res);
            if(eresponse.success){
                swal(eresponse.text,"", "success");
                $( '#regis-form' ).each(function(){
                this.reset();
                
                });
            }else{
                swal(eresponse.text, "", "error");
            }
        });
    });

    $("body").on("submit","#form-login",function(e){
        e.preventDefault();
        let data = $(this).serialize();
        $.post("api/api.php",data,function(res){
            let eresponse =$.parseJSON(res);
            if(eresponse.success == "ban" && eresponse.text == "ban"){
                swal("error 404", "บัญชีของคุณไม่สามารถใช้งานได้กรุณาติดต่อทางร้านค่ะ", "error");
            }
            if(eresponse.success && eresponse.text == "user" ){
                swal("เข้าสู่ระบบสำเร็จ","", "success");
                setTimeout(function () {
                    window.location.href = "index.php"
                  }, 700);
                
            }
            if(eresponse.success && eresponse.text == "admin"){
                swal("เข้าสู่ระบบสำเร็จ","", "success");
                setTimeout(function () {
                    window.location.href = "backend/index.php"
                  }, 700);
            }
            if(eresponse.success == false ){
                swal("error 404", "", "error");
            }
        });
    });

    $("body").on("submit","#update-profile-form",function(e){
        e.preventDefault();
        let psw = $("#psw").val();
        let cfpsw = $("#cfpsw").val();
        if(psw != cfpsw){
            swal("รหัสผ่านไม่ตรงกัน", "", "error");
            $("#psw").val("");
            $("#cfpsw").val("");
            $("#psw").focus();
            return
        }
        let data = $(this).serialize();
        $.post("api/api.php",data,function(res){
            let eresponse =$.parseJSON(res);
            if(eresponse.success){
                swal(eresponse.text,"", "success");
            }else{
                swal(eresponse.text, "", "error");
            }
        });
    });


});