<div class="single-slidebar-profile">
  <figure>
    <?php  $photo = get_user_profile_photo($this->session->user_id); ?>
    <a href="javascript:void(0)" class="employer-dashboard-thumb"><img src="<?= base_url($photo) ?>" alt=""></a>
    <figcaption>
        <h2><?=  $this->session->userdata('fname').' '.$this->session->userdata('lname') ?></h2>
    </figcaption>
</figure>
</div> 

<div class="single-slidebar">
  <ul class="cat-list">
    <li><a class="justify-content-between d-flex text_active" href="<?= base_url('profile') ?>"><p><i class="fa fa-user-o pr-2"></i>  Perfil</p></a></li>
    <li><a class="justify-content-between d-flex" href="<?= base_url('profile/ads') ?>"><p><i class="fa fa-id-card-o pr-2"></i> Mis Anuncios</p></a></li>
    <li><a class="justify-content-between d-flex" href="<?= base_url('profile/favourite') ?>"><p><i class="fa fa-heart-o pr-2"></i>  Favoritos</p></a></li>
    <li><a class="justify-content-between d-flex" href="<?= base_url('profile/notifications') ?>"><p><i class="fa fa-briefcase pr-2"></i>  Notificaciones</p></a></li>
    <!-- <li><a class="justify-content-between d-flex" href="<?= base_url('profile/invoices') ?>"><p><i class="fa fa-list pr-2"></i>  Facturas</p></a></li> -->
    <li><a class="justify-content-between d-flex" href="<?= base_url('inbox') ?>"><p><i class="fa fa-bell-o pr-2"></i>  Mensajes</p></a></li>
    <li><a class="justify-content-between d-flex text-active" href="<?= base_url('profile/change_password') ?>"><p><i class="fa fa-lock pr-2"></i> Cambiar Contraseña</p></a></li>
    <li><a class="justify-content-between d-flex" href="<?= base_url('auth/logout') ?>"><p><i class="fa fa-sign-out pr-2"></i> Cerrar Sesión</p></a></li>
  </ul>
</div> 