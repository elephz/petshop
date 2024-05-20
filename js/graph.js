$(document).ready(function(){

var monthNamesThai = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม"];
let today = new Date();
var n = today.getFullYear();
console.log(n);
showGraph(n)
$("body").on("change","#yearpick2",function(e){
        let val = $("#yearpick2").val();
        showGraph(val)
});
  function showGraph(val){
    {
        $.post("../api/api.php",{action:"rp_year",val:val},function(res){
            let ps =$.parseJSON(res);
            let name = [];
            let score = [];

            $.each(ps,function(k,v){
                var d = new Date(v.order_date);
                name.push(monthNamesThai[d.getMonth()]);
                score.push(v.total);
            });

            let chartdata = {
                labels: name,
                datasets: [{
                        label: 'ยอดขาย',
                        backgroundColor: '#102526',
                        borderColor: '#666',
                        hoverBackgroundColor: '#0d0d0d',
                        hoverBorderColor: '#666666',
                        data: score
                }]
            };

            let graphTarget = $('#graphCanvas');
            let barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata,
            })
        })
    }
}
});