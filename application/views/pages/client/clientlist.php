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

<table id="listClients" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Birthdate</th>
                <th></th>
                 <th></th>
                  <th></th>
                   <th></th>
            </tr>
        </thead>

        <tbody>
        <?php if(!empty($listClients)){ 
                foreach($listClients as $list){
            ?>
        <tr>
        <td> <?= $list->LastName.", ".$list->FirstName." ".$list->MiddleName ?> </td>
        <td> <?= $list->HomeAddressContact ?> </td>
        <td> <?= $list->HomeAddress1 ?> </td>
        <td> <?=  date_format(date_create($list->BirthDate), 'Y-m-d') ?> </td>
      
        <td> 
            <a href="<?= base_url().'client/update/'.$list->ClientID ?>"class="btn btn-default">
                View/Edit
            </a>
        </td>

        <td> 
            <a href="<?= base_url().'client/clientLoan/'.$list->ClientID ?>" class="btn btn-success">
                Loans
            </a>
        </td>

        <td>    
            <a href="<?= base_url().'client/clientCBUsavings/'.$list->ClientID ?>" class="btn btn-success">
                Savings
            </a>
        </td>   

        <td> 
            <a href="<?= base_url().'client/createCheclist/'.$list->ClientID ?>" class="btn btn-warning">
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

    </div>
</div>