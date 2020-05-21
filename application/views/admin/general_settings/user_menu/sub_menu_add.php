  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Add New Sub Menu </h3>
          </div>
          <?php $parent_menu = $this->uri->segment(4); ?>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/general_settings/sub_menu/'.$parent_menu); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Sub Menu List</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/general_settings/sub_menu_add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="module_name" class="col-md-2 control-label">Name</label>

                <div class="col-md-12">
                  <input type="text" name="module_name" class="form-control" id="module_name" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="operation" class="col-md-2 control-label">Link</label>

                <div class="col-md-12">
                  <input type="text" name="operation" class="form-control" id="operation" placeholder="eg. about_us">
                </div>
              </div>

              <div class="form-group">
                <label for="sort_order" class="col-md-2 control-label">Sort Order</label>

                <div class="col-md-12">
                  <input type="number" name="sort_order" class="form-control" id="sort_order" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="hidden" name="parent_menu" value="<?= $parent_menu ?>">
                  <input type="submit" name="submit" value="Add Sub Menu" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>