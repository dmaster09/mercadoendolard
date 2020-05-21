<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card card-default">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"> <i class="fa fa-list"></i>&nbsp; Add New Language </h3>
        </div>
        <div class="d-inline-block pull-right">
          <a href="<?= base_url('admin/misc/language'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Language List</a>
        </div>
      </div>
      <div class="card-body table-responsive">
        <?php echo form_open(base_url('admin/misc/language/add'), 'class="form-horizontal"');  ?> 
          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Language Name</label>
            <div class="col-sm-12">
              <input type="text" name="language" class="form-control" placeholder="Language Name">
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Short Form</label>
            <div class="col-sm-12">
              <input type="text" name="short_form" class="form-control" placeholder="e.g. en">
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Language Code</label>
            <div class="col-sm-12">
              <input type="text" name="code" class="form-control" placeholder="e.g. en_us">
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Status</label>
            <div class="col-sm-12">
              <?php 
                $options = array('1' => 'Active', '0' => 'Inactive');
                echo form_dropdown('status',$options,'','class="form-control"');
              ?>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Add language" class="btn btn-primary pull-right">
            </div>
          </div>
        <?php echo form_close( ); ?>
      </div>
    </div>
  </section> 
</div>

<script>
  $("#language").addClass('active');
</script>