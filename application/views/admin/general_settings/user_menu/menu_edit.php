  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Edit Menu </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/general_settings/user_menu'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Menu List</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/general_settings/menu_edit/'.$module['id']), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="module_name" class="col-md-2 control-label">Menu Name</label>

                <div class="col-md-12">
                  <input type="text" name="menu_name" value="<?= $module['name']; ?>" class="form-control" id="module_name" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="operation" class="col-md-2 control-label">Link</label>

                <div class="col-md-12">
                  <input type="text" name="operation" value="<?= $module['link']; ?>" class="form-control" id="operation" placeholder="eg. about_us">
                </div>
              </div>

              <div class="form-group">
                <label for="operation" class="col-md-2 control-label">Status</label>

                <div class="col-md-12">
                  <?php 
                    $options = array('0' => 'Inactive','1' => 'Active');  
                    $others = array('class' => 'form-control');  
                    echo form_dropdown('status',$options,$module['active'],$others);
                  ?>
                </div>
              </div>


              <div class="form-group">
                <label for="sort_order" class="col-md-2 control-label">Sort Order</label>

                <div class="col-md-12">
                  <input type="number" name="sort_order" value="<?= $module['sort_order']; ?>" class="form-control" id="sort_order" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Update Menu" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>