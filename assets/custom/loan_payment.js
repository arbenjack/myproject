$(document).ready(function(){
    /*
    $(document).on('change','.paymentCollection',function(){
        alert('naglain');
    });
    */
 
   $('.paymentCollection').keyup(function(){
        //alert($(this).val());
        var itemAmount = $(this).closest("tr")   // Finds the closest row <tr> 
        .find(".tdClassPaymtAmmt")     // Gets a descendent with class="nr"
        .children('input').val();
        //.text();
        var colAmount = $(this).val();
        console.log(itemAmount);
        if(Number(colAmount) > Number(itemAmount)){
            $(this).val(itemAmount);
           
        }else{
         
        }
   });
      
});