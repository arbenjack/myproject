<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form</h3>
            </div>
        <div class="form-group">
         <?=show_alerts(@$alert)?>
      </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= form_open() ?>


              <div class="box-body">
                <div class="form-group">
                  <label for="fn">First Name</label>
                  <input type="text" class="form-control" name="fname" value="<?= set_value('fname') ?>" id="fn" placeholder="First Name">  
                   <?=formErrorh('danger',form_error('fname'))?>

                </div>
                 <div class="form-group">
                  <label for="fn">Last Name</label>
                  <input type="text" class="form-control" name="lname" value="<?= set_value('lname') ?>" id="ln" placeholder="Last Name">
                   <?=formErrorh('danger',form_error('lname'))?>
                </div>
                 <div class="form-group">
                  <label for="fn">Middle Name</label>
                  <input type="text" class="form-control" name="mname" value="<?= set_value('mname') ?>" id="mn" placeholder="Middle Name">
                   <?=formErrorh('danger',form_error('mname'))?>
                </div>

                <div class="form-group">
                <label>Date of Birth:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="datebirth" value="<?= set_value('datebirth') ?>" class="form-control pull-right datepicker">
                </div>
                <!-- /.input group -->
              </div>
              <?=formErrorh('danger',form_error('datebirth'))?>

                <div class="form-group">
                  <label>Select</label>
                <?=form_dropdown('gender', 
                  ['male' => 'Male',
                   'female' => 'Female',],set_value('gender'),['class' => 'form-control select2event' ])?>
                </div>
                <?=formErrorh('danger',form_error('gender'))?>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <?= form_close() ?>
          </div>
          <!-- /.box -->


        </div>