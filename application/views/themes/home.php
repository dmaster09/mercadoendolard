  <!-- start banner Area -->
  <section class="banner-area relative" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="banner-content col-lg-10">
          <h1 class="text-white pt-100">
            <?= trans('home_welcome') ?>
          </h1> 
          <?php 
            $attributes = array('method' => 'get', 'class' => 'serach-form-area'); 
            echo form_open(base_url('ads'),$attributes);
          ?>
            <div class="row justify-content-center form-wrap no-gutters">
              <div class="col-lg-8 form-cols rounded-left">
                <input type="text" class="form-control rounded-left" name="q" placeholder="<?= trans('home_search') ?>">
              </div>
              <div class="col-lg-3 form-cols">
                <div>
                  <?php
                    $where = array('status' => 1);
                    $rows = get_records_where('ci_categories',$where);
                    $options = array('' => trans('all_categories')) + array_column($rows,'name','id');
                    echo form_dropdown('category',$options,'','class="form-control"');
                  ?>
                </div>                    
              </div>
              <div class="col-lg-1 form-cols rounded-right">
                  <button type="submit" class="btn btn-info rounded" >
                    <i class="lnr lnr-magnifier text-white"></i>
                  </button>
              </div>                
            </div>
          <?php echo form_close(); ?>
          <p class="text-white"> <!--<span><?= trans('search') ?> :</span> --> <?= trans('home_bottom_line') ?></p>
        </div>                      
      </div>
    </div>
  </section>
  <!-- End banner Area -->  
  
  <!-- Start feature-cat Area -->
  <section class="feature-cat-area section-full" id="category">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-40 col-lg-10">
          <div class="title text-center">
            <h1 class="mb-10"><?= trans('product_categories') ?></h1>
            <hr class="lines">
          </div>
        </div>
      </div>            
      <div class="row">
    
        <?php foreach($categories as $category): ?>

        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
          <div class="single-fcat">
            <a href="<?= base_url('category/'.$category['slug']) ?>">
              <img src="<?= base_url($category['picture']) ?>" alt="<?= $category['name'] ?>">
            </a>
            <p><?= $category['name'] ?></p>
          </div>
        </div>

        <?php endforeach; ?>
      </div>
    </div>  
  </section>
  <!-- End feature-cat Area -->


  <!--*-*-*-*-*-*-*-*-*-*- BOOTSTRAP CAROUSEL  Featured Start*-*-*-*-*-*-*-*-*-*-->
<section class=" section-full bg-gray">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="menu-content pb-40 col-lg-10">
        <div class="title text-center">
          <h1 class="mb-10"><?= trans('featured_ads') ?></h1>
          <hr class="lines">
        </div>
      </div>
    </div>
    <div class="row d-flex justify-content-center">
      <div id="adv_gp_products_3_columns_carousel" class="carousel slide gp_products_carousel_wrapper  ps_easeOutCirc" data-ride="carousel" data-duration="2000" data-interval="5000" data-pause="hover" data-column="4" data-m576="1" data-m768="1" data-m992="<?= count($featured) ?>" data-m1200="<?= count($featured) ?>">
        <!--========= Wrapper for slides =========-->
        <div class="carousel-inner" role="listbox">

          <?php $count = 1; foreach($featured as $fpost): 
              $location_items=locationItem($fpost['state'],$fpost['city']);

          ?>

          <!--========= slide =========-->
          <div class="carousel-item <?= ($count == 1) ? 'active': ''?>">
            <div class="row"> <!-- Row -->
            <div class="col gp_products_item">
              <div class="gp_products_inner">
                <span class="featured_label"><?= get_featured_label($fpost['is_featured']) ?></span>
                <div class="gp_products_item_image">
                  <a href="<?= base_url('ad/'.$fpost['slug']) ?>">
                    <img src="<?= base_url($fpost['img_1']) ?>" alt="<?= $fpost['title'] ?>" />
                  </a>
                </div>
                <div class="gp_products_item_caption">
                  <ul class="gp_products_caption_name">
                    <li><a href="<?= base_url('ad/'.$fpost['slug']) ?>">
                     
                    <div class="title-cto"><?=substr($fpost['title'],0,27);?></div> 
                    <div class="title-lgo"><?=$fpost['title'];?></div> 
                    
                    </li>
                    <li><small><?= date_time($fpost['created_date']) ?></small><a href="<?= base_url('ad/'.$fpost['slug']) ?>" class="pull-right"><small><?= get_currency_symbol($this->general_settings['currency']); ?></small><?= number_format($fpost['price']) ?></a></li>
                    <li><small class="title-cto"><?=substr($location_items,0,38);?></small></li>
                    <li><small class="title-lgo"><?=$location_items;?></small></li>
                  
                

                  </ul>
                  <li>
                  <ul class="gp_products_caption_rating mt-2">
                  <?php 
                  $rating = get_post_rating($fpost['id']);

                  for ($i = 1; $i < 6; $i++):

                    if($rating >= $i)

                    {
                  ?>
                  <li><i class="fa fa-star"></i></li>
                  <?php 
                    }
                    else
                    {
                  ?>
                  <li><i class="fa fa-star-o"></i></li>
                  <?php
                    }
                    endfor;
                  ?>
                    <?php $favorite = is_favorite($fpost['id'],$this->session->user_id); ?>
                    <li class="pull-right"><a href="javascript:void(0)" class="btn-favorite"><i class="fa <?= ($favorite) ? 'fa-heart' : 'fa-heart-o' ?> i-favorite" data-post="<?= $fpost['id'] ?>"></i></a></li>
                </ul>
                </li>
                </div>
              </div>
            </div>
            </div>
          </div>

          <?php $count++; endforeach; ?>

        </div>

        <!--======= Navigation Buttons =========-->

        <!--======= Left Button =========-->
        <a class="carousel-control-prev gp_products_carousel_control_left" href="#adv_gp_products_3_columns_carousel" data-slide="prev">
          <span class="fa fa-angle-left gp_products_carousel_control_icons" aria-hidden="true"></span>
          
        </a>

        <!--======= Right Button =========-->
        <a class="carousel-control-next gp_products_carousel_control_right" href="#adv_gp_products_3_columns_carousel" data-slide="next">
          <span class="fa fa-angle-right gp_products_carousel_control_icons" aria-hidden="true"></span>
          
        </a>

      </div>
    </div>
  </div>
</section> <!--*-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL Featured Items *-*-*-*-*-*-*-*-*-*-->

  <!-- Start product Area -->
  <section class="product-area section-full">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-40 col-lg-10">
          <div class="title text-center">
            <h1 class="mb-10"><?= trans('latest_ads') ?></h1>
            <hr class="lines">
          </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center mb-30">
        <?php foreach($ads as $post):  
              $location_items=locationItem($post['state'],$post['city']);
          ?>
        <div class="col-md-3 col-12 gp_products_item">
          <div class="gp_products_inner">
            <?php 
                $label = get_featured_label($post['is_featured']);
                if(!empty($label)):
            ?>
            <span class="featured_label"><?= get_featured_label($post['is_featured']) ?></span>
            <?php endif; ?>
            <div class="gp_products_item_image">
              <a href="<?= base_url('ad/'.$post['slug']) ?>">
                <img src="<?= base_url($post['img_1']) ?>" alt="<?= $post['title'] ?>" />
              </a>
            </div>
            <div class="gp_products_item_caption">
              <ul class="gp_products_caption_name">
                <li><a href="<?= base_url('ad/'.$post['slug']) ?>">
                  
                    <div class="title-cto"><?=substr($post['title'],0,27);?></div> 
                    <div class="title-lgo"><?=$post['title'];?> </div> 
                    

                  </a>

                </li>
                <li><small><?= date_time($post['created_date']) ?></small><a href="<?= base_url('ad/'.$post['slug']) ?>" class="pull-right"><small><?= get_currency_symbol($this->general_settings['currency']) ?></small><?= number_format($post['price']) ?></a></li>
                  <li><small class="title-cto"><?=substr($location_items,0,38);?></small></li>
                  <li><small class="title-lgo"><?=$location_items;?></small></li>

               

              </ul>
              <ul class="gp_products_caption_rating mt-2">
                <?php 
                $rating = get_post_rating($post['id']);

                for ($i = 1; $i < 6; $i++):

                  if($rating >= $i)

                  {
                ?>
                <li><i class="fa fa-star"></i></li>
                <?php 
                  }
                  else
                  {
                ?>
                <li><i class="fa fa-star-o"></i></li>
                <?php
                  }
                  endfor;
                ?>
                <?php $favorite = is_favorite($fpost['id'],$this->session->user_id); ?>
                    <li class="pull-right"><a href="javascript:void(0)" class="btn-favorite"><i class="fa <?= ($favorite) ? 'fa-heart' : 'fa-heart-o' ?> i-favorite" data-post="<?= $fpost['id'] ?>"></i></a></li>
              </ul>
            </div>
          </div>
        </div>  
        <?php endforeach; ?>

        <div class="col-md-2">
          <a href="<?= base_url('ads') ?>" class="btn btn-success btn-block mt-20">Ver Más</a>
        </div>

      </div>
    </div>  
  </section>