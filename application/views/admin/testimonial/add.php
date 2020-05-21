<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">



<section class="content-wrapper">

  <section class="content">

    <!-- For Messages -->

    <?php $this->load->view('admin/includes/_messages.php') ?>

    <div class="card card-default">

      <div class="card-header">

        <div class="d-inline-block">

            <h3 class="card-title"> <i class="fa fa-list"></i>

            &nbsp; Add Testimonial </h3>

        </div>

        <div class="d-inline-block float-right">

          <a href="<?= base_url('admin/testimonial'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Testimonials List</a>

        </div>

      </div>

      <div class="card-body">

        <div class="row">

          <div class="col-md-12">

            <!-- form start -->

            <?php echo validation_errors(); ?>           

            <?php echo form_open_multipart(base_url('admin/testimonial/add'), 'class="form-horizontal"');  ?> 

              <div class="form-group">

                <label for="name" class="col-sm-3 control-label">Testimonial By</label>

                <div class="col-sm-12">

                  <input type="text" name="testimonial_by" class="form-control" placeholder="Testimonial By">

                </div>

              </div>

              <div class="form-group">

                <label for="name" class="col-sm-3 control-label">Testimonial</label>

                <div class="col-sm-12">

                  <textarea name="testimonial" class="form-control textarea" rows="6" placeholder="Testimonial"></textarea>

                </div>

              </div>

              <div class="form-group">

                <label for="name" class="col-sm-3 control-label">Company and Designation</label>

                <div class="col-sm-12">

                  <input type="text" name="about" class="form-control" placeholder="Company and Designation">

                </div>

              </div>

              <div class="form-group">

                <label for="name" class="col-sm-3 control-label">User Image</label>

                <div class="col-sm-12">

                  <input type="file" name="photo" class="form-control" >

                </div>

              </div>

              <div class="form-group">

                <label for="name" class="col-sm-3 control-label">Is default?</label>

                <div class="col-sm-12">

                  <?php 

                    $options =  array('0' => 'No', '1' => 'Yes');

                    echo form_dropdown('default',$options,'','class="form-control select2"');

                  ?>

                </div>

              </div>

              <div class="form-group">

                <label for="name" class="col-sm-3 control-label">Is Active?</label>

                <div class="col-sm-12">

                  <?php 

                    $options =  array('1' => 'Yes', '0' => 'No');

                    echo form_dropdown('status',$options,'','class="form-control select2"');

                  ?>

                </div>

              </div>

              <div class="form-group">

                <div class="col-md-12">

                  <input type="submit" name="submit" value="Add Testimonial" class="btn btn-primary pull-right">

                </div>

              </div>

            <?php echo form_close( ); ?>

          </div>

          <!-- /form -->

        </div>

      </div>  

    </div>

  </section> 

</section> 



<!-- Bootstrap WYSIHTML5 -->

<script src="<?= base_url() ?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>


<script>

  $(function () {

    // bootstrap WYSIHTML5 - text editor

    $('.textarea').wysihtml5({

      toolbar: { fa: true }

    });

  })

</script>

<script>

  $("#testimonial").addClass('active');

</script>