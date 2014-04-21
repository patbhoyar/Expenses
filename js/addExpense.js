$(document).ready(function(){
    
    $(document).on("click", "#submit", function(e){
        e.preventDefault();
        var category = $("#category").val();
        var itemName = $("#itemName").val();
        var date = $("#datepicker").val();
        var amount = $("#amount").val();
        var modeOfPayment = $("#paymentMode").val();
        var bank = $("#bank").val();
        var checkNumber = $("#checkNumber").val();
        
        $.ajax({
           url: 'lib/ajaxServer.php',
           type: 'POST',
           data: {
               request: "addExpense",
               category: category, 
               itemName: itemName,
               date: date,
               amount: amount,
               modeOfPayment: modeOfPayment,
               bank: bank,
               checkNumber: checkNumber
           }, 
           success: function(data){
               console.log(data);
           }
        });

        //$.ajax({});

    });
    
});