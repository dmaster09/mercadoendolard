
<!-- registration-section-starts -->
<div class="container-login100">
  <div class="wrap-login100 w-800px">
    <div class="container">
      <span class="login100-form-title pb-5">
       Sign up (Attachments)
      </span>
      
      <div class="line-title-left"></div>
      <?php 
      if($this->session->flashdata('error')){
        echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
      }
      ?>

      <?php 
        $attributes = array('method' => 'post','id' => 'attachment_form'); 
        echo form_open_multipart('auth/attachment',$attributes); 
      ?>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-label">Profile Picture *</label>
            <input type="file" name="profile" class="form-control"  accept="image/png,image/jpeg"/>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-label">BC ID * <small>(Front) (ID card, driving license, social card etc.)</small></label>
            <input type="file" name="id_front" class="form-control"  />
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-label">BC ID <small>(Back) (ID card, driving license, social card etc.)</small></label>
            <input type="file" name="id_back" class="form-control"  />
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-label">Prove of social insurance no. (SIN) *</label>
            <input type="file" name="sin_prove" class="form-control"  />
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-label">Prove of legally entitled to work in canada *</label>
            <input type="file" name="work_prove" class="form-control"  />
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-label">Direct Deposit form or void cheque *</label>
            <input type="file" name="deposit" class="form-control"  />
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-label">Resume</label>
            <input type="file" name="resume" class="form-control"  />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <?php if($this->recaptcha_status): ?>
              <div class="recaptcha-cnt">
                  <?php generate_recaptcha(); ?>
              </div>
            <?php endif; ?>
          <div class="form-group">
            <input type="submit" class="login100-form-btn btn-block" name="submit" value="Register">
          </div>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>  
  </div>  
</div>

<!-- registration-section-Ends -->