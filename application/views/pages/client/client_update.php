<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update</h3>
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
                  <input type="text" class="form-control" name="fname" value="<?= $infoClient->FirstName ?>" id="fn" placeholder="First Name">  
                   <?=formErrorh('danger',form_error('fname'))?>

                </div>
                 <div class="form-group">
                  <label for="fn">Last Name</label>
                  <input type="text" class="form-control" name="lname" value="<?= $infoClient->LastName ?>" id="ln" placeholder="Last Name">
                   <?=formErrorh('danger',form_error('lname'))?>
                </div>
                 <div class="form-group">
                  <label for="fn">Middle Name</label>
                  <input type="text" class="form-control" name="mname" value="<?= $infoClient->MiddleName ?>" id="mn" placeholder="Middle Name">
                   <?=formErrorh('danger',form_error('mname'))?>
                </div>

     
                <div class="form-group">
                <label>Date of Birth:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="datebirth" value="<?= date_format(date_create($infoClient->BirthDate), 'm-d-Y') ?>" class="form-control pull-right datepicker">
                </div>
                <!-- /.input group -->
              </div>
              <?=formErrorh('danger',form_error('datebirth'))?>

              

                <div class="form-group">
                  <label>Select</label>
                <?=form_dropdown('gender', 
                  ['M' => 'Male',
                   'F' => 'Female',],$infoClient->Gender,['class' => 'form-control select2event' ])?>
                </div>
                <?=formErrorh('danger',form_error('gender'))?>
          

             <div class="form-group">
                  <label>Phone Number</label>
                  <input type="number" class="form-control" name="phonenumber" value="<?= $infoClient->HomeAddressContact ?>" id="pn" placeholder="Phone Number">
                </div>
                <?=formErrorh('danger',form_error('phonenumber'))?>
              

              <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" name="address" value="<?= $infoClient->HomeAddress1 ?>" id="add" placeholder="Address">
                </div>
                <?=formErrorh('danger',form_error('address'))?>
              
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">UPDATE</button>
              </div>
              <?= form_close() ?>
          </div>
          <!-- /.box -->


        </div>