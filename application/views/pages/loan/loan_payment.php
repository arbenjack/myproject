<div class="col-md-12">
          <!-- general form elements -->
        <div class="box box-primary">
          <div class="col-md-6">
            <div class="box-header with-border">
              <h3 class="box-title">Create Loan Payment</h3>
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
                ],set_value('paymentTerm'),['class' => 'form-control select2event' ])?>
             </div>
            
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            <?= form_close() ?>
            </div>

     <?= form_open(base_url().'Loan_payment/submitPayments') ?>
     <table id="listClients" class="display mydatatable" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Loan Name</th>
                <th>Due Amount</th>
                <th>Collection</th>
                <!--
                <th></th>
                -->
            </tr>
        </thead>

        <tbody>
        <?php if(!empty($paymentList)){ 
                foreach($paymentList as $list){
            ?>
                <tr>
                <td> <input type="" hidden name="clientId[<?= $list->loan_accountID ?>]" value="<?= $list->ClientID ?>"><?= $list->LastName.", ".$list->FirstName." ".$list->MiddleName ?> </td>
                <td> <input type="" hidden name="loanAcctType[<?= $list->loan_accountID ?>]" value="<?= $list->loan_productID ?>"> <?= $list->loanProduct_name ?> </td>
                <td class="tdClassPaymtAmmt"> <input type="" class="paymentAmount" hidden name="loanAmount[<?= $list->loan_accountID ?>]" value="<?= round($list->paymentDue,4) ?>"> <?= number_format(round($list->paymentDue,4),2) ?> </td>
                <td> <input type="number" step=".01" class="paymentCollection" name="collection[<?= $list->loan_accountID ?>]"> </td>
                </tr>
                <?php 
            }
        } ?>
        </tbody>
    </table>

     <div class="box-footer">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
    <?= form_close() ?>
            <!-- end of box -->
        </div>
    
</div>