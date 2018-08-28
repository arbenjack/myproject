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
                <th>Loan Type</th>
                <th>CBU only?</th>
            </tr>
        </thead>

        <tbody>
        <?php if(!empty($savingsList)){ 
                foreach($savingsList as $list){
            ?>
        <tr>
        <td> <?= round($list->amount_dr,6) ?> </td>
        <td> <?= round($list->amount_cr,6) ?> </td>
        <td> <?= date_format(date_create($list->dateCreated),'m/d/Y') ?> </td>
        <td> <?= $list->loanProduct_name ?> </td>
        <td> <?= $list->cbuOnly == 1? '<label style="color:green;">YES</label>' : '' ?> </td>           
        </tr>
        <?php 
            }
        } ?>
        </tbody>
    </table>
                  </div>

             <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                 <div class="box-header with-border">
                      <h3 class="box-title"> </h3>
                      <h3 class="box-title">Savings Information</h3>
                </div>

                



             </div>

          <!-- /.box -->
                  </div>
              </div>

         </div>
 </div>

