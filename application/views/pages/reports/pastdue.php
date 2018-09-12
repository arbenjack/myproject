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
                  <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    
           <div class="form-group">
              <?=show_alerts(@$alert)?>
            </div>
            <?= form_open() ?>
            <div class="form-group">
                  <label>Select</label>
                <?=form_dropdown('dateType',[
                    'week' => 'This Week',
                    'month' => 'This Month'
                ],set_value('dateType') ,['class' => 'form-control select2event' ])?>
    
                <?=formErrorh('danger',form_error('dateType'))?>
             </div>
             <div hidden class="form-group">
                <label>Select Payment Term</label>
                <?=form_dropdown('dueType',[
                        1 => 'Nearest Due',
                        2 => 'Past Due'  
                ],set_value('dueType'),['class' => 'form-control select2event' ])?>
             </div>
            
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            <?= form_close() ?>
                </div>
          <!-- /.box -->

                       <table id="listClients" class="display mydatatable" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Loan ID</th>
                <th>Loan Name</th>
                <th>Loan Amount</th>
                <th>Payment Term</th>
                <th>Status</th>
                <th>Pass Due Date</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        <?php if(!empty($dueList)){ 
                foreach($dueList as $list){
            ?>
        <tr>
        <td> <?= $list->LastName.", ".$list->FirstName." ".$list->MiddleName ?> </td>
        <td> <?= $list->loan_accountID ?> </td>   
        <td> <?= $list->loanProduct_name ?> </td>
        <td> <?= round($list->loanAmount,6) ?> </td>
        <td> <?= $list->termNumber ?> Months </td>
        <td>         
                <?php if((time()-(60*60*24)) < strtotime($list->date_cutoff)){
                        echo '<label STYLE="font-size: 18;color: orange;"> NEAR DUE DATE </label>';
                    }else if((time()-(60*60*24)) > strtotime($list->date_cutoff)){
                        echo '<label STYLE="font-size: 18;color: red;"> PASS DUE </label>';
                    }
                    ?>
              </td>
        <td> <?= date_format(date_create($list->date_cutoff),'m/d/Y') ?> </td>
        <td> 
        <?php if((time()-(60*60*24)) < strtotime($list->date_cutoff)){ ?>
            <a type="button" loanAcct="<?= $list->loan_accountID ?>" class="btn btn-default sendsmsBtn">
                SEND SMS
            </a>
                 <?php   }else if((time()-(60*60*24)) > strtotime($list->date_cutoff)){ ?>
             <a href="<?= base_url().'reports/setPenalty/'.$list->loan_accountID ?>" class="btn btn-danger">
                PENALTY
            </a>
                   <?php }
                    ?>
            
            
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

