<div class="col-md-6">
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
    <h1>
    <?= $clientDetails->LastName.", ".$clientDetails->FirstName." ".$clientDetails->MiddleName ?>
    </h1>
    <?= form_open() ?>  
<div class="form-check form-check-inline">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="seminar" name="seminar" value="1" <?php echo $checklist->seminar == 0? '' : 'checked'; ?> > Seminar
  </label>
</div>
<div class="form-check form-check-inline">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="collateral" name="collateral" value="1" <?php echo $checklist->colateral == 0? '' : 'checked'; ?> > Collateral
  </label>
</div>

<div class="form-check form-check-inline">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="ci" name="ci" value="1" <?php echo $checklist->ci == 0? '' : 'checked'; ?> > CI
  </label>
</div>

<div class="form-check form-check-inline">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" id="comaker" name="comaker" value="1" <?php echo $checklist->co_maker == 0? '' : 'checked'; ?> > Co-Maker
  </label>
</div>
    <input hidden name="isUpdate" value="updating"></input>
     <div class="box-footer">
                <button type="submit" class="btn btn-primary">UPDATE</button>
              </div>
              <?= form_close() ?>
               </div>
        </div>
    </div>

</div>