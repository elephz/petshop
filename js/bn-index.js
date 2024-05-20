$(document).ready(function(){
    console.log(type);
    if(type == "member"){
        getmember();
    }else if(type == "category"){
            
            console.log(show);
       
            category('all',0);
        
        if(show == "neworder"){
            // $("#btn_prr_1").click();
             category('pay_stt','1');
        }if(show == "wait"){
            // $("#btn_prr_11").click();
             category('pay_stt','1.5');
        }if(show == "payed"){
            // $("#btn_prr_2").click();
             category('pay_stt','2');
        }if(show == "logis"){
            // $("#btn_prr_3").click();
             category('pay_stt','3');
        }if(show == "cancle"){
            // $("#btn_prr_1").click();
             category('pay_stt','4');
        }
        
    }else if(type == "product"){
        if(show == "all"){
            getproduct("all");
        }if(show == "less"){
            getproduct("less");
        }if(show == "over"){
            getproduct("over");
        }
    }else if(type == "product_type"){
        getNewproduct();
    }else if(type =="leftinstock"){
        pagination("leftinstock",8);
    }else if(type =="bank"){
        getbank();
    }
 
    
    $("body").on("click",".rp_day",function(e){
        let url_date = $("#datepick").val();
        swal("PDF", "รายงานยอดขายประจำวัน", "success");
        setTimeout(function () { 
            window.open('pdf/pdf.php?type=day&url_date=' + url_date+', _blank');
            // window.open('report/pdf/pdf.php?type=day&url_date=' + url_date+', _blank');
          }, 1000);
       
    });
    $("body").on("click",".rp_month",function(e){
        let url_date = $("#monthpick").val();
        swal("PDF", "รายงานยอดขายประจำเดือน", "success");
        setTimeout(function () {
            window.open('pdf/pdf.php?type=month&url_date=' + url_date+', _blank');
            // window.open('report/pdf/pdf.php?type=day&url_date=' + url_date+', _blank');
          }, 1000);
    });
    $("body").on("click",".rp_year",function(e){
        let url_date = $("#yearpick").val();
        swal("PDF", "รายงานยอดขายประจำปี", "success");
        setTimeout(function () {
            window.open('pdf/pdf.php?type=year&url_date=' + url_date+', _blank');
            // window.open('report/pdf/pdf.php?type=day&url_date=' + url_date+', _blank');
          }, 1000);
    });
    $("body").on("click",".btntopdf_leftinstock",function(e){
        swal("PDF", "รายงานสินค้าคงเหลือ", "success");
        setTimeout(function () {
            window.open('pdf/pdf.php?type=left');
            // window.open('report/pdf/pdf.php?type=day&url_date=' + url_date+', _blank');
          }, 1000);
    });
  function getbank(){
    $.post("../api/api.php",{action:"getbank"},function(res){
        let ps =$.parseJSON(res);
        let row;
        let emprow;
        let id;
        emprow +=
            "<tr>"+
                "<td colspan='6'>ไม่มีข้อมูล</td>"+
            "</tr>";
        if(isEmpty(ps)){
            $("#bank").html(emprow);
        }
        $.each(ps,function(k,v){

            let num = Number(v.b_id);
            if(num < 10){
                id = "B000"+num;
            }else if(num < 100){
                id = "B00"+num;
            }else if(num < 1000){
                id = "B0"+num;
            }
    row +=
        "<tr>"+
            "<td>"+id+"</td>"+
            "<td>"+v.b_name+"</td>"+
            "<td>"+v.b_number+"</td>"+
            "<td>"+v.b_owner+"</td>"+
            "<td><a href='' class='edit_bank mng-btn' data-toggle='modal' data-target='#edit_bank' id='"+v.b_id+"' ><i class='fas fa-edit'></i></a></td>"+
            "<td><a href='' class='remove_bank mng-btn' tname='"+id+"' id='"+v.b_id+"' ><i class='fas fa-times'></i></a></td>"+
       "</tr>";
       

})
$("table > #bank").html(row);
    })
  }
  $("body").on("click",".edit_bank",function(e){
    e.preventDefault();
    let id = $(this).attr("id");
    $.post("../api/api.php",{action:"edit_bank",id:id},function(res){
        let ps =$.parseJSON(res);
        $("#edit_bank_name").val(ps.b_name);
        $("#edit_bank_type").val(ps.b_type);
        $("#edit_bank_number").val(ps.b_number);
        $("#edit_ownner_number").val(ps.b_owner);
        $("#edit_bank_id").val(ps.b_id);
    });
  });
  $("body").on("click","#btn_new_bank",function(e){
        e.preventDefault();
        let bank_name = $("#bank_name").val();
        let bank_type = $("#bank_type").val();
        let bank_number = $("#bank_number").val();
        let ownner_number = $("#ownner_number").val();
        $.post("../api/api.php",{action:"save_bank",bank_name:bank_name,bank_type:bank_type,bank_number:bank_number,ownner_number:ownner_number},function(res){
            let ps =$.parseJSON(res);
            if(ps.success == true){
                swal("บันทึกสำเร็จ", "", "success");
                setTimeout(function () { 
                    $("#newbank").modal("hide");
                    getbank();
                }, 700);
            }
        });
  });
  $("body").on("click","#edit_btn_new_bank",function(e){
    e.preventDefault();
    let bank_name = $("#edit_bank_name").val();
    let bank_type = $("#edit_bank_type").val();
    let bank_number = $("#edit_bank_number").val();
    let ownner_number = $("#edit_ownner_number").val();
    let id = $("#edit_bank_id").val();

    $.post("../api/api.php",{action:"edit_btn_new_bank",bank_name:bank_name,bank_type:bank_type,bank_number:bank_number,ownner_number:ownner_number,id:id},function(res){
        let ps =$.parseJSON(res);
        if(ps.success == true){
            swal("บันทึกสำเร็จ", "", "success");
            setTimeout(function () { 
                $("#edit_bank").modal("hide");
            }, 700);
        }
    });
});
$("body").on("click",".remove_bank",function(e){
    e.preventDefault();
    let id = $(this).attr("id");
    let name = $(this).attr("tname");
    swal({
        title: "ลบสมาชิก",
        text: "ต้องการบัญชี "+name+" ใช่หรือไม่?",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true
      }, 
      function () {
        setTimeout(function () {
            $.post("../api/api.php",{action:"remove_bank",id:id},function(res){
                let ps =$.parseJSON(res);
                if(ps.success == true){
                    swal("ลบสำเร็จ","", "success");
                    getbank();
                }
            });
        }, 500);
      });
}); 
    $("body").on("click",".btn_type_cat",function(e){
        let val = $(this).attr("val");
        if(val == '0'){
            category('all',0);
        }else{
            category('pay_stt',val);
        }
            
    });
    $("body").on("change",".cata_datepicker",function(e){
            let val = $(this).val();
            category('date',val);
    });
    $("body").on("keyup","#search_category", function(){
    let val = $(this).val();
            category('key',val);
});
    // category
// member
var monthNamesThai = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม"];
var dayNames = ["อา.","จ.","อ.","พ.","พฤ","ศ.","ส."];

function getmember(){
    console.log("reltimg");
    $.post("../api/api.php",{action:"getmember"},function(res){
        let ps =$.parseJSON(res);
        let row;
        
        let emprow;
        let id;
        emprow +=
            "<tr>"+
                "<td colspan='5'>ไม่มีข้อมูล</td>"+
            "</tr>";
        if(isEmpty(ps)){
            $("#t5").html(emprow);
        }
        $.each(ps,function(k,v){

            let name = v.firstname+" "+v.lastname;
            let num = Number(v.user_id);
            if(num < 10){
                id = "M000"+num;
            }else if(num < 100){
                id = "M00"+num;
            }else if(num < 1000){
                id = "M0"+num;
            }
    row +=
        "<tr>"+
            "<td>"+id+"</td>"+
            "<td>"+name+"</td>"+
            "<td>"+v.phone+"</td>"+
            "<td>"+((v.role == 'Y') ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>" )+"</td>"+
            "<td> <a href='' class='set-role mng-btn' role = '"+v.role+"' id='"+v.user_id+"' >"+((v.role == 'Y') ? "<i class='fas fa-times-circle'></i>" : "<i class='fas fa-check-circle'></i>" )+"</a></td>"+
            "<td><a href='' class='view-member mng-btn'  data-toggle='modal' data-target='#viewmember'  id='"+v.user_id+"' ><i class='fas fa-search'></i></a></td>"+ 
            "<td> <a href='' class='del-member mng-btn' name='"+name+"' id='"+v.user_id+"' ><i class='fas fa-times'></i></a></td>"+
       "</tr>";
       

})
$("table > #t5").html(row);
    }).then(()=>{
        pagination("tbl_member",8);
    });
}
$("body").on("click",".del-member",function(e){
    e.preventDefault();
    let id = $(this).attr("id");
    let name = $(this).attr("name");
    swal({
        title: "ลบสมาชิก",
        text: "ต้องการคุณ"+name+"ใช่หรือไม่?",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true
      }, 
      function () {
        setTimeout(function () {
            $.post("../api/api.php",{action:"del-member",id:id},function(res){
                let ps =$.parseJSON(res);
                if(ps.success == true){
                    swal("ลบสำเร็จ","", "success");
                    getmember();
                }
            });
        }, 700);
      });
});
$("body").on("click",".view-member",function(e){
    e.preventDefault();
    let id = $(this).attr("id");
   $(".em_img").html("");
    $.post("../api/api.php",{id:id,action:"get-one-member"},function(res){
        let rs =$.parseJSON(res);
        let realid;
        let name = rs.firstname+" "+rs.lastname;
            let num = Number(rs.user_id);
            if(num < 10){
                realid = "M000"+num;
            }else if(num < 100){
                realid = "M00"+num;
            }else if(num < 1000){
                realid = "M0"+num;
            }
        var d = new Date(rs.date);
        let date = dayNames[d.getDay()]+"  "+d.getDate()+" "+monthNamesThai[d.getMonth()]+"  "+(d.getFullYear()+543) ;
        $("#s_memberid").html(realid);
        $("#s_memberacc").html(rs.username);
        $("#s_membername").html(name);
        $("#s_memberphone").html(rs.phone);
        $("#s_membermail").html(rs.email);
        $("#s_memberidcard").html(rs.	idcard);
        $("#s_memberdate").html(date);
        if(rs.user_img == ""){
            
            $(".em_img").append("<img src='https://www.w3schools.com/howto/img_avatar2.png' class='avatar' >");
        }else{
            $(".em_img").append("<img src='../uploads/"+rs.user_img+"' class='w-100' >");
        }
    });
});
$("body").on("click",".set-role",function(e){
    e.preventDefault();
    let id = $(this).attr("id");
    let role = $(this).attr("role");
    let newrole;
    if(role == 'Y'){
        newrole = 'N';
    }else if (role == 'N'){
        newrole = 'Y';
    }
    $.post("../api/api.php",{id:id,action:"set-role",role:newrole},function(res){
        let rs =$.parseJSON(res);
        if(rs.success == true){
            getmember();
        }
    });
});

$("body").on("keyup","#search_member", function(){
    searchtb($(this).val(),"#tbl_member tr");
    console.log($(this).val());
});
// $("body").on("keyup","#search_category", function(){
//     searchtb($(this).val(),"#tbl_category tr");
//     console.log($(this).val());
// });
// member

    // newtypeproduct
    $("#btn_new_type_product").click(function(e){
       let data = $(".input_new_type_product").val();
       console.log(data);
      
       $.post("../api/api.php",{data:data,action:"new_type_product"},function(res){
        let eresponse =$.parseJSON(res);
        if(eresponse.success){
            swal(eresponse.text,"", "success");
            setTimeout(function () {
                getNewproduct();
                $(".input_new_type_product").val("");
                $('#newProduct_type').modal('hide');
              }, 800);
              
        }else{
            swal(eresponse.text, "", "error");
        }
    });
    })

    function getNewproduct(){
        console.log("reltimg");
        $.post("../api/api.php",{action:"getall_type_product"},function(res){
            let ps =$.parseJSON(res);
            let row;
            let a = 1;
            let emprow;
            emprow +=
                "<tr>"+
                    "<td colspan='5'>ไม่มีข้อมูล</td>"+
                "</tr>";
            if(isEmpty(ps)){
                $("#t3").html(emprow);
            }
            $.each(ps,function(k,v){
        
        row +=
            "<tr>"+
                "<td>"+a+"</td>"+
                "<td>"+v.product_type_name+"</td>"+
                "<td><a href='' class='edit mng-btn'  data-toggle='modal' data-target='#editProduct_type' name='"+v.product_type_name+"' id='"+v.product_type_id+"' ><i class='fas fa-edit'></i></a></td>"+ 
                "<td> <a href='' class='remove mng-btn' id='"+v.product_type_id+"' ><i class='fas fa-times'></i></a></td>"+
           "</tr>";
           a++;

    })
    $("table > #t3").html(row);
        });
    }

    $("body").on("click",".edit",function(e){
        console.log("dd");
        e.preventDefault();
        let data = $(this).attr("name");
        let id = $(this).attr("id");
        console.log(data);
        $(".input_edit_type_product").val(data);
        $("#edit_product_id").val(id);
        
    });

    $("body").on("click","#btn_edit_type_product",function(e){
        e.preventDefault();
        let data = $(".input_edit_type_product").val();
        let id = $("#edit_product_id").val();
        
        $.post("../api/api.php",{data:data,id:id,action:"edit_type_product"},function(res){
            let eresponse =$.parseJSON(res);
            if(eresponse.success){
                swal(eresponse.text,"", "success");
                setTimeout(function () {
                    getNewproduct();
                    $('#editProduct_type').modal('hide');
                  }, 800);
                  getNewproduct();
            }else{
                swal(eresponse.text, "", "error");
            }
        });
        
    });
    $("body").on("click",".remove",function(e){
        e.preventDefault();
        let id = $(this).attr("id");
        $.post("../api/api.php",{id:id,action:"del_type_product"},function(res){
            let eresponse =$.parseJSON(res);
            if(eresponse.success){
                swal(eresponse.text,"", "success");
                setTimeout(function () {
                    getNewproduct();
                    $('#editProduct_type').modal('hide');
                  }, 800);
                 
            }else{
                swal(eresponse.text, "", "error");
            }
        });
    });
// newtypeproduct
// newproduct
$("body").on("submit","#newProduct", function(){ 
    //$("#preview").html('');
   
$("#newProduct").ajaxForm({target: '#preview', 
  beforeSubmit:function(){ 
 //เมื่ออัพโหลดภาพไปแล้วจะแสดงไฟล์ .gif loading
 console.log('ttest');
 $("#imageloadstatus").show();
  $("#imageloadbutton").hide();
  }, 
  
  //อัพโหลดเสร็จแล้วซ่อนไฟล์ .gif loading
 success:function(){ 
 console.log('test');
  $("#imageloadstatus").hide();
  $("#imageloadbutton").show();
 }, 
 //error
 error:function(){ 
 console.log('xtest');
  $("#imageloadstatus").hide();
 $("#imageloadbutton").show();
 } }).submit();
 

});





function category(type,val){
    // $("#nav").remove();
    console.log("reltimg");
    $.post("../api/api.php",{action:"getall_category",type:type,val:val},function(res){
        let ps =$.parseJSON(res);
        let row;
        let a = 1;
        let emprow;
        let id ;
        emprow +=
            "<tr>"+
                "<td colspan='6'>ไม่มีข้อมูล</td>"+
            "</tr>";
        if(isEmpty(ps)){
            $("#t6").html(emprow);
        }
        $.each(ps,function(k,v){
            let name = v.firstname+" "+v.lastname;
            var d = new Date(v.order_date);
            console.log(d);
            let num = Number(v.order_id);
            if(num < 10){
                id = "OR000"+num;
            }else if(num < 100){
                id = "OR00"+num;
            }else if(num < 1000){
                id = "OR0"+num;
            }
            let stt ;
            if(v.order_status == '1' && v.pay_slip == ''){
                stt = 'รายการใหม่'
            }if(v.order_status == '1' && v.pay_slip != ''){
                stt = 'รอการตรวจสอบ'
            }
            if(v.order_status == '2'){
                stt = 'ชำระเงินแล้ว'
            }if(v.order_status == '3'){
                stt = 'ส่งสินค้าแล้ว'
            }if(v.order_status == '4'){
                stt = 'ยกเลิกสินค้า'
            }
            var d = new Date(v.order_date);
    row +=
        "<tr>"+
            "<td>"+id+"</td>"+
            "<td>"+name+"</td>"+
            "<td>"+d.getHours()+":"+d.getMinutes()+" "+dayNames[d.getDay()]+"  "+d.getDate()+" "+monthNamesThai[d.getMonth()]+"  "+(d.getFullYear()+543)+"</td>"+
            "<td>"+stt+"</td>"+
            "<td><a href='' data-toggle='modal' data-target='#view_order' class='view_order mng-btn' id='"+v.order_id+"'  ><i class='fas fa-search'></i></a></td>"+
       "</tr>";
       a++;

})

$("table > #t6").html(row);
    }).then(()=>{
        pagination("tbl_category",7);
    });
    
}
$("body").on("click",".view_order",function(e){
    $(".rowpaystt_img").html(" ");
    $(".btm_content").html(" ");
    let id = $(this).attr("id");
   
    $.post("../api/api.php",{action:"get-one-orderdetail",id:id},function(res){
        let rs =$.parseJSON(res);
        let row;
        let totala = 0;
        let idd;
        $.each(rs,function(k,v){
            let num = Number(v.product_id);
            if(num < 10){
                idd = "P000"+num;
            }else if(num < 100){
                idd = "P00"+num;
            }else if(num < 1000){
                idd = "P0"+num;
            }
            let total = Number(v.total);
            totala += Number(total);
            let newval = "";
            let type = "";
            let vv = "-";
            if(v.promotion != "0"){
                newval  = v.promotion.substring(1);
                type = v.promotion.substring(0,1);
                vv = "-"+newval+""+type;
            }
    row +=
        "<tr>"+
            "<td style='padding:5px 5px;'>"+idd+"</td>"+
            "<td style='text-align:left;padding:5px 5px;'>"+v.product_name+"</td>"+
            "<td style='text-align:right;padding:5px 5px;'>"+(Number(v.price)).toFixed(2)+"</td>"+
            "<td>"+vv+"</td>"+
            "<td style='padding:5px 5px;'>"+v.qty+"</td>"+
            "<td style='text-align:right;padding:5px 5px;'>"+(Number(total)).toFixed(2)+"</td>"+
       "</tr>";

      
})
var d = new Date(rs[0].order_date);
console.log(d);
let pay_stt;
let btm_content;
if(rs[0].order_status == "1" && rs[0].pay_slip == ""){
   
    btm_content = "<h7><b>**ยังไม่มีการอัปโหลดสลิปโอนเงิน**</b></h7>";
   
}else if(rs[0].order_status == "2" || rs[0].order_status == "3" ){
   

    btm_content = "<h7><b>ข้อมูลการชำระเงิน</b></h7>"+
            "<div class='grid_product'>"+
                "<div class='product_item'>"+
                    "<img src='../uploads/"+rs[0].pay_slip+"' class='w-100'>"+
                "</div>"+
                " <div class='product_item'>"+
                    "</hr>"+

                    "<labe>หมายเลขพัสดุ</label>"+
                    "<input type='text' class='form-control mb-3' id='tracking_code'>"+
                    "<p> <span><b> จำนวนเงิน  </b></span>"+(Number(rs[0].pay_amount)).toFixed(2)+" บาท</p>"+
                    "<p > <span> <b> วันที่ชำระเงิน : </b> </span> "+d.getDate()+" "+monthNamesThai[d.getMonth()]+"  "+(d.getFullYear()+543)+" </p>"+
                    "<button class='btn-custom sentpsd p-3 "+((rs[0].order_status == "2") ? "show" : "hide")+"' id='"+rs[0].order_id+"'>จัดส่งสินค้า</button>"+
                "</div>"
            "</div>";
}
else if(rs[0].order_status == "1" && rs[0].payslip != ""){
    const total = rs.reduce((a, b) => a + +(b.total), 0)
    btm_content = "<h7><b>ข้อมูลรอการตรวจสอบ</b></h7>"+
            "<div class='grid_product'>"+
                "<div class='product_item'>"+
                    "<img src='../uploads/"+rs[0].pay_slip+"' class='w-100'>"+
                "</div>"+
                " <div class='product_item'>"+
                    "<p> <input type='hidden' id='valamount' class='loin-input' value='"+total+"'>"+
                    "<p > <span> <b> วันที่ชำระเงิน : </b> </span> "+d.getDate()+" "+monthNamesThai[d.getMonth()]+"  "+(d.getFullYear()+543)+" </p>"+
                    "<button class='btn-custom save_slip p-3' id='"+rs[0].order_id+"'>ยืนยันการชำระเงิน</button>"+
                "</div>"
            "</div>";
}
$(".btm_content").html(btm_content);
let ic ;
let num = Number(rs[0].order_ref);
            if(num < 10){
                ic = "OR000"+num;
            }else if(num < 100){
                ic = "OR00"+num;
            }else if(num < 1000){
                ic = "OR0"+num;
            }
let mc ;
let num2 = Number(rs[0].member_id);
            if(num2 < 10){
                mc = "M000"+num2;
            }else if(num2 < 100){
                mc = "M00"+num2;
            }else if(num2 < 1000){
                mc = "M0"+num2;
            }

    switch (rs[0].order_status) {
        case "1":
            pay_stt = 'รอการชำระเงิน'
            break;
        case "2":
            pay_stt = 'ชำระเงินแล้ว'
            break;
        case "3":
            pay_stt = 'สำเร็จ'
            break;
        case "4":
            pay_stt = 'ยกเลิกออเดอร์'
            break;
    }


$("table > #tb_view_order").html(row);
$("#modal_orid").html(ic);
$("#modal_stt").html(pay_stt);
$("#modal_date").html(d.getHours()+":"+d.getMinutes()+" "+dayNames[d.getDay()]+"  "+d.getDate()+" "+monthNamesThai[d.getMonth()]+"  "+(d.getFullYear()+543));
$("#modal_id").html(mc);
$("#modal_phone").html(rs[0].person_phone);
$("#modal_address").html(rs[0].person_detail);
$("#total_modal").html((Number(totala)).toFixed(2)+"บาท");
console.log("sss");
    });
});
$("body").on("click",".save_slip",function(e){
    let id = $(this).attr("id");
    let val = $("#valamount").val();
    console.log(val);
    if(val == ''){
        swal("กรุณากรอกจำนวนเงิน","", "error");
        return;
    }
    $.post("../api/api.php",{action:"save_slip",id:id,val:val},function(res){
        let ps =$.parseJSON(res);
        if(ps.success == true){
            swal("บันทึกสำเร็จ","", "success");
            setTimeout(function () { 
                $('#view_order').modal('hide');
                category('all',0);
            }, 700);
            
        } else {
            swal("",ps.message, "error");
        }
    });
});$("body").on("click",".sentpsd",function(e){
    let id = $(this).attr("id");

    const tracking_code = $("input#tracking_code").val()
    
    $.post("../api/api.php",{action:"sentpsd",id, tracking_code},function(res){
        let ps =$.parseJSON(res);
        if(ps.success == true){
            swal("บันทึกสำเร็จ","", "success");
            setTimeout(function () { 
                $('#view_order').modal('hide');
                category('all',0);
            }, 700);
            
        }
    });
});
function getproduct(type){
    fill = type;
    console.log("reltimg");
    $.post("../api/api.php",{action:"getall_product",fill:fill},function(res){
        let ps =$.parseJSON(res);
        let row;
        let a = 1;
        let emprow;
        let id ;
        emprow +=
            "<tr>"+
                "<td colspan='5'>ไม่มีข้อมูล</td>"+
            "</tr>";
        if(isEmpty(ps)){
            $("#t4").html(emprow);
        }
        $.each(ps,function(k,v){
            let num = Number(v.product_id);
            if(num < 10){
                id = "P000"+num;
            }else if(num < 100){
                id = "P00"+num;
            }else if(num < 1000){
                id = "P0"+num;
            }
            let newval = v.promotion.substring(1,3);
            let type = v.promotion.substring(0,1);
            let vv = newval+""+type;
            let p = "<button class='btn-custom showpromotion' data-toggle='modal' val='"+v.promotion+"' id='"+v.product_id+"' data-target='#addpromotion'>-"+vv+"</button>";
    row +=
        "<tr>"+
            "<td>"+id+"</td>"+
            "<td>"+v.product_name+"</td>"+
            "<td>"+v.product_type_name+"</td>"+
            "<td style='text-align:right'>"+v.price+"฿</td>"+
            "<td>"+((v.promotion == "0") ? "<button class='btn-custom add_promotion' data-toggle='modal' id='"+v.product_id+"' data-target='#addpromotion'><i class='fas fa-plus-square'></i></button>" :p )+"</td>"+
            "<td><a href='' class='view_product mng-btn' data-toggle='modal' data-target='#viewProduct' id='"+v.product_id+"' ><i class='fas fa-search'></i></a></td></td>"+
            "<td><a href='' class='edit_product mng-btn'  data-toggle='modal' data-target='#editProduct'  id='"+v.product_id+"' ><i class='fas fa-edit'></i></a></td>"+ 
            "<td> <a href='' class='remove_product mng-btn' tname='"+v.product_name+"' id='"+v.product_id+"' ><i class='fas fa-times'></i></a></td>"+
       "</tr>";
       a++;

})
$("table > #t4").html(row);

    }).then(()=>{
       console.log("hey");
        pagination("tbl_emp",7);
    });

  
      
}
$("body").on("click",".showpromotion",function(e){
    let id = $(this).attr("id");
    let val = $(this).attr("val");
    let newval = val.substring(1,3);
    let type = val.substring(0,1);
    $("[value='"+type+"']").attr('selected','selected');
    $("#promotion_product_id").val(id);
    $("#amount_sale").val(newval);
    $(".remove_promotion_area").html("<button  id='"+id+"' class='btn btn-custom btn_delpromotion'  >ลบโปรโมชัน</button>")
});
$("body").on("click",".add_promotion",function(e){
    $("#promotion_product_id").val("");
    $("#amount_sale").val("");
    $(".remove_promotion_area").html("");
    $("#promotion_product_id").val("");
    let id = $(this).attr("id");
    $("#promotion_product_id").val(id);
});
$("body").on("click",".btn_delpromotion",function(e){
    let id = $(this).attr("id");
    $.post("../api/api.php",{action:"del_promotion",id:id,},function(res){
        let ps =$.parseJSON(res);
            if(ps.success == true){
                swal("ลบสำเร็จ", "", "success");
                setTimeout(function () { 
                    $("#addpromotion").modal("hide");
                    getproduct("all");
                }, 300);
            }
    });
});
$("body").on("click","#btn_savepromotion",function(e){
    e.preventDefault();
    let amount = $("#amount_sale").val();
    let type = $("#sale_type").val();
    let id =$("#promotion_product_id").val();

    let val = type+""+amount;
    $.post("../api/api.php",{action:"add_promotion",id:id,val:val},function(res){
        let ps =$.parseJSON(res);
            if(ps.success == true){
                swal("บันทึกสำเร็จ", "", "success");
                setTimeout(function () { 
                    $("#addpromotion").modal("hide");
                    getproduct("all");
                }, 300);
            }
    });
});
$("body").on("click",".remove_product",function(e){
    let id = $(this).attr("id");
    let name = $(this).attr("tname");
    e.preventDefault();
    swal({
        title: "ลบสินค้า",
        text: "ต้องการลบสินค้า"+name+"ใช่หรือไม่?",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true
      }, 
      function () {
        setTimeout(function () {
            $.post("../api/api.php",{action:"del-product",id:id},function(res){
                let ps =$.parseJSON(res);
                if(ps.success == true){
                    swal("ลบสำเร็จ","", "success");
                    getproduct("all");
                }
            });
        }, 700);
      }
    );
});
$("body").on("click",".edit_product",function(e){
    e.preventDefault();
    $(".edit-img").html("");
    let id = $(this).attr("id");
    $("#hidden_id").val(id);
    $.post("../api/api.php",{action:"get_one_product",id:id},function(res){
        let ps =$.parseJSON(res);
        let left = ps.left;
        let right = ps.right;
        let num = Number(right.product_id);
            if(num < 10){
                num = "P000"+num;
            }else if(num < 100){
                num = "P00"+num;
            }else if(num < 1000){
                num = "P0"+num;
            }
            $("#ed_productname").val(right.product_name); 
            $("#ed_price").val(right.price);
            $("#ed_qty").val(right.qty);
            $("#ed_detail").val(right.product_description);
            $("[value='"+right.product_type_id+"']").attr('selected','selected');
            $.each(ps.left,function(k,v){
                $(".edit-img").append(" <div class='h-del-img' attfordel='"+v.img_id+"'> <img src='../uploads/"+v.img_name+"'  class='w-100 product_imd'  alt=''> "+
                "<div class='del-img' gname='"+v.img_name+"' id='"+v.img_id+"'> <i class='fas fa-times'></i> </div> </div> ");
            });
    });
});
$("body").on("click",".del-img",function(e){
    let id = $(this).attr("id");
    let name = $(this).attr("gname");
   
    $.post("../api/api.php",{action:"del-img",id:id,name:name},function(res){
        let ps =$.parseJSON(res);
        if(ps.success == true){
            $("[attfordel='"+id+"']").fadeOut(300, function() { 
                $(this).remove(); 
            });
        }
    });
})

$("body").on("click",".view_product",function(e){
    e.preventDefault();
    $("#product_left").html(" ");
    $(".grid-item-gp").html(" ");
    let id = $(this).attr("id");
    $.post("../api/api.php",{action:"get_one_product",id:id},function(res){
        let ps =$.parseJSON(res);
        console.log(ps);
        let left = ps.left;
        let right = ps.right;
        let img;
        if(isEmpty(left)){
            img = "defalitem.jpg";
        }else{
            img = left[0].img_name;
        }
        let num = Number(right.product_id);
            if(num < 10){
                num = "P000"+num;
            }else if(num < 100){
                num = "P00"+num;
            }else if(num < 1000){
                num = "P0"+num;
            }
        $("#product_left").append("<img src='../uploads/"+img+"'  class='w-100  head_img' alt=''>")
        $("#s_productname").html(right.product_name);
        $("#s_productype").html(right.product_type_name);
        $("#s_productprice").html(right.price+"บาท");
        $("#s_productdetail").html(right.product_description);
        $("#s_productid").html(num);
        $("#s_qty").html(right.qty);
        console.log(left);
        $.each(ps.left,function(k,v){
            $(".grid-item-gp").append("<img src='../uploads/"+v.img_name+"'  class='img-grall product_imd'  alt=''>");
        });
        
    });
    
});

$("body").on("click",".product_imd",function(e){
    console.log("asdf");
    let data = $(this).attr("src");
    $("#product_left").html("");
    $("#product_left").append("<img src='"+data+"'  class='w-100 head_img' alt=''>")
   
});
// newproduct

function searchtb(value,tb){
    $(tb).each(function(){
      var found = 'false';
      $(this).each(function(){
        if($(this).text().toLowerCase().indexOf(value.toLowerCase())>=0){
          found = 'true';
        }
      });
      if(found=='true'){
        $("#first_tr").show();
        $(this).show();
        
      }else{
        $("#first_tr").show();
        $(this).hide();
      }
    });
  }
  $("body").on("click",".nava",function(e){
      e.preventDefault();
        console.log("nava");
  });
  function pagination(tbid,row){
    $("#nav").remove();  
    tbid = "#"+tbid;
    stbid = tbid+" tbody tr";
    // $('#tbl_emp').after('<div id="nav"></div>');
    $(tbid).after('<div id="nav" class="py-2 mt-2 pagibot"></div>');
    var rowsShown = row;
    var rowsTotal = $(stbid).length;
    var numPages = rowsTotal/rowsShown;
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav').append('<a class="nava btn-custom" href="#" rel="'+i+'">'+pageNum+'</a> ');
    }
    $(stbid).hide();
    $(stbid).slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function(){

        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $(stbid).css('opacity','0.0').hide().slice(startItem, endItem).
                css('display','table-row').animate({opacity:1}, 300);
    });
}
  $("body").on("keyup","#search", function(){
    searchtb($(this).val(),"#tbl_emp tr");
    console.log($(this).val());
});
    function isEmpty(obj) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
      }

      
 });