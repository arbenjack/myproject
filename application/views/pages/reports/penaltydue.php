<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(odd) {background-color: #f2f2f2;}
tr:nth-child(even) {background-color: #d3d3d3;}
</style>

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
                  <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                      <div class="box box-secondary">
                        <div style="text-align: center;" class="box-header with-border">
                          <h3 class="box-title" >Account Details</h3>
                      </div>
                        <table>
                            <thead><th> </th><th> </th></thead>
                            <tbody>
                                <tr>
                                <td> Loan ID </td>
                                <td> <?= $loanInfo->loan_accountID ?> </td>
                                </tr>
                                <tr>
                                <td> Client Name </td>
                                <td> <?= $loanInfo->LastName.', '.$loanInfo->FirstName.' '.$loanInfo->MaidenName ?> </td>
                                </tr>
                                <tr>
                                <td> Loan Name </td>
                                <td>  <?= $loanInfo->loanProduct_name ?> </td>
                                </tr>
                                <?php /*
                                <tr>
                                <td> Payment Term </td>
                                <td> <?= $loanInfo->termNumber ?> Months </td>
                                </tr>
                                */?>
                                <tr>
                                <td> Release Date </td>
                                <td> <?= date_format(date_create($loanInfo->dateRelease),'m/d/Y') ?> </td>
                                </tr>
                                <tr>
                                <td>  Cutoff Date </td>
                                <td> <?= date_format(date_create($loanInfo->date_cutoff),'m/d/Y') ?> </td>
                                </tr>
                            </tbody>
                        </table>
                     </div>
                </div>  
                
                 <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                      <div class="box box-secondary">
                        <div style="text-align: center;" class="box-header with-border">
                          <h3 class="box-title" >Payment Details</h3>
                        </div>
                        <table>
                            <thead><th> </th><th> </th></thead>
                            <tbody>
                                <tr>
                                <td> Total Balance </td>
                                <td> Php<?= round($totalPayment ,2) ?> </td>
                                </tr>
                                <tr>
                                <td> Total Paid </td>
                                <td> Php<?= round($totalPaid ,2) ?> </td>
                                </tr>
                                <tr>
                                <td> Loan Amount </td>
                                <td> Php<?= round($loanInfo->loanAmount ,2) ?> </td>
                                </tr>
                                <tr>
                                <td> Interest Amount </td>
                                <td> Php<?= round(($loanInfo->intRate * $loanInfo->loanAmount) / 100,2) ?> </td>
                                </tr>
                                <td> Interest Rate/Payment Term </td>
                                <td> <?= round($loanInfo->intRate ,4)?>% / <?=$loanInfo->termNumber?>Months </td>
                                </tr>
                            </tbody>
                        </table>
                     </div>
                 </div>
                 <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                      <div style="text-align: center;" class="box box-secondary">
                        <div class="box-header with-border">
                          <h3 class="box-title" >Penalty Details</h3>
                        </div>
                        <table  style="width: 30%;margin-left: 35%;">
                            <thead><th> </th><th> </th></thead>
                            <tbody>
                                <tr>
                                <td> Penalty Amount </td>
                                <td style="text-align: right;color: red;"> Php<?= round(((3.75 * $totalPayment) / 100),2) ?> </td>
                                </tr>
                                <tr>
                                <td> Penalty Rate </td>
                                <td style="text-align: right;color: red;"> <?= round(3.75 ,4) ?>% </td>
                                </tr>
                                <tr>
                                <td> Payment Term Added </td>
                                <td style="text-align: right;color: red;"> 1Month </td>
                                </tr>
                                <tr>
                                <td> Total Balance </td>
                                <td style="text-align: right;color: red;"> Php<?= round($totalPayment + ((3.75 * $totalPayment) / 100),2) ?> </td>
                                </tr>  
                            </tbody>
                        </table>
                        <a style="margin-top: 40px;margin-bottom: 20px;" href="<?= base_url().'reports/doPenalty/'.$loanInfo->loan_accountID ?>" class="btn btn-warning"> APPLY </a>
                     </div>
                 </div>

              </div>
            </div>
    </div>