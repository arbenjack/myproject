$(document).ready(function(){

    $('#listCitezens').DataTable( {
         processing: true,
        serverSide: true,
        responsive : true,

        ajax: {
            'url': App.siteurl + 'citezen/getListCitezens',
            'method': 'POST',
             'dataType': "json",
             "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'address' },
            { data: 'gender' },
             { data: 'button' },
            
        ]
    } );
	  // home address 1
  $("#provinceSelect").change(function(){
        var value = $(this).val();
        $('#province_in1').val($("#provinceSelect option:selected").text());
       //alert($("#provinceSelect option:selected").text());
        $.ajax({
          type: 'GET',
          dataType: 'json',
          url: App.siteurl + 'citezen/getCityMun/'+value,
          success: function(result){
            $('#CityMunSelect').html('');
            $('#barangaySelect').html('');
            $.each(result['cityMun'], function( index, value ) {
              //console.log( index + ": " + value );
              var newOption = new Option(value, index, true, true);
            // Append it to the select
            $('#CityMunSelect').append(newOption).trigger('change');
            });
        }});
    });

    $("#CityMunSelect").change(function(){
      var value = $(this).val();
      $('#cityMun_in1').val($("#CityMunSelect option:selected").text());
      $.ajax({
        type: 'GET',
        dataType: 'json',
        url: App.siteurl + 'citezen/getBarangayAll/'+value,
        success: function(result){
          $('#barangaySelect').html('');
          $.each(result['barangay'], function( index, value ) {
            //console.log( index + ": " + value );
            var newOption = new Option(value, index, true, true);
          // Append it to the select
          $('#barangaySelect').append(newOption).trigger('change');
          });
      }});
  });
    /*
  $("#barangaySelect").change(function(){
    $('#barangay_in1').val($("#barangaySelect option:selected").text());
  });
*/
  $('#provinceSelect').trigger('change');

});