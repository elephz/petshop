$(document).ready(function(){
    $("table > #rp_day").html("<tr> <td colspan='4'><center>เลือก"+show+"ที่ต้องการ ! </center></td></tr>");
    var monthNamesThai = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม"];

  

    $("body").on("change","#datepick",function(e){
            let val = $(this).val();
            let type = "day";
            getreport(val,type,"11","19","day");
        });
    $("body").on("change","#monthpick",function(e){
            let val = $(this).val();
            console.log(val);
            let type = "month";
            getreport(val,type,"0","11","month");
    });
    $("body").on("change","#yearpick",function(e){
        let val = $(this).val();
        console.log(val);
        let type = "year";
        getreport(val,type,"0","11","year");
    });

    initial()

    function initial() {
        let searchParams = new URLSearchParams(window.location.search)

       

        switch (searchParams.get('P')) {

            case "report_day":
                const start = $("input#datepick-start").val()
                const end = $("input#datepick-end").val()
                
                getreport({start ,end},"day","0","11","day")
                break;
        
            case "report_month":
                const month = $("input#monthpick").val()
              
                getreport(month,"month","0","11","month");
                break;

            case "report_year":
                const year = +($("select#yearpick").val())
                getreport(year,"year","0","11","year");
                break;
        
            default:
                break;
        }
        console.log("inital")
    }
  
    $("body").on("click","#search",function(e){
        console.log("search got click")
        const start = $("input#datepick-start").val()
        const end = $("input#datepick-end").val()

        if(Date.parse(start) > Date.parse(end)) {
            swal("", "วันที่เริ่มต้นต้องน้อยกว่าวันที่สิ้นสุด !", "warning");
            return
        }

        if(!start && !end) {
            swal("", "กรุณาเลือกวันที่ !", "warning");
            return
        }

        getreport({start ,end},"day","0","11","day");
    });

    function getreport(val,type,s1,s2,year){

        
        $.post("../api/api.php",{action:"rp_day",val, type},function(res){
            let ps = $.parseJSON(res);
            
            let row ="";
            
            let totaltal = 0;
            totaltal = Number(totaltal);
            let a = 1 ;
            // console.log(ps[0].order_id);
            // return
            if(isEmpty(ps)){
            row = "<tr><td colspan='4'>ไม่มีข้อมูล !!!</td></tr>";
                console.log("empty");
            }else{
                
            const orderNumber = (num) => {
                let id = ""
                num = +(num)
                if(num < 10){
                    id = "OR000" + num;
                }

                if(num < 100){
                    id = "OR00" + num;

                }

                if(num < 1000){
                    id = "OR0" + num;
                }
                
                return id
            }

            const yearMonth = (dateString) => {
                var parts = dateString.split(' ');
            
                var datePart = parts[0];
            
                var dateParts = datePart.split('-');
            
                var year = dateParts[0];
                var month = dateParts[1];
              
                return year + '-' + month;
            }

            const getDate = (dateString) => {
                var parts = dateString.split(' ');
                return  parts[0]
            }

            $.each(ps,function(k,v){
                let total = v.total;
                total = (Number(total)).toFixed(2);
                const date = new Date(v.order_date)
                console.log({orderDate : v.order_date, date})


                if(year == "year"){
                    var d = new Date(v.order_date);
                }

            const ref = function(type){
                switch (type) {
                    case 'year':
                        return 'index.php?P=report_month&val=' + yearMonth(v.order_date)
                       
                
                    case 'month':
                        return 'index.php?P=report_day&val=' + getDate(v.order_date)
                  
                    default :
                        return '';
                }
            }(type)

            row +=
                "<tr>"+
                    "<td>"+a+ (ref != '' ? "<a class='ml-2' href='"+ref+"'><i class='fas fa-external-link-alt'></i></a>" : '')+"</td>"+
                    "<td>"+(type == 'day' ? orderNumber(v.order_id) : v.cnt)+"</td>"+
                    "<td>"+((year == "year")? monthNamesThai[d.getMonth()] : v.order_date.substring(s1,s2))+"</td>"+
                    "<td style='text-align:right'>"+total+" บาท</p></td>"+
                "</tr>";
                a++;
                total = Number(total);
                totaltal += total;
        });
    }
        $("table > #rp_day").html(row);
        $("#total_byse").html((Number(totaltal)).toFixed(2)+" บาท");
        });
    }
    

    function isEmpty(obj) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
      }
});