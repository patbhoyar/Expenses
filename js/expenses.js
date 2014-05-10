$(document).ready(function(){
    
    //{"expenseId":"26","category":"Yuvraj - Payments","categoryId":"4","itemName":"Payment","date":"2014-03-12","paymentMode":"Cash","bankName":null,"amount":"25000","checkNumber":"0"}
    var data = "";
    var categorySort = 1, itemNameSort = 1, dateSort = 1, amountSort = 1, paymentModeSort = 1, bankNameSort = 1, checkSort = 1;
   
    function createTable(){
        $("#expensesTable td").parent().remove();
        
        var totalAmount = 0, totalCheck = 0;
        var tableData = "";
        for(i=0; i<data.length;i++){
            tableData += "<tr><td class='category'><a href='expenses.php?categoryId="+data[i]['categoryId']+"'>"+data[i]['category']+"</a></td>";
            tableData += "<td class='itemName'>"+data[i]['itemName']+"</td>";
            tableData += "<td class='date'>"+data[i]['date']+"</td>";
            tableData += "<td class='amount'>"+data[i]['amount']+"</td>";
            tableData += "<td class='paymentMode'>"+data[i]['paymentMode']+"</td>";
            tableData += (data[i]['bankName'] === null)?"<td class='bankName'> -- </td>":"<td class='bankName'>"+data[i]['bankName']+"</td>";
            tableData += (data[i]['checkNumber'] === 0)?"<td class='checkNumber'> -- </td></tr>":"<td class='checkNumber'>"+data[i]['checkNumber']+"</td></tr>";

            totalAmount += parseInt(data[i]['amount']);
            totalCheck += (data[i]['bankName'] === null)?parseInt(0):parseInt(data[i]['amount']);
        }
        
        tableData += "<tr><td class='category'></td><td class='itemName'></td><td class='date'></td><td class='bold'>"+totalAmount+"</td>";
        tableData += "<td class='paymentMode'></td><td class='bankName'>Check</td><td class='checkNumber'>"+totalCheck+"</td></tr>";
        
        $("#expensesTable").append(tableData);
    }
   
    $.ajax({
        url: 'lib/ajaxServer.php',
        type: 'post',
        data: {'request': 'allExpenses' },
        success: function(msg){
            data = $.parseJSON(msg);
            sortByDate(data, 'desc');
            
            createTable();
        }});
    
   $(document).on("click", "#categoryHeader", function(){
       
       if (categorySort === 0){
            sortByString(data, 'category', 'desc')
            categorySort = 1;
        }else{
            sortByString(data, 'category', 'asc')
            categorySort = 0;
        }
        
       createTable();
   });
    
   $(document).on("click", "#dateHeader", function(){
       
        if (dateSort === 0){
            sortByDate(data, 'desc');
            dateSort = 1;
        }else{
            sortByDate(data, 'asc');
            dateSort = 0;
        }
        
       createTable();
   });
    
   $(document).on("click", "#amountHeader", function(){
       
        if (amountSort === 0){
            sortByNum(data, 'amount', 'desc');
            amountSort = 1;
        }else{
            sortByNum(data, 'amount', 'asc');
            amountSort = 0;
        }
        
       createTable();
   });
    
});