$(document).ready(function(){
    $("#product_left").html(" ");
    
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
            $("#product_lefttt").html("<img src='../uploads/"+img+"'  class='w-100  head_img' alt=''>");
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
        let data = $(this).attr("src");
        $("#product_lefttt").html("");
        $("#product_lefttt").append("<img src='"+data+"'  class='w-100 head_img' alt=''>")
       
    });
    $("body").on("click",".btntopdf_bestsale",function(e){
        swal("PDF", "รายงานการขายสินค้า 5 อันดับ", "success");
        setTimeout(function () {
            window.open('pdf/pdf.php?type=bestsale');
            // window.open('report/pdf/pdf.php?type=day&url_date=' + url_date+', _blank');
          }, 1000);
       
    });
    
    function isEmpty(obj) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
      }
});