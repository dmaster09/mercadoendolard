<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Mis Anuncios				
				</h1>	
				<p class="text-white link-nav"><a href="<?= base_url() ?>">Inicio </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Mis Anuncios</a></p>
			</div>											
		</div>
	</div>
</section>
<!-- End banner Area -->	

<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
        <?php $this->load->view('themes/_messages'); ?>
		<div class="row justify-content-center d-flex">
			<div class="col-lg-3 sidebar">
				<?php $this->load->view($user_sidebar);  ?>
			</div>
			<div class="col-lg-9 post-list">
				<div class="profile_job_content col-lg-12">
					<div class="headline">
						<h3>Mis Anuncios</h3>
					</div>
					<div class="profile_job_detail">
						<div class="row">
							<div class="col-md-4 col-12 gp_products_item">
								<div class="gp_products_inner">
									<div class="gp_products_item_image">
										<a href="<?= base_url('seller/ads/add') ?>">
											<img src="<?= base_url('assets/') ?>img/default-img.jpg" alt="gp product 001" />
										</a>
									</div>
									<div class="gp_products_item_caption">
										<ul class="gp_products_caption_name text-center">
											<li><a href="<?= base_url('seller/ads/add') ?>">Publica un Anuncio</a></li>
											<li><p class="pt-2">Tu aviso será revisado por nuestro equipo y será eliminado si no cumple con las reglas de MercadoenDolar.com</p></li>
										</ul>
									</div>
								</div>
							</div>

                               <div class="col-md-4 col-12 gp_products_item">
								<div class="gp_products_inner">
									<div class="gp_products_item_image">
										<a href="<?= base_url('seller/ads/add/minitienda') ?>">
											<img src="<?= base_url('assets/') ?>img/default-img.jpg" alt="gp product 001" />
										</a>
									</div>
									<div class="gp_products_item_caption">
										<ul class="gp_products_caption_name text-center">
											<li><a href="<?= base_url('seller/ads/add/minitienda') ?>">Crea una Mini Tienda</a></li>
											<li><p class="pt-2">Tu tienda se vera como un anuncio en los listados pero dentro contendra una lista con tus productos o servicios, precios y detalles</p></li>
										</ul>
									</div>
								</div>
							</div>


							<?php 
							    foreach ($ads as $row): 
							        
							        if($row['is_status'] == '1')
							        $ad_url = base_url('ad/'.$row['slug']);
							        else
							        $ad_url = 'void:javascript(0)';
							?>

							<div class="col-md-4 col-12 gp_products_item">
								<div class="gp_products_inner">
									<div class="gp_products_item_image">
										<a href="<?= $ad_url ?>">
											<img src="<?= base_url($row['img_1']) ?>" alt="<?= $row['title'] ?>" />
										</a>
									</div>
									<div class="gp_products_item_caption">
										<ul class="gp_products_caption_name">
											<li><a href="<?= $ad_url ?>"><?= $row['title'] ?></a></li>
											<li><small><?= $row['category_name'] ?></small><a href="<?= $ad_url ?>" class="pull-right"><small><?= get_currency_symbol($this->general_settings['currency']) ?></small><?= number_format($row['price']) ?></a></li>
											<li><small>Expira el <?= date_time($row['expiry_date']) ?></small></li>
										</ul>
										<ul class="gp_products_caption_rating mt-2">
										    
										    <?php if($row['is_status'] != '3'): ?>
											<li><a href="<?= base_url('seller/ads/edit/'.$row['id']) ?>"><i class="fa fa-edit"></i></a></li>
											<li><a href="<?= base_url('seller/ads/delete/'.$row['id']) ?>" class="btn-delete"><i class="fa fa-trash"></i></a></li>

                                             
                                             <?php endif; ?>

											<li class="pull-right">
											    <a href="void:javascript(0)">
											    <?php if($row['is_status'] == '0') echo 'En revision'; ?>
											    <?php if($row['is_status'] == '1') echo 'Activo'; ?>
											    <?php if($row['is_status'] == '2') echo 'Expirado'; ?>
											    </a>
											 </li>
										</ul>
									</div>
								</div>
							</div>

							<?php endforeach; ?>

						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>	
</section>
<!-- End post Area -->