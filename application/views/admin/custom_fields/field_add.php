<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Add new custom field</h3>
        </div>
        <div class="d-inline-block float-right">
          <a href="<?= base_url('admin/custom_fields'); ?>" class="btn btn-success"><i class="fa fa-reply"></i> Back</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="box border-top-solid">
              <!-- form start -->
              <div class="box-body">

                <?php echo validation_errors(); ?>           
                <?php 
                  echo form_open(base_url('admin/custom_fields/add'), 'class="form-horizontal jsform" novalidate');
                ?> 

                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-12">
                    <input type="text" name="name" class="form-control" placeholder="Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Feild Length</label>
                  <div class="col-sm-12">
                    <input type="number" name="length" class="form-control" placeholder="Feild Length"/>
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Default Value</label>
                  <div class="col-sm-12">
                    <input name="default" class="form-control" placeholder="Default Value"/>
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Required</label>
                  <div class="col-sm-12">
                    <input type="checkbox" name="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Active</label>
                  <div class="col-sm-12">
                    <input type="checkbox" name="active">
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Type</label>
                  <div class="col-sm-12">
                    <?php
                      $icons = get_record('ci_field_type');
                      $options = array('' => '-') + array_column($icons, 'name','name');
                      $attributes = array('class' => 'form-control field-type select2','required' => true);
                      echo form_dropdown('type',$options,'',$attributes);
                    ?>
                  </div>
                </div>

                <div class="options-wrapper hidden">

                  <div class="options">

                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Option</label>         
                      <div class="col-sm-12">
                        <input type="text" class="form-control new-option" placeholder="Enter Option Value">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="name" class="col-sm-3 control-label"></label>         
                    <div class="col-sm-12">
                      <button type="button" class="btn btn-warning btn-sm btn-add-option">Add Option</button>
                    </div>
                  </div>

                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <input type="submit" name="submit" value="Add Field" class="btn btn-primary pull-right">
                  </div>
                </div>

                <?php echo form_close( ); ?>

              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>  
      </div>
    </div>
  </section> 
</div>

<script>
  $("#category").addClass('active');
</script>