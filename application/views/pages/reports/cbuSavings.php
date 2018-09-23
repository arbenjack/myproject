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
                          <h3 class="box-title" >Total Savings</h3>
                      </div>
                    <h2><strong> Php<?= number_format(round($totalSavings,4),2) ?></strong></h2>
                 </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12" style="text-align: center;">
                      <div class="box box-secondary">
                        <div style="text-align: center;" class="box-header with-border">
                          <h3 class="box-title" >Total Withdraw</h3>
                      </div>
                      <h2><strong> Php<?= number_format(round($totalWithdraw,4),2) ?> </strong></h2>
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
                <th>Amount</th>
                <th>Savings Type</th>  
                <th>Date Transaction</th> 
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($listCbu)): ?>
                <?php foreach($listCbu as $list){ ?>
                    <tr>
                      <td> <?= $list->LastName.', '.$list->FirstName ?> </td>
                      <td> <?= $list->loan_accountID ?> </td>
                      <td> <?= $list->loanProduct_name ?> </td>
                      <td> Php
                      <?php if($list->amount_cr > 0 && $list->amount_dr == 0){
                            echo $list->amount_cr;
                          }else if($list->amount_dr > 0 && $list->amount_cr == 0){
                            echo $list->amount_dr;
                            } ?>
                      <td>
                        <?php if($list->amount_cr > 0 && $list->amount_dr == 0){ ?>
                            <label style="color: green;"> DEPOSIT </label>     
                         <?php }else if($list->amount_dr > 0 && $list->amount_cr == 0){ ?>
                            <label style="color: red;"> WIHTDRAW </label>     
                         <?php } ?>
                      </td>
                      <td> <?= date_format(date_create($list->dateCreated),'d-M-Y') ?> </td>
                    </tr>   
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