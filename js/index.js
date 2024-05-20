
    $(document).ready(function(){ 
        hoverproduct();
        nav();
        gotop();
        logout();
        getcart();
        countitem();
        getheart();
        $(".sale").addClass("newhide");
       $(".view-item").addClass("f-28");
       $(".like-item").addClass("f-28");
        $(window).scroll(function(){
            if($(window).scrollTop() > 200 ){
                $(".first_row_header").css("background","#102526");
                $(".first_row_header").css("color","white");
                $('.list-inline-item').addClass('list-inline-item2').fadeIn();
                $('.card_c').addClass('card_c2').fadeIn();
                $('.top-logo').addClass('hidelogo').fadeOut();
                $('.top-logo2').addClass('showlogl').fadeIn();
                $('.top-logo2').removeClass('hidelogo');
                $(".inlogo").css("padding","0px");
                $(".inlogo").css("border","none");
                $(".os").removeClass("mt-3");
            }else{
              $(".first_row_header").css("background","#f2e1d9");
              $('.list-inline-item').removeClass('list-inline-item2').fadeIn();
              $('.top-logo').removeClass('hidelogo');
              $('.top-logo2').addClass('hidelogo').fadeOut();
              $('.card_c').removeClass('card_c2').fadeIn();
              $('.top-logo').addClass('showlogl').fadeIn();
              $(".inlogo").css("padding","15px");
              $(".inlogo").css("border","1px solid white");
              $(".os").addClass("mt-3");
            }
        })
      
         function countitem(){
          $.post("api/api.php",{action:"cart"},function(res){
            let ps =$.parseJSON(res);
            let i = 0;
            if(ps.success == true){
              $.each(ps.text,function(k,v){
                i++; 
              })
            }
            if(i > 9){
              i = "9+";
            }
            $("#card_cc").html(i);
            });
      
         } 	
    
        
        $("body").on("click",".nav-link",function(e){
          let id = $(this).attr("href");
          id = id.substring(2,3);
          $(".btn-viewall").attr("id",id);
        });
        $("body").on("click",".btn-viewall",function(e){
          let id = $(this).attr("id");
          window.location.href = 'product_type.php?T='+id;
        });

        // $("body").on("click","#bestsale",function(e){
        //   $(".bestsale").removeClass("newhide");
        //   $(".bestsale").addClass("newshow").fadeIn('300');
        //   $(".sale").addClass("newhide").fadeOut('300');
        // });

        // $("body").on("click","#sale",function(e){
        //   $(".sale").removeClass("newhide");
        //   $(".bestsale").addClass("newshow").fadeOut('300');
        //   $(".sale").addClass("newshow").fadeIn('300');
        //   $(".bestsale").addClass("newhide").fadeOut('300');
        // });

        function getcart(){
          let row ="";
            console.log("reltimg");
            $.post("api/api.php",{action:"cart"},function(res){
                let ps =$.parseJSON(res);
                if(ps.success == true){
                    
                    
                    let total = 0;
                    console.log(ps.text);
                    $.each(ps.text,function(k,v){
                    let price = v.item_price;
                    price = Number(price);
                    let on = Number(v.item_quantity) * price;
                    on = Number(on);
                row +=
                        "<a href='#' id='contentz'><img src='uploads/"+v.item_img+"' class='w-100'></a>"+
                        
                        "<a href='#' id='contentz'>"+
                        "<p>"+v.item_name+"</p>"+
                        "<p>"+v.item_quantity+" x "+price+" </p>"+
                        "</a>"+

                        "<a href='#' id='contentz'>"+
                          "<span class='remove-item' id='"+v.item_id+"'><i class='fas fa-times'></i></span>"+
                        "</a>";
                      
                   total +=  (v.item_price * v.item_quantity);
            });
            console.log(total);
            let no =
            "<a href='#'id='contentz' ></a>"+
            "<a href='#'id='contentz ' class='t-total' ></a>"+
            "<a href='#'id='contentz' ></a>";
            let go = row+""+no;
            $(".overlay-content").html("");
            $(".overlay-content").append(go);
            
            $(".t-total").html("ทั้งหมด "+total.toFixed(2)+" บาท");
        }else if(ps.success == false){
            $("#fintal_total").html("");
            let no =
            "<a href='#'id='contentz' ></a>"+
            "<a href='#'id='contentz' >null</a>"+
            "<a href='#'id='contentz' ></a>";
            $(".overlay-content").html(no);
        }
            });
        
          }
          $("body").on("click",".remove-item",function(e){
            let id = $(this).attr("id");
            $.post("api/api.php",{action:"remove-item",id:id},function(res){
                let ps =$.parseJSON(res);
                if(ps.success == true){
                    console.log("ok");
                    getcart();
                }
            });
          });
       function hoverproduct(){
        $( ".grid-item" )
          .hover(function() {
              let a = $( this ).find(".btm-producttab");
              let b = $( this ).find(".btm-product-top");
              
            a.slideToggle("fast");
            b.slideToggle("fast");
         
          });
       }
       $("body").on("click",".view-item",function(e){
        let id = $(this).attr("id");
        window.location.href = 'product.php?P='+id;
      });

       function nav(){
        $("body").on("click","#btn_shipping",function(e){
          document.getElementById("myNav").style.height = "50%";
        });
        $("body").on("click",".closeNav",function(e){
          document.getElementById("myNav").style.height = "0%";
          alertt();
      });
       }
function gotop(){
       var btn = $('#button');
$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});
}
function logout(){
  $("#log-out").click(function(e){
    let type = $(this).attr("type");
    console.log(type);
    e.preventDefault();
    swal({
      title: "ต้องการออกจากระบบ?",
      text: "",
      type: "info",
      showCancelButton: true,
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    }, 
    function () {
      setTimeout(function () {
        if(type == '1'){
        window.location.href = 'logout.php';
      }else if (type == '2'){
        window.location.href = '../logout.php';
      }
      }, 500);
    }
    );
  });
}

// cart

$("body").on("click",".add-item",function(e){
  let id = $(this).attr("id");
  let name = $(this).attr("name");
  let price = $(this).attr("price");
  let img = $(this).attr("img");
  console.log("ddd");
  $.post("api/api.php",{id:id,name:name,price:price,img:img,action:"add-tem"},function(res){
    let rs =$.parseJSON(res);
    if(rs.success == false){
        swal("สินค้าซ้ำ", "มีสินค้าชิ้นนี้อยู่ในตะกร้าแล้ว", "error");
      
    }else{
      getcart();
      console.log("ok");
      countitem();
    }
});
  
});
$("body").on("click",".like-item",function(e){
  let id = $(this).attr("lid");
  let th = $(this);
  $.post("api/api.php",{id:id,user_id:h_id,action:"like-tem"},function(res){
    let rs =$.parseJSON(res);
    if(rs.success == true && rs.text == "like"){
      console.log(th);
      th.addClass("red");
      $("[lid='"+id+"']").addClass("red");
    }if(rs.success == false && rs.text == "unlike"){
      th.removeClass("red");
      $("[lid='"+id+"']").removeClass("red");
    }
  });
});
function getheart(){
  $.post("api/api.php",{user_id:h_id,action:"getheart"},function(res){
    let rs =$.parseJSON(res);
    $.each(rs,function(k,v){
      let pid = v.wl_product_id;
      $("[lid='"+pid+"']").addClass("red");
    });
  });
}

// cart
// swal({
//   title: "Ajax request example",
//   text: "Submit to run ajax request",
//   type: "info",
//   showCancelButton: true,
//   closeOnConfirm: false,
//   showLoaderOnConfirm: true
// }, function () {
//   setTimeout(function () {
//     swal("Ajax request finished!");
//   }, 2000);
// });
    });
