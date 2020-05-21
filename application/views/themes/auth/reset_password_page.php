<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=isset($title) ? $title. ' - '. $this->general_settings['application_name']: $this->general_settings['application_name']; ?></title>
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
          <span class="login100-form-title p-b-55">
              Nueva contraseña
          </span>
          <?php if(isset($msg) || validation_errors() !== ''): ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?= validation_errors();?>
                <?= isset($msg)? $msg: ''; ?>
            </div>
          <?php endif; ?>
    
          <?php $attributes = array('id' => 'login_form', 'method' => 'post' , 'class' => 'login100-form validate-form');
            echo form_open(base_url('auth/reset_password/'.$reset_code), $attributes);?>
    
            <div class="wrap-input100 mb-3">
              <input class="input100" type="password" name="password" placeholder="nueva contraseña">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <span class="lnr lnr-lock"></span>
              </span>
            </div>
            <div class="wrap-input100 mb-3">
              <input class="input100" type="password" name="confirm_password" placeholder="Confirma contraseña">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <span class="lnr lnr-lock"></span>
              </span>
            </div>
            <div class="container-login100-form-btn pt-2">
              <input type="submit" class="login100-form-btn" name="submit" value="Guardar">
            </div>
          <?php echo form_close(); ?>
    
          <div class="text-center w-full pt-4">
              <span class="txt1">
                ¿Recuerdas Tu Contraseña?
              </span>
              <a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/login">
                Entra            
              </a>
          </div>
        </div>
      </div>
</div>
  
  
<!--===============================================================================================-->  
  <script src="<?= base_url() ?>assets/js/vendor/jquery-2.2.4.min.js"></script>
<!--===============================================================================================-->
  <script src="<?= base_url() ?>assets/js/popper.js"></script>
  <script src="<?= base_url() ?>assets/js/vendor/bootstrap.min.js"></script>

</body>
</html>