<div class="content-wrapper">  
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card card-default">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"> <i class="fa fa-list"></i>&nbsp; Edit Currency </h3>
        </div>
        <div class="d-inline-block pull-right">
          <a href="<?= base_url('admin/misc/currency'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Currency List</a>
          <a href="<?= base_url('admin/misc/currency/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Currency</a>
        </div>
      </div>
      <div class="card-body table-responsive">
          <?php echo form_open(base_url('admin/misc/currency/edit/'.$currency['id']), 'class="form-horizontal"' )?> 
            <div class="form-group">
              <label for="currency_name" class="col-sm-2 control-label">Currency Name</label>

              <div class="col-sm-12">
                <input type="text" name="currency" value="<?= $currency['name']; ?>" class="form-control" id="currency" placeholder="">
              </div>
            </div>
            
            <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Currency Code</label>
            <div class="col-sm-12">
              <input type="text" name="code" class="form-control" id="name" placeholder="" value="<?= $currency['code']; ?>" >
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Currency Symbol</label>
            <div class="col-sm-12">
              <input type="text" name="symbol" class="form-control" id="name" placeholder="" value="<?= $currency['symbol']; ?>" >
            </div>
          </div>

            <div class="form-group">
              <div class="col-md-12">
                <input type="submit" name="submit" value="Update currency" class="btn btn-primary pull-right">
              </div>
            </div>
          <?php echo form_close(); ?>
      </div>
    </div>
  </section> 
</div>

<script>
  $("#currency").addClass('active');
  </script>