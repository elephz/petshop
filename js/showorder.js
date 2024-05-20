$(document).ready(function(){ 
    var monthNamesThai = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม"];
    var dayNames = ["อา.","จ.","อ.","พ.","พฤ","ศ.","ส."];
    getorder();
    $("body").on("click",".so_pay_btn_show",function(e){
        console.log("ookk");
        $(".rowpaystt_img").html(" ");
        $(".btm_content").html(" ");
        let id = $(this).attr("id");
        $.post("api/api.php",{action:"get-one-orderdetail",id:id},function(res){
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
                let total = Number(v.qty * v.total);
                totala += Number(total);
        row +=
            "<tr>"+
                "<td>"+idd+"</td>"+
                "<td style='text-align:left'>"+v.product_name+"</td>"+
                "<td style='text-align:right'>"+(Number(v.price)).toFixed(2)+"</td>"+
                "<td>"+v.qty+"</td>"+
                "<td style='text-align:right'>"+(Number(total)).toFixed(2)+"</td>"+
           "</tr>";
    
          
    })
    var d = new Date(rs[0].order_date);


    let pay_stt = '';

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

   
    let btm_content;
   
        btm_content = "<h7><b>ข้อมูลการชำระเงิน</b></h7>"+
                "<div class='grid_product'>"+
                    "<div class='product_item'>"+
                        "<img src='uploads/"+rs[0].pay_slip+"' class='w-100'>"+
                    "</div>"+
                    " <div class='product_item'>"+
                        "<p> <span><b> จำนวนเงิน  </b></span>"+(Number(rs[0].pay_amount)).toFixed(2)+" บาท</p>"+
                        "<p > <span> <b> วันที่ชำระเงิน : </b> </span> "+d.getDate()+" "+monthNamesThai[d.getMonth()]+"  "+(d.getFullYear()+543)+" </p>"+
                    "</div>"
                "</div>";
   
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
    function getorder(){
        console.log(ssid);
        $.post("api/api.php",{action:"get_order",id:ssid},function(res){
            let ps =$.parseJSON(res);
            console.log(ps);
          
            let row ="" ;
            let id;
            let stt;
            $.each(ps,function(k,v){
                console.log(v);
                
            let num = Number(v.order_id);
            if(num < 10){
                id = "OR000"+num;
            }else if(num < 100){
                id = "OR00"+num;
            }else if(num < 1000){
                id = "OR0"+num;
            }

            if(v.order_status == '1'){
                stt = 'รอการชำระเงิน';
            }if(v.order_status == '2'){
                stt = 'ชำระเงินแล้ว';
            }if(v.order_status == '3'){
                stt = 'สำเร็จ';
            }
            if(v.order_status == '4'){
                stt = 'ยกเลิกออเดอร์';
            }
            row +=
            "<div class='row row-list' id='"+v.order_id+"' rowliststt='"+v.order_status+"'>"+
            "<div class='grid-item2'>"+
                "<span>รหัสการสั่งซื้อ : "+id+"</span> <br>"+
                "<span>สถานะ : "+stt+" </span>"+
            "</div>"+
            "<div class='grid-item2 "+((v.order_status != '1')? 'hide':'show')+"' style='text-align:right'>"+
                "<span realid='"+v.order_id+"' id='"+id+"' class='btn-custom cancel_bill'><i class='fas fa-times-circle'></i></span>"+
            "</div>"+
            "</div>";
            })
           
            
            $("#soorder_left").html(row);
        }).then(()=>{
           $(".btn1").click();
        });
    }
    $("body").on("click",".btn1",function(e){
        $("[rowliststt=1]").fadeIn("fast");
        $("[rowliststt=2]").hide();
        $("[rowliststt=3]").hide();
        $("[rowliststt=4]").hide();
    });

    $("body").on("click",".btn2",function(e){
        $("[rowliststt=1]").hide();
        $("[rowliststt=2]").fadeIn("fast");
        $("[rowliststt=3]").hide();
        $("[rowliststt=4]").hide();
    });
    
    $("body").on("click",".btn3",function(e){
        $("[rowliststt=1]").hide();
        $("[rowliststt=2]").hide();
        $("[rowliststt=3]").fadeIn("fast");
        $("[rowliststt=4]").hide();
    });
    
    $("body").on("click",".btn4",function(e){
        $("[rowliststt=1]").hide();
        $("[rowliststt=2]").hide();
        $("[rowliststt=3]").hide();
        $("[rowliststt=4]").fadeIn("fast");
    });
    
    $("body").on("click",".row-list",function(e){
        let id = $(this).attr("id");
        $(".col-md-7").addClass("show");
        $.post("api/api.php",{id:id,action:"get-one-orderdetail"},function(res){
            let rs =$.parseJSON(res);
            console.log(rs);
            let row;
            let totala = 0;
        let idd;
        const thaiFormat = (num) => {
            return Intl.NumberFormat('th-TH', {
                style: 'currency',
                currency: 'THB',
              }).format(num)
          }
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
            "<td>"+idd+"</td>"+
            "<td style='width:150px'><img class='w-100' src='uploads/"+v.img_name+"'></td>"+
            "<td>"+v.product_name+"</td>"+
            "<td>"+thaiFormat(v.price)+"</td>"+
            "<td>"+vv+"</td>"+
            "<td>"+v.qty+"</td>"+
            "<td >"+thaiFormat(total)+"</td>"+
       "</tr>";
})
var d = new Date(rs[0].order_date);
console.log("show order");
let pay_stt;

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

if(rs[0].order_status == "1"){
    $(".so_pay_btn").removeClass("hide");
    $(".so_pay_btn").addClass("show");
    $(".so_pay_btn_show").removeClass("show");
    $(".so_pay_btn_show").addClass("hide");
} else {
    $(".so_pay_btn").removeClass("show");
    $(".so_pay_btn").addClass("hide");
    $(".so_pay_btn_show").removeClass("hide");
    $(".so_pay_btn_show").addClass("show");
}

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
// $(".so_pay_btn").removeClass("hide");


if(rs[0].tracking_code) {
    $("p#shipment").removeClass('hide').addClass('show')
    $("p#shipment").find("span.text").html(rs[0].logis_method)

    $("p#tracking_code").removeClass('hide').addClass('show')
    $("p#tracking_code").find("span.text").html(rs[0].tracking_code)
} else {
    $("p#shipment").removeClass('show').addClass('hide')
    $("p#tracking_code").removeClass('show').addClass('hide')
}
$(".so_pay_btn").attr("bid",rs[0].order_ref);
$("table > #torder").html(row);
$("#so_total").html(thaiFormat(totala));
$("#so_total").attr('price', totala);
$("#rihgt_orid").html(ic);
$("#rihgt_stt").html(pay_stt);
$("#rihgt_date").html(d.getHours()+":"+d.getMinutes()+" "+dayNames[d.getDay()]+"  "+d.getDate()+" "+monthNamesThai[d.getMonth()]+"  "+(d.getFullYear()+543));
$("#rihgt_id").html(mc);
$("#rihgt_phone").html(rs[0].person_phone);
$("#rihgt_address").html(rs[0].person_detail);
$(".so_pay_btn_show").attr("id",rs[0].order_id);
        });
    });
    $("body").on("click",".so_pay_btn",function(e){ 
        let id = $(this).attr("bid");
        $("#nf_ref_id").val(id);
        $("#pay_amount_modal").html(Number($("#so_total").attr('price')).toFixed(2)+" บาท");
        console.log(id);
     });
     $("body").on("change","#tb_bank",function(e){  
            let val = $(this).val();
            $.post("api/api.php",{val:val,action:"get-one-bank"},function(res){
                let rs =$.parseJSON(res);
                $("#pay_id_modal").html(rs.b_number);
                $("#pay_name_modal").html(rs.b_owner);
            });
     });
     $("body").on("click",".cancel_bill",function(e){ 
        let id = $(this).attr("id");
        let realid = $(this).attr("realid");
        swal({
            title: "ยกเลิกออร์เดอร์",
            text: "ต้องการยกเลิกออร์เดอร์" +id+" ใช่หรือไม่?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
          }, 
          function () {
            setTimeout(function () {
                $.post("api/api.php",{action:"del-order",id:realid},function(res){
                    let ps =$.parseJSON(res);
                    if(ps.success == true){
                        swal("ยกเลิกสำเร็จ","", "success");
                        getorder();
                    }
                });
            }, 700);
          }
        );


     });


     $("body").on("click",".fa-copy",async function(e){ 
       const tracking_code = $("p#tracking_code").find('.text').html()

       await navigator.clipboard.writeText(tracking_code)
     });
    
      
})