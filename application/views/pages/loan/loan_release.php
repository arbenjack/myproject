<div class="col-md-12">
          <!-- general form elements -->
        <div class="box box-primary">
          <div class="col-md-6">
            <div class="box-header with-border">
              <h3 class="box-title">Create Loan Release</h3>
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

     <?= form_open(base_url().'loan/createLoanRelease') ?>
     <table id="listClients" class="display mydatatable" style="width:100%">
        <thead>
            <tr>
                <th>CBU Paid</th>
                <th>Name</th>
                <th>Loan Name</th>
                <th>interest</th>
                <th>Loan Amount</th>
                <th>Payment Term</th>
                <th>Status</th>
                <!--
                <th></th>
                -->
            </tr>
        </thead>

        <tbody>
        <?php if(!empty($releaseList)){ 
                foreach($releaseList as $list){
            ?>
        <tr>
        <td>
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" id="releases" name="releases[]" value="<?=$list->loan_accountID?>">
        </label>
        </th>
        <td> <?= $list->LastName.", ".$list->FirstName." ".$list->MiddleName ?> </td>
        <td> <?= $list->loanProduct_name ?> </td>
        <td> <?= round($list->intRate,6) ?> %</td>
        <td> <?= round($list->loanAmount,6) ?> </td>
        <td> <?= $list->termNumber ?> Months </td>
        <td> <?= $list->isRelease == 0? "<label style='color:#dd4b39;'>NOT RELEASE</label>":"<label style='color: #00a65a;'>RELEASE</label>"  ?> </td>
        <!--
        <td> <?php //echo strtoupper($list->loanStatus); ?> </td>
        -->
        <!--
        <td> 
    
            <a class="btn btn-warning">
                Cancel
            </a>
            <a href="<?php //echo base_url().'client/createCheclist/'.$list->ClientID; ?>" class="btn btn-default">
                Checklist
            </a>
         </td>
          -->
        </tr>
        <?php 
            }
        } ?>
        </tbody>
    </table>

     <div class="box-footer">
                <button type="submit" class="btn btn-success">Create</button>
              </div>
    <?= form_close() ?>
            <!-- end of box -->
        </div>
    
</div>