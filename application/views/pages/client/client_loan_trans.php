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
                <th>Amount Debit</th>
                <th>Amount Credit</th>
                <th>Date Transaction</th>
                <!--
                <th>Is Release?</th>
                -->
                <th>Is Penalty?</th>
            </tr>
        </thead>

        <tbody>
        <?php if(!empty($transList)){ 
                foreach($transList as $list){
            ?>
        <tr>
        <td> <?= round($list->amount_dr,6) ?><?php 
            if($list->isRelease == 1){
                echo '<label style="color:green;float:right;">Release Amount</label>';
            }else if($list->isInterest == 1){
                echo '<label style="color:red;float:right;">Interest Amount</label>';
            }else if($list->isPenalty == 1){
                echo '<label style="color:red;float:right;">Additional Interest Amount</label>';
            }
        ?></td>
        <td> <?= round($list->amount_cr,6) ?> </td>
        <td> <?= date_format(date_create($list->dateTransaction),'m/d/Y') ?> </td>
        <?php /*
        <td> <?= $list->isRelease == 1? '<label style="color:green;">YES</label>':'' ?> </td>
        */?>
        <td> <?= $list->isPenalty == 1? '<label style="color:red;">YES</label>':'' ?> </td>
      
        </tr>
        <?php 
            }
        } ?>
        </tbody>
    </table>
                  </div>

             <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                 <div class="box-header with-border">
                      <h3 class="box-title"> <?= $loanAccountInfo->LastName.', '.$loanAccountInfo->FirstName.' '.$loanAccountInfo->MiddleName ?></h3>
                      <h3 class="box-title">Loan Information</h3>
                </div>

                <div class="form-group">
                <label style="font-size: 18;">
                Loan Name: 
                </label>
                <label style="font-size: 18;float:right;width: 58%;">
                <?= $loanAccountInfo->loanProduct_name ?>
                </label>
              </div>
              <div class="form-group">
                <label style="font-size: 18;">
                Loan Term Type: 
                </label>
                <label style="font-size: 18;float:right;width: 58%;">
                <?= $loanAccountInfo->termNumber.' ' ?> Months
                </label>
              </div> 
              <div class="form-group">
                <label style="font-size: 18;">
                Loan Interest: 
                </label>
                <label style="font-size: 18;float:right;width: 58%;">
                <?= round($loanAccountInfo->intRate,4) ?>%
                </label>
              </div> 
              <?php if($loanAccountInfo->isRelease == 1): ?>
              <div class="form-group">
                <label style="font-size: 18;">
                Total Due Amount : 
                </label>
                <label style="font-size: 18;float:right;width: 58%;">
                <?= number_format(round((($loanAccountInfo->loanAmount * $loanAccountInfo->intRate) /100) + $loanAccountInfo->loanAmount,6),2) ?>
                </label>
              </div>
              <?php endif; ?>
        
           <div class="form-group">
                <label style="font-size: 18;">
                Loan Status : 
                </label>
                <div style="float:right;width: 58%;">
                <?php if($loanAccountInfo->loanStatus == 'applied'){
                        echo '<label STYLE="font-size: 18;color: orange;"> APPLIED </label>';
                    }else if($loanAccountInfo->loanStatus == 'release'){
                        echo '<label STYLE="font-size: 18;color: blue;"> RELEASE </label>';
                    }else if($loanAccountInfo->loanStatus == 'fully_paid'){
                        echo '<label STYLE="font-size: 18;color: green;"> FULLY PAID </label>';
                    }
                    ?>
                </div>
              </div>

              <div class="form-group">
                <label style="font-size: 18;">
                Loan Date Created : 
                </label>
                <label style="font-size: 18;float:right;width: 58%;">
                <?= date_format(date_create($loanAccountInfo->dateCreated),'m/d/Y') ?>
                </label>
              </div>
        
            <?php if($loanAccountInfo->isRelease == 1): ?>
            <div class="form-group">
                <label style="font-size: 18;">
                Loan Date Release : 
                </label>
                <label style="font-size: 18;float:right;width: 58%;">
                <?= date_format(date_create($loanAccountInfo->dateRelease),'m/d/Y') ?>
                </label>
              </div>

               <div class="form-group">
                <label style="font-size: 18;">
                Loan Date Cutoff : 
                </label>
                <label style="font-size: 18;float:right;width: 58%;">
                <?= date_format(date_create($loanAccountInfo->date_cutoff),'m/d/Y') ?>
                </label>
              </div>
            <?php endif; ?>



             </div>

          <!-- /.box -->
                  </div>
              </div>

         </div>
 </div>

