$(document).ready(function(){
	 $('#listSummons').DataTable( {
         processing: true,
        serverSide: true,
        responsive : true,

        ajax: {
            'url': App.siteurl + 'summons/getListSummons',
            'method': 'POST',
             'dataType': "json",
             "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        },
        columns: [
            { data: 'id' },
            { data: 'comp_name' },
            { data: 'resp_name' },
            { data: 'brycasenumber' },
             { data: 'details' },
              { data: 'datetime' },            
             { data: 'button' },
            
        ]
    } );

     $(document).on('click','.generateBtn',function(){

            jQuery.ajax({
        url : App.siteurl + 'summons/summontFormat',
        type : "POST",
        data: {
            id: 1
        },
       // dataType : 'json',
        success : function(response) {
           // alert(response);
            //window.open(response);
              var w = window.open('about:blank');
              w.document.open();
             w.document.write(response);
              w.document.close();
        },
        error : function(response) {
          
        }
     });    


     });

/*
  $('.generateBtn').on('click',function(){
    alert("asdsad");
  }); 
*/

});	