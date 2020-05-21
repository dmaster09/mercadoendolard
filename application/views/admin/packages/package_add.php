<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datepicker/datepicker3.css">
<section class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card card-defaul">
      <div class="card-header">
        <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-list"></i>
            &nbsp; Add New Package </h3>
        </div>
        <div class="d-inline-block float-right">
          <a href="<?= base_url('admin/packages'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Package List</a>
        </div>
      </div>

      <div class="card-body">
        
        <?php echo form_open( base_url('admin/packages/add')); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Package Detail</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <div class="box-body">

                  <div class="form-group">
                    <label for="title" class="control-label">Package Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="" placeholder="eg. basic, premium" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="days" class="control-label">Price</label>
                    <input type="price" name="price" class="form-control" id="" value="" placeholder="" required>
                  </div>

                  <div class="form-group">
                    <label for="days" class="control-label">No of Days</label>
                    <input type="number" name="no_of_days" class="form-control" id="" value="" placeholder="" required>
                  </div>

                  <div class="form-group">
                    <label for="posts" class="control-label">No of Posts</label>
                    <input type="number" name="no_of_posts" class="form-control" id="" value="" placeholder="" required>
                  </div>

                  <div class="form-group">
                    <label for="posts" class="control-label">Package Detail</label>
                    <input type="text" name="detail" class="form-control" id="" value="" placeholder="" required>
                  </div>

                </div>
                <!-- /.box-body -->
            </div>
          </div>

          <div class="col-md-12">
            <div class="box">
              <div class="box-body">
                <input type="submit" name="submit" value="Add Package" class="btn btn-primary pull-right">
              </div>
            </div>
          </div>
        </div>

        <?php echo form_close(); ?>

      </div>
      <!-- ./card body -->
    </div>
  </section> 
</section> 

<script>
  $('#packages').addClass('active');
</script>