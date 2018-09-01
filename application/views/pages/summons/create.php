<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create Summon</h3>
            </div>
        <div class="form-group">
         <?=show_alerts(@$alert)?>
      </div>

      	 <?= form_open() ?>
          <div class="box-body">
               <div class="form-group">
                  <label for="fn">Complainant</label>
                   <?=form_dropdown('complainant',$allCitezens,set_value('complainant'),['class' => 'form-control select2event'])?>
                   </div>
                   <?=formErrorh('danger',form_error('complainant'))?>

                   <div class="form-group">
                   <label for="fn">Respondent</label>
                   <?=form_dropdown('repondent',$allCitezens,set_value('repondent'),['class' => 'form-control select2event'])?>
                   </div>
                   <?=formErrorh('danger',form_error('repondent'))?>

                <div class="form-group">
                  <label for="fn">Barangay Case Number #</label>
                  <input type="text" class="form-control" name="caseNumber" value="<?= set_value('caseNumber') ?>" id="fn" placeholder="Barangay Case Number">  
                   <?=formErrorh('danger',form_error('caseNumber'))?>
                </div>
               
               <div class="form-group">
                  <label for="fn">Details</label>
                  <input type="text" class="form-control" name="details" value="<?= set_value('details') ?>" id="fn" placeholder="Details">  
                   <?=formErrorh('danger',form_error('details'))?>
                </div>


              <div class="form-group">
                <label>Date of Summon:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="summonday" value="<?= set_value('summonday') ?>" class="form-control pull-right datetimepicker">
                </div>
                <!-- /.input group -->
              </div>
              <?=formErrorh('danger',form_error('summonday'))?>
          

             <div class="form-group">
                <label>Time of Summon:</label>
            <div class="input-group clockpicker">
               <input type="text" name="summontime" class="form-control" value="<?=set_value('summontime')?>">
                 <span class="input-group-addon">
               <span class="glyphicon glyphicon-time"></span>
             </span>
            </div>
             </div>
             <?=formErrorh('danger',form_error('summontime'))?>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">CREATE</button>
              </div>
          </div>
      	 <?= form_close() ?>


    	</div>

    </div>
