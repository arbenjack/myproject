$(document).ready(function(){

	//Date picker
    $('.datepicker').datepicker({
      autoclose: true
    });
   $('.datetimepicker').datepicker({
      autoclose: true,
    });
      $('.clockpicker').clockpicker({
        autoclose: true,
    });
    $(".select2event").select2({
  		placeholder: 'Select Option',
  		//allowClear: true
	});

    /** datatable */
      $('.mydatatable').DataTable(
        {
          responsive: true
      }
      );
});