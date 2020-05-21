<div class="content-wrapper">
<section class="content">
  <!-- For Messages -->
  <?php $this->load->view('admin/includes/_messages.php') ?>
  <div class="card card-default">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"> <i class="fa fa-list"></i>&nbsp; Add New City </h3>
        </div>
        <div class="d-inline-block pull-right">
          <a href="<?= base_url('admin/misc/city'); ?>" class="btn btn-success"><i class="fa fa-list"></i> City List</a>
        </div>
      </div>
      <div class="card-body">
        <?php echo form_open(base_url('admin/misc/city/add'), 'class="form-horizontal"');  ?> 
          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">State</label>
            <div class="col-sm-12">
              <select class="form-control select2" required name="state">
               <option value="">Select State</option>
                <?php foreach($states as $state):?>
                  <?php if($city['state_id'] == $state['id']): ?>
                  <option value="<?= $state['id']; ?>" selected> <?= $state['name']; ?> </option>
                <?php else: ?>
                  <option value="<?= $state['id']; ?>"> <?= $state['name']; ?> </option>
              <?php endif; endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">City Name</label>
            <div class="col-sm-12">
              <input type="text" name="city" class="form-control" id="name" placeholder="city name" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Add City" class="btn btn-primary pull-right">
            </div>
          </div>
        <?php echo form_close( ); ?>
    </div>
  </div>
</section> 
</div>

<script>
  $("#country").addClass('active');
  </script>