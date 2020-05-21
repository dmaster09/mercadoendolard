<!-- start banner Area -->
  <section class="banner-area relative" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="container">
      <div class="row d-flex align-items-center justify-content-center">
        <div class="about-content col-lg-12">
          <h1 class="text-white">
            Actualiza tu Contraseña   
          </h1> 
          <p class="text-white link-nav"><a href="<?= base_url() ?>">Inicio </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Actualiza tu Contraseña</a></p>
        </div>                      
      </div>
    </div>
  </section>
  <!-- End banner Area -->  
  
  <!-- Start post Area -->
  <section class="post-area section-gap">
    <div class="container">
      <div class="row justify-content-center d-flex">
        <div class="col-lg-3 sidebar">
          <!-- sidebar -->

          <?php $this->load->view($user_sidebar) ?>   

        </div>
        <div class="col-lg-9 post-list">
          <div class="profile_job_content col-lg-12">
            <div class="headline">
              <h3> Actualiza tu Contraseña</h3>
            </div>
            <div class="profile_job_detail">

              <?php 
                $attributes = array('method' => 'post','class' => 'jsform'); 
                echo form_open('profile/change_password',$attributes); 
              ?>

              <div class="row">
                
                <div class="col-md-12 col-sm-12">
                  <div class="submit-field">
                    <h5>Contraseña Actual *</h5>
                    <input class="form-control" name="current_password" type="password" value="" placeholder="Ingresa la contraseña actual" required>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                  <div class="submit-field">
                    <h5>Nueva Contraseña *</h5>
                    <input class="form-control" name="new_password" type="password" value="" placeholder="Ingresa la nueva contraseña" required>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                  <div class="submit-field">
                    <h5>Confirma Contraseña *</h5>
                    <input class="form-control" name="confirm_password" type="password" placeholder="Confirma la contraseña" value="" required>
                  </div>
                </div>

                <div class="add_job_btn col-lg-12 mt-5">
                  <div class="submit-field">
                     <input type="submit" class="job_detail_btn" name="update" value="Actualizar Contraseña">
                  </div>
                </div>  

              </div>

              <?php echo form_close(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>  
  </section>
  <!-- End post Area -->

  <!-- start Subscribe Area 
  <section class="Subscribe-area section-half">
      <div class="container">
          <div class="row section_padding">
              <div class="col-lg-6 col-md-6 col-12">
                  <p>Join our 10,000+ subscribers and get access to the latest templates, freebies, announcements and resources!</p>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                  <form>
                      <div class="subscribe">
                          <input class="form-control rounded-left" name="email" placeholder="Your email here" required="" type="email">
                          <button class="btn btn-common rounded-right" type="submit">Subscribe</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </section>-->
  <!-- End Subscribe Area --> 