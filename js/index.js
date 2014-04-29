$(document).ready(function(){
    
    $.ajax({
        type  :   'post',
        url   :   'lib/ajaxServer.php',
        data  :   {
            'request'   :   'chartBreakUp'
        },
        success: function(pieData){
            //var test = pieData;
            //var pieData = [{value : 77070, color : '#B0BF1A'}, {value : 6000, color : '#7CB9E8'}, {value : 54950, color : '#B284BE'}, {value : 175000, color : '#AF002A'}, {value : 50000, color : '#F0F8FF'}, {value : 50000, color : '#E52B50'}, {value : 55000, color : '#EFDECD'}, {value : 20000, color : '#CD9575'}, {value : 78568, color : '#8F9779'}, {value : 158897, color : '#FDEE00'}, {value : 325000, color : '#FF91AF'}, {value : 124426, color : '#A1CAF1'}, {value : 16095, color : '#3D0C02'}, ];
            pieData = eval(pieData);
            console.log(pieData);
            var myPie = new Chart(document.getElementById("expenseChart").getContext("2d")).Pie(pieData);

        }
    });
    
});