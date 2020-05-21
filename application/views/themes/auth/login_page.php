<!DOCTYPE html>
<html lang="es_VE">
<head>
  <title><?=isset($title) ? $title. ' - '. $this->general_settings['application_name']: $this->general_settings['application_name'] ; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="shortcut icon" href="<?= base_url($this->general_settings['favicon']); ?>">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/animate.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/main.css">
<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <!-- for messages -->
        <span class="login100-form-title p-b-55">
          ¡HOLA!
        </span>
        <?php $this->load->view('themes/_messages'); ?>
        
        <?php 
          $attributes = array('method' => 'post','class' => 'login100-form validate-form jsform'); 
          echo form_open('auth/login',$attributes); 
        ?>
          <div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="email" placeholder="<?= trans('email') ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <span class="lnr lnr-envelope"></span>
            </span>
          </div>
          <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
            <input class="input100" type="password" name="password" placeholder="<?= trans('password') ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <span class="lnr lnr-lock"></span>
            </span>
          </div>
          <div class="contact100-form-checkbox m-l-4">
            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
            <label class="label-checkbox100" for="ckb1">
              <?= trans('remember_me') ?>
            </label>
          </div>
          <div class="contact100-form-checkbox m-l-4">
            <a href="<?= base_url('auth/forgot_password') ?>">
              <?= trans('forgot_password') ?>
            </a>
          </div>
          <div class="container-login100-form-btn p-t-25">
            <input type="submit" class="login100-form-btn" value="ENTRAR" name="login" />
          </div>
          <div class="text-center w-full pt-30">
            <span class="txt1">
             <?= trans('not_a_member') ?>
            </span>
            <a class="txt1 bo1 hov1" href="<?= base_url('register') ?>">
              <?= trans('signup_now') ?>
            </a>
          </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
  
  
<!--===============================================================================================-->  
  <script src="<?= base_url() ?>assets/js/vendor/jquery-2.2.4.min.js"></script>
<!--===============================================================================================-->
  <script src="<?= base_url() ?>assets/js/vendor/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="<?= base_url(); ?>assets/js/sweetalert.min.js"></script>
<!--===============================================================================================-->
<script>
  //--------------------------------------------------------
// jsform
$(document).on("submit",".jsform", function(event) {
  event.preventDefault();
  $('.pre-loader').removeClass('hidden');
  var $btn = $('input[type=submit]');
  var $txt = $btn.val();
  $btn.prop('disabled',true);
  $btn.val('Por favor Espera');
  $action = $(this).attr( 'action' );
  $method = $(this).attr( 'method' );
  $.ajax({
    type: $method,
    url: $action,
    data: new FormData(this),
    processData: false,
    contentType: false,
    dataType: "json",
    success: function(obj) {
    $('.pre-loader').addClass('hidden');
      $btn.prop('disabled',false);
      $btn.val($txt);
        if(obj.status == 'success')
        {
          swal(obj.status+"!", obj.msg, obj.status);
          if (obj.redirect){
            window.location = obj.redirect; 
          }
          else{
            location.reload();
          }
        }
        else
        {
          swal(obj.status+"!", obj.msg, obj.status);
        }
   },
  });
}); 
</script>
</body>
</html>
