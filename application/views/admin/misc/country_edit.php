<div class="content-wrapper">  
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card card-default">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"> <i class="fa fa-list"></i>&nbsp; Edit Country </h3>
        </div>
        <div class="d-inline-block pull-right">
          <a href="<?= base_url('admin/misc/country'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Country List</a>
          <a href="<?= base_url('admin/misc/country/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Country</a>
        </div>
      </div>
      <div class="card-body table-responsive">
          <?php echo form_open(base_url('admin/misc/country/edit/'.$country['id']), 'class="form-horizontal"' )?> 
            <div class="form-group">
              <label for="country_name" class="col-sm-2 control-label">Country Name</label>

              <div class="col-sm-12">
                <input type="text" name="country" value="<?= $country['name']; ?>" class="form-control" id="country" placeholder="">
              </div>
            </div>
            <div class="form-group">
              <label for="country_name" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-12">
                <?php 
                $options = array('1' => 'Active', '0' => 'Inactive');
                  echo form_dropdown('status',$options,$country['status'],'class="form-control"');
                ?>
              </div>

            </div>
            <div class="form-group">
              <div class="col-md-12">
                <input type="submit" name="submit" value="Update country" class="btn btn-primary pull-right">
              </div>
            </div>
          <?php echo form_close(); ?>
      </div>
    </div>
  </section> 
</div>

<script>
  $("#country").addClass('active');
  </script>