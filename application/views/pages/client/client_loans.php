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
              <?php /*
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
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
             </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Get Loans</button>
              </div>
            <?= form_close() ?>
            </div>
            */?>

                  <table id="listClients" class="display mydatatable" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Loan ID</th>
                <th>Loan Name</th>
                <th>interest</th>
                <th>Loan Amount</th>
                <th>Payment Term</th>
                <th>Status</th>
                <th>Date Created</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        <?php if(!empty($LaonList)){ 
                foreach($LaonList as $list){
            ?>
        <tr>
        <td> <?= $list->LastName.", ".$list->FirstName." ".$list->MiddleName ?> </td>
        <td> <?= $list->loan_accountID ?> </td>   
        <td> <?= $list->loanProduct_name ?> </td>
        <td> <?= round($list->intRate,6) ?> %</td>
        <td> <?= round($list->loanAmount,6) ?> </td>
        <td> <?= $list->termNumber ?> Months </td>
        <td>         
                <?php if($list->loanStatus == 'applied'){
                        echo '<label STYLE="font-size: 18;color: orange;"> APPLIED </label>';
                    }else if($list->loanStatus == 'release'){
                        echo '<label STYLE="font-size: 18;color: blue;"> RELEASE </label>';
                    }else if($list->loanStatus == 'fully_paid'){
                        echo '<label STYLE="font-size: 18;color: green;"> FULLY PAID </label>';
                    }else if($list->loanStatus == 'canceled'){
                        echo '<label STYLE="font-size: 18;color: red;"> CANCELED </label>';
                    }
                    ?>
              </td>
        <td> <?= date_format(date_create($list->dateCreated),'m/d/Y') ?> </td>
        <td> 

            <a href="<?= base_url().'client/clientLoanTransaction/'.$list->loan_accountID ?>" class="btn btn-default">
            TRANSACTIONS
            </a>
         </td>
        </tr>
        <?php 
            }
        } ?>
        </tbody>
    </table>
                  </div>
            </div>
        </div>
</div>