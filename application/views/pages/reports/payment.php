<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <!--
              <h3 class="box-title">Form</h3>
          -->
            </div>
 
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
            <div class="form-group">
              <?=show_alerts(@$alert)?>
            </div>

            <?= form_open() ?>

            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12"  style="text-align: center;">
                      <div class="box box-secondary">
                        <div style="text-align: center;" class="box-header with-border">
                          <h3 class="box-title" >Total Payment</h3>
                      </div>
                    <h2><strong> Php<?= number_format(round($totalPayment,4),2) ?> </strong></h2>
                 </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12" style="text-align: center;">
                      <div class="box box-secondary">
                        <div style="text-align: center;" class="box-header with-border">
                          <h3 class="box-title" >Total Income</h3>
                      </div>
                      <h2><strong> Php<?= number_format(round($totalIncome,4),2) ?> </strong></h2>
                 </div>
            </div>
            
             <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                      <div class="box box-warning">
                        <div style="text-align: center;" class="box-header with-border">
                          <h3 class="box-title" >Filter</h3>
                      </div>

          <div class="col-md-5 col-lg-5 col-sm-5 col-xs-5">
                <div class="form-group">
                <label>Date Start</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="startdate" value="<?= set_value('startdate') ?>" class="form-control pull-right datepicker">
                </div>
                <!-- /.input group -->
              </div>
              <?=formErrorh('danger',form_error('startdate'))?>
            </div>

             <div class="col-md-5 col-lg-5 col-sm-5 col-xs-5">
                 <div class="form-group">
            <label>Date End</label>

            <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="enddate" value="<?= set_value('enddate') ?>" class="form-control pull-right datepicker">
            </div>
            <!-- /.input group -->
            </div>
            <?=formErrorh('danger',form_error('enddate'))?>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2" style="padding-top: 25px;">
            <button type="submit" class="btn btn-primary">Filter</button>
            </div>


    <table id="listPayments" class="display mydatatable" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Loan ID</th>
                <th>Loan Name</th>
                <th>Payment Amount</th>
                <th>Transaction Date</th>   
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($paymentList)): ?>
                <?php foreach($paymentList as $payment){ ?>
                    <?php if($payment->isRelease == 0 &&  $payment->isPenalty == 0 && $payment->isInterest == 0){  ?>
                    <tr>
                      <td> <?= $payment->LastName.', '.$payment->FirstName ?> </td>
                      <td> <?= $payment->loanAcct_id ?> </td>
                      <td> <?= $payment->loanProduct_name ?> </td>
                      <td> Php<?= round($payment->amount_cr,4)  ?> </td>
                      <td> <?= date_format(date_create($payment->dateTransaction),'d-M-Y') ?> </td>
                    </tr>   
                    <?php  } ?>
                <?php  } ?>
            <?php endif; ?>
        </tbody>
 </table>

                 </div>
            </div>

            </div>
           
            <?= form_close() ?>
         </div>
    </div>