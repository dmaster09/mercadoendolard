  <!-- start Subscribe Area
  <section class="Subscribe-area section-half">
    <div class="container">
      <div class="row section_padding">
        <div class="col-lg-6 col-md-6 col-12">
          <p>Join our 10,000+ subscribers and get access to the latest templates, freebies, announcements and resources!</p>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
          <?php echo form_open(base_url('home/add_subscriber'), 'class="form-horizontal jsform"');  ?> 
            <div class="subscribe">
              <input class="form-control rounded-left" name="email" placeholder="Your email here" required="" type="email">
              <button class="btn btn-common rounded-right" name="submit" type="submit">Subscribe</button>

              <!-- message
              <?php if ($this->session->flashdata('success_subscriber')): ?>
                <div class="m-b-15">
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <p>
                            <i class="icon fa fa-check"></i>
                            <?php echo $this->session->flashdata('success_subscriber'); ?>
                        </p>
                    </div>
                </div>
              <?php endif; ?>

            </div>
          <?php echo form_close( ); ?>
        </div>
      </div>
    </div>
  </section>
  End Subscribe Area --> 

<!-- start footer Area
<?php 
$footer =  get_footer_settings();
?>

<footer class="footer-area footer-section">
  <div class="container">
    <div class="row">
      <?php 
        foreach ($footer as $col):
      ?>

      <div class="col-lg-<?= $col['grid_column'] ?>  col-md-<?= $col['grid_column'] ?> col-sm-6">
        <div class="single-footer-widget newsletter">
          <h6><?= $col['title'] ?></h6>
          <?= $col['content'] ?>
        </div>
      </div>

      <?php endforeach; ?>

    </div>
  </div>
</footer>
End Footer Area -->

<div class="pre-loader hidden" id="pre-loader"></div>

<!-- start Copyright Area -->
<div class="copyright1">
  <div class="container">
    <div class="row"> 
      <div class="col-md-4 col-4">
        <div class="bottom_footer_info">
          <p><?= $this->general_settings['copyright']?></p>
        </div>
      </div>
      <div class="col-md-4 col-4">
        <div class="bottom_footer_logo">
          <ul class="list-inline">
            <?php 
              $pages = get_pages(); 
              foreach($pages as $page):
            ?>
            <span class="list-inline-item"><a href="<?= base_url('p/'.$page['slug']) ?>">
            <?= $page['title'] ?>
            </a></span>
            <?php endforeach; ?>
            <li class="list-inline-item"></li>
          </ul>
        </div>
      </div>  <!-- lang/ -->

      <div class="col-md-4 col-4">
        <div class="bottom_footer_logo text-right">
          <ul class="list-inline">
           
            
            <li class="list-inline-item"><a target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a target="_blank"><i class="fa fa-google"></i></a></li>
            <li class="list-inline-item"><a target="_blank"><i class="fa fa-linkedin"></i></a></li>
          </ul> 
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Copyright Area --> 