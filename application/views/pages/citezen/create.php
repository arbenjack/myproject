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

       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header"><h4>Home Address</h4></div>
            <div class="body">   

         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="form-group">
                  <label>Select Province</label>
                <?=form_dropdown('province1',$allProvince,'',['class' => 'form-control select2event','id' => 'provinceSelect' ])?>
                </div>
         </div>


         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="form-group">
                  <label>Select City/Municipality</label>
                <?=form_dropdown('cityMun1','','',['class' => 'form-control select2event','id' => 'CityMunSelect'])?>
                </div>
         </div>
    
         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="form-group">
                  <label>Select Barangay</label>
                <?=form_dropdown('barangay1','','',['class' => 'form-control select2event','id' => 'barangaySelect'])?>
                </div>
         </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="sbh1">Street/Building/House no.</label>
                  <input type="text" class="form-control" name="sbh1" value="<?= set_value('sbh1') ?>" id="sbh1" placeholder="Enter Street/Building/House No.">
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
         <!--
         <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        {{ App\Helpers\FormBuilder::generate([ 
                            array(
                                'label' => Form::label('barangay1', 'Select Barangay',['class'=>'required']),
                                'control' =>  Form::select('barangay1', [], '',  ['class' => 'select2','id' => 'barangaySelect']),
                                'line' => false
                            )
                        ]) }}
                <input hidden value="" name="barangay_in1" id="barangay_in1">
         </div>
         <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                {{ App\Helpers\FormBuilder::generate([ 
                         array(
                                    'label' => Form::label('sbh1', 'Stree/Building/House no.',['class'=>'required']),
                                    'control' => Form::text('sbh1', '', ['class' => 'form-control', 'required' => true])
                                )
               ]) }}
          </div>
                  -->

         </div>
    
        </div>
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
                <button type="submit" class="btn btn-primary">CREATE</button>
              </div>
              <?= form_close() ?>
          </div>
          <!-- /.box -->


        </div>