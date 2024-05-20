$(document).ready(function(){
    getlike();
    function getlike(){
        $.post("api/api.php",{action:"getlike-person",user_id:h_id},function(res){
            let ps =$.parseJSON(res);
            let row;
            let emprow;
            let id ;
            emprow +=
                "<tr>"+
                    "<td colspan='6'>ไม่มีข้อมูล</td>"+
                "</tr>";
            if(isEmpty(ps)){
                $("table > #tb-like").html(emprow);
            }
            $.each(ps,function(k,v){
        row +=
            "<tr>"+
                "<td><a class='del-whitelise f-28' id='"+v.wl_id+"'><i class='fas fa-times'></i></a></td>"+
                "<td style='width:170px'><img class='w-100' src='uploads/"+((v.img_name == '') ? "defalitem.jpg" : v.img_name )+"'></td>"+
                "<td >"+v.product_name+"</td>"+
                "<td style='text-align:right'>"+v.price+"฿</td>"+
                "<td>"+((v.promotion == "0") ? "-" : "-"+v.promotion )+"</td>"+
                "<td>"+((Number(v.qty) > 0) ? "มีสินค้า" : "สินค้าหมด" )+"</td>"+
                "<td><button class='add-item btn-custom' img='"+v.img_name+"' id='"+v.product_id+"' name='"+v.product_name+"' price='"+v.price+"' ><i class='fas fa-cart-plus'></i> เพิ่มลงตะกร้า</button></td>"+ 
           "</tr>";
       
    
    })
    $("table > #like").html(row);
    });
    }

    $("body").on("click",".del-whitelise",function(e){
        let id = $(this).attr("id");
        $.post("api/api.php",{action:"del-whitelise",id:id},function(res){
            let ps =$.parseJSON(res);
            if(ps.success == true){
                swal("ลบสำเร็จ", "", "success");
                setTimeout(function () { 
                    getlike();
                }, 500);
            }
        });
    });
    function isEmpty(obj) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
      }
});