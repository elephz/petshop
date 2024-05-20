
$(document).ready(function(){
    getcart();
    let cc = $("#card_cc").html();

    
function getcart(){
    console.log("reltimg");
   
    $.post("api/api.php",{action:"cart"},function(res){
        let ps =$.parseJSON(res);
        if(ps.success == true){
            let row;
            let total = 0;
            console.log(ps.text);

            const thaiFormat = (num) => {
                return Intl.NumberFormat('th-TH', {
                    style: 'currency',
                    currency: 'THB',
                  }).format(num)
              }

            $.each(ps.text,function(k,v){
                let newval = "";
                let type = "";
                let vv = "-";
                let on = 0;
                let price = v.item_price;
                let rp = 0;
            if(v.promo != "0"){
                newval  = v.promo.substring(1);
                type = v.promo.substring(0,1);
                vv = newval+""+type;
                    if(type == "%"){
                    on = (Number(price) * (Number(newval)/100))  ;
                    on = Number(price)  - on ;
                    on = on *Number(v.item_quantity);
                    }else if(type == "฿"){
                    on = (Number(price) - (Number(newval))) * Number(v.item_quantity);
                    }
                   
            }else{
                on = Number(v.item_quantity) * price;
                on = Number(on);
            }
            price = Number(price);
            rp = Number(on);
                console.log("realprice"+rp);
               
           
        
        row +=
            "<tr>"+
                "<td class='item_id'><span class='remove-item' id='"+v.item_id+"'><i class='fas fa-times'></i></span></td>"+
                "<td style='width:150px;padding:10px'><img src='uploads/"+((v.item_img == '')? "defalitem.jpg" :v.item_img )+"' class='w-100'></td>"+
                "<td style='text-align:left'>"+v.item_name+"</td>"+
                "<td style='text-align:right'>"+thaiFormat(price)+"</td>"+
                "<td style='text-align:right'>"+vv+"</span></td>"+
                "<td style='width:130px;' class='qty'>  "+
                    "<input type='number' id='qty' price='"+rp+"' class='loin-input w-100 mx-auto' style='display:inline-block' value='"+v.item_quantity+"'>"+
                "</td>"+
                "<td style='text-align:right' class='data'> <p id='total_row' final='total' qty_count='1' price='"+on+"' >"+ thaiFormat(on) +"</p></td>"+
           "</tr>";
           total +=  (rp * v.item_quantity);
    
    });
    console.log(total);
    $("table > #tcard").html(row);

    $("#fintal_total").html(thaiFormat(total));
    $("#fintal_total2").html(thaiFormat(total));
    $("#fintal_total3").html(thaiFormat(total));
}else if(ps.success == false){
    $("#fintal_total").html("");
    let no =
    "<tr>"+
        "<td colspan='7'>ยังไม่มีสินค้าในตระก้า</td>"+
    "</tr>";
    $("table > #tcard").html(no);
}
    });

  }
  $("body").on("click",".checkout",function(e){
    let status = $(this).attr("btn-stt");
    if(status == "false"){
        $('#warning').html('กรุณาเข้าสู่ระบบก่อนสั่งซื้อสินค้า');
        swal("กรุณาเข้าสู่ระบบก่อนสั่งซื้อสินค้า", "", "error");
        return
    }
    let ssid = $(this).attr("ssid");
   
    $.post("api/api.php",{action:"cart"},function(res){
        let ps =$.parseJSON(res);
            let totalll = [];
            let item_id =[];
            let qty = [];
            let data = {}
 
        if(ps.success == true){
            
                 $("#attendees td.data").map(function (index, elem) {
                    var d = +($(this).find('#total_row').attr('price'));
                    totalll.push(d);
                    qty.push(+($(this).find('#total_row').attr('qty_count')))
                });
                
                let i = 0;
          
            $.each(ps.text,function(k,v){
                item_id.push(v.item_id);
                i++;
            });
            var years = [];
            for (i= 0;i<=item_id.length-1;i++)
            {
                years.push({id : item_id[i],qty : qty[i],total:totalll[i]})
            }
                 
                   
            let adname = $("#ad_name").val();
            let ad_ad =$("#ad_ad").val();
            let ad_phone =$("#ad_phone").val();
            if(adname == "" || ad_ad == "" || ad_phone == ""){
                swal("ไม่สามารถสั่งซื้อ", "กรุณากรอกที่อยู่ก่อนทำการสั่งซื้อสินค้า", "error");
              return
              } 
            console.log(totalll);
            console.log(qty);
            console.log(item_id);
             data = {
                adname:adname,
                ad_ad,
                ad_phone
            }


            $.post("api/api.php",{action:"order",adname:adname,adress:ad_ad,phone:ad_phone,ssid:ssid,years},function(reso){
                let pso =$.parseJSON(reso);
                if(pso.success == true){
                    swal("บันทึกสำเร็จ", "", "success");
                    setTimeout(function () {
                        window.location.href = "showorder.php"
                      }, 800);
                }else if(pso.success == false && pso.text == "false"){
                    swal("404 error!", "การสั่งซื้อไม่สำเร็จ", "error");
                }else if(pso.success == false && pso.text == "nostock"){
                    swal("ขออภัยค่ะ", pso.product+"มีจำนวนไม่พอ", "error");
                }
            });
            
        }
    })
  

  });
// function caculet(){

// }

  $("body").on("click",".btn-address",function(e){
    let status = $(this).attr("btn-stt");
    e.preventDefault();
    if(status == "false"){
        $('#warning').html('กรุณาเข้าสู่ระบบก่อนสั่งซื้อสินค้า');
        swal("กรุณาเข้าสู่ระบบก่อนสั่งซื้อสินค้า", "", "error");
        return
    }
    $("#address").modal('show');
    let id = $(this).attr("ssid");
    console.log(id);
  
    $.post("api/api.php",{action:"get-one-member",id:id},function(res){
        let ps =$.parseJSON(res);
        $("#ad_name").val(ps.firstname+" "+ps.lastname);
        $("#ad_ad").val(ps.address);
        $("#ad_phone").val(ps.phone);
    });
  });
  $("body").on("click","#ad-save",function(e){
    e.preventDefault();
    let adname = $("#ad_name").val();
    let ad_ad =$("#ad_ad").val();
    let ad_phone =$("#ad_phone").val();
      if(adname == "" || ad_ad == "" || ad_phone == ""){
        swal("กรุณากรอกข้อมูลให้ครบถ้วน", "", "error");
      return
      } 
      $("#address").modal('hide');
  });

  $("body").on("click",".remove-item",function(e){
    let id = $(this).attr("id");
    $.post("api/api.php",{action:"remove-item",id:id},function(res){
        let ps =$.parseJSON(res);
        if(ps.success == true){
            console.log("ok");
            getcart();
            countitem();
        }
    });
  });
  $("body").on("change","#qty",function(e){
       let val = $(this).val();
       let price = $(this).attr("price");
       val = Number(val);
       price = Number(price);

       const thaiFormat = (num) => {
        return Intl.NumberFormat('th-TH', {
            style: 'currency',
            currency: 'THB',
          }).format(num)
      }

       if(val < 1){
        swal("error!", "จำนวนของสินค้าต้องไม่น้อยกว่า 1 ", "error");
        $(this).val("1");
        return
       }
       let tr = $(this).closest("tr");
       let tu = tr.find("#total_row");
       let bf = (val * price);
       $(tu).html(thaiFormat(bf));
       $(tu).attr('qty_count', val)
       $(tu).attr('price', bf)
       
       let s = [];
         $("#attendees td.data").map(function (index, elem) {
            var d = +($(this).find('#total_row').attr('price'));
            s.push(d);
        });
      let z = s.reduce((a, b) => Number(a) + Number(b), 0);


      $("#fintal_total").html(thaiFormat(z));
      $("#fintal_total2").html(thaiFormat(z));
      $("#fintal_total3").html(thaiFormat(z));
  });
  function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
  }
});