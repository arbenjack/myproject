<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Settings Form</h3>
            </div>
        <div class="form-group">
         <?=show_alerts(@$alert)?>
      </div>

      	 <?= form_open() ?>
          <div class="box-body">
            <div class="form-group">
        <div class="form-group">
                  <label for="fn">Barangay Captain Name</label>
                  <input type="text" class="form-control" name="captain" value="<?=empty($allSettings[1]) == true? '': $allSettings[1]?>" id="fn" placeholder="Barangay Captain Name">  
                   <?=formErrorh('danger',form_error('captain'))?>
                </div>
        

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header"><h4>Barangay Address</h4></div>
            <div class="body">   

         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="form-group">
                  <label>Select Province</label>
                <?=form_dropdown('province1',$allProvince,empty($allSettings[2]) == true? '': $allSettings[2],['class' => 'form-control select2event','id' => 'provinceSelect' ])?>
                </div>
         </div>


         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="form-group">
                  <label>Select City/Municipality</label>
                <?=form_dropdown('cityMun1','',empty($allSettings[3]) == true? '': $allSettings[3],['class' => 'form-control select2event','id' => 'CityMunSelect'])?>
                </div>
         </div>
    
         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="form-group">
                  <label>Select Barangay</label>
                <?=form_dropdown('barangay1','',empty($allSettings[4]) == true? '': $allSettings[4],['class' => 'form-control select2event','id' => 'barangaySelect'])?>
                </div>
         </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="sbh1">District</label>
                  <input type="text" class="form-control" name="sbh1" value="<?=empty($allSettings[5]) == true? '': $allSettings[5]?>" id="sbh1" placeholder="Enter District">
                </div>
             </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <?php 
        if(form_error('province1') != null || form_error('cityMun1') != null || form_error('barangay1') != null || form_error('sbh1') != null){
                echo formErrorh('danger','Address is required!');
               //redirect('citezen/create');
             }  

      ?>
  </div>
         </div>
    
        </div>
    </div>
   </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">SAVE</button>
              </div>
          </div>
      	 <?= form_close() ?>


    	</div>

    </div>
