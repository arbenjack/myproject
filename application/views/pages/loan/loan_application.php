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
                  <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                  <table id="listClients" class="display mydatatable" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Loan Name</th>
                <th>interest</th>
                <th>Loan Amount</th>
                <th>Payment Term</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        <?php if(!empty($pendingList)){ 
                foreach($pendingList as $list){
            ?>
        <tr>
        <td> <?= $list->LastName.", ".$list->FirstName." ".$list->MiddleName ?> </td>
        <td> <?= $list->loanProduct_name ?> </td>
        <td> <?= round($list->intRate,6) ?> %</td>
        <td> <?= round($list->loanAmount,6) ?> </td>
        <td> <?= $list->termNumber ?> Months </td>
        <td> <?= strtoupper($list->loanStatus) ?> </td>
        <td> 
    
            <a href="<?= base_url().'Loan/cancelApplicationLoan/'.$list->loan_accountID ?>" class="btn btn-warning">
                Cancel
            </a>
            <a href="<?= base_url().'client/createCheclist/'.$list->ClientID ?>" class="btn btn-default">
                Checklist
            </a>
         </td>
        </tr>
        <?php 
            }
        } ?>
        </tbody>
    </table>
                  </div>
                  <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                                <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Application</h3>
            </div>
          <div class="form-group">
            <?=show_alerts(@$alert)?>
          </div>
            <!-- /.box-header -->
              <!-- form start -->
              <?= form_open() ?>
            <div class="form-group">
                  <label>Select Client</label>
                <?=form_dropdown('client',$listClients,set_value('client') ,['class' => 'form-control select2event' ])?>
    
                <?=formErrorh('danger',form_error('client'))?>
             </div>
             <div class="form-group">
                  <label>Select Loan</label>
                <?=form_dropdown('loanproduct',$listProduct,set_value('loanproduct') ,['class' => 'form-control select2event' ])?>
                
                <?=formErrorh('danger',form_error('loanproduct'))?>
             </div>
             <div class="form-group">
                <label>Select Payment Term</label>
                <?=form_dropdown('paymentTerm',[
                        1 => '3 months',
                        2 => '6 months',
                        3 => '9 months',
                        4 => '12 months'  
                ],'',['class' => 'form-control select2event' ])?>
             </div>
             <div class="form-group">
                  <label for="fn">Input Amount</label>
                  <input type="text" class="form-control" name="amount" value="<?= set_value('amount') ?>" placeholder="Amount">  
                   <?=formErrorh('danger',form_error('amount'))?>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">CREATE</button>
              </div>
              <?= form_close() ?>
              
          </div>
          <!-- /.box -->
                  </div>
              </div>

         </div>
 </div>

