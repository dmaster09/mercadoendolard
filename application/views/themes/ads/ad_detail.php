<!-- start banner Area -->

<section class="banner-area relative">  

<div class="overlay overlay-bg"></div>

<div class="container">

  <div class="row d-flex align-items-center justify-content-center">

    <div class="about-content col-lg-12">

      <h1 class="text-white">

        <?= $ad['title'] ?>     

      </h1> 

      <p class="text-white link-nav"><a href="<?= base_url() ?>">Inicio </a>  <span class="lnr lnr-arrow-right"></span> <a href="<?= base_url('ads') ?>"> Anúncios</a> <span class="lnr lnr-arrow-right"></span> <a href=""> <?= $ad['title'] ?></a></p>

    </div>                      

  </div>

</div>

</section>

<!-- End banner Area -->  



<!-- Start item detail Area -->

<section class="item-detail-area section-gap">

  <div class="container">

    <div class="row">

      <div class="col-lg-9 post-list blog-post-list">

        <div class="single-post">

          <!-- Slider -->

          <div id="row" class="carousel slide thumb_btm_cntr thumb_scroll_x swipe_x ps_ease" data-ride="carousel" data-pause="hover" data-interval="60000" data-duration="1000">



            <!-- Indicators -->

            <ol class="carousel-indicators ps_indicators_thumb ps_indicators_bottom_center">

                <!-- Indicator -->

                <?php 

                  for($i = 1; $i < 6; $i++):

                    if(isset($ad['img_'.$i])): 

                ?>

                <li data-target="#slider_05" data-slide-to="<?= $i ?>" class="<?= ($i == '1') ? 'active' : '' ?>"></li>

                <?php  

                    endif;

                  endfor; 

                ?>

            </ol>



            <div align="center">
              
              <!-- Wrapper For Slides -->
              
            </div>
            <div class="carousel-inner" role="listbox">
              
              <div align="center">
                <!-- First Slide -->
                
                <?php 

                  for($i = 1; $i < 6; $i++):

                    if(isset($ad['img_'.$i])): 

                ?>
                
              </div>
              <div class="carousel-item <?= ($i == '1') ? 'active' : '' ?>">
                
                <div align="center" id="imag_carousel">
                  <!-- Slide Background -->
                  
                  <img  style="width: 100%;height: 500px;object-fit: cover;" src="<?= base_url($ad['img_'.$i]) ?>" alt="<?= $ad['title'] ?> photo" />
                  
                </div>
              </div>
              
              <div align="center">
                <?php  

                    endif;

                  endfor; 

                ?>
                
                <!-- End of Slide -->
                
              </div>
            </div> 
            <!-- End of Wrapper For Slides -->
             <a class="carousel-control-prev" href="#row" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#row" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>


          </div> <!-- End Slider -->



          <div class="content-wrap">

            <h2><?= $ad['title'] ?></h2>

            <div class="content-break-wrap">

              <?= ($ad['description']) ? $ad['description'] : 'No hay Descripción disponible' ?>

            </div>

            <!-- <p></p> -->






            <?php if($others): ?>




            <table class="table text-center">

              <?php  

                foreach($others as $row):

                $field_value = $this->fields->feild_value($row['field_id'],$row['field_value']);

              ?>



                <tr>

                  <th><?= $row['fname'] ?></th>

                  <td><?= $field_value ?></td>

                </tr>



              <?php endforeach; ?>

            </table>
           
              <?php endif; ?>

 <hr class="line-separator">

  <?php if($this->session->userdata('is_user_login')):  ?>

              <h5>Tu Evaluación</h5>

              <ul class="gp_products_caption_rating star-rating">

                  <?php 



                  $user_id = $this->session->userdata('user_id');

                  $ad_id = $ad['id'];

                  $rating = get_post_rating_by_user($user_id,$ad_id);



                  for ($i = 1; $i < 6; $i++):



                    if($rating >= $i)



                    {

                  ?>

                <li><i class="fa fa-star f20" data-rating="<?= $i ?>" data-user="<?= $user_id ?>" data-post="<?= $ad_id ?>"></i></li>

                  <?php 

                    }

                    else

                    {

                  ?>

                  <li><i class="fa fa-star-o f20" data-rating="<?= $i ?>" data-user="<?= $user_id ?>" data-post="<?= $ad_id ?>"></i></li>

                  <?php

                    }

                    endfor;

                  ?>

                  <input type="hidden" name="" class="rating-value" value="<?= $rating ?>">

               </ul>

    <hr class="line-separator">

            <?php endif; ?>

       

          <ul>
             <li><a class="justify-content-between align-items-center d-flex"><h6>Ubicación:</h6> <span><?= $ad['location'] ?></span></a></li>
            


            <li><a class="justify-content-between align-items-center d-flex"><h6>Categoria:</h6> <span><?= $ad['category_name'] ?></span></a></li>

            

          <!-- <?php if($ad['subcategory_name']): ?>

            <li><a href="#" class="justify-content-between align-items-center d-flex"><h6>Sub Categoria:</h6> <span><?= $ad['subcategory_name'] ?></span></a></li>

            <?php endif; ?> -->



            <li><a class="justify-content-between align-items-center d-flex"><h6>Publicado:</h6> <span><?= date_time($ad['created_date']) ?></span></a></li>



           <li>

            <a class="justify-content-between align-items-center d-flex"><h6>Reputación:</h6>

             <ul class="gp_products_caption_rating">

                <?php 

                $rating = get_post_rating($ad['id']);



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

             </ul>

           </li>

          </ul>



         <p class="tags primary">

          

          <?php  

            $tags = explode(',', $ad['tags']);

            foreach($tags as $tag):

          ?>

            <a ><?= $tag ?></a>,

          <?php 

            endforeach;

          ?>

          </p> 
          
          </div>

        </div>                                    

      </div>



      <div class="col-lg-3 sidebar">

        <div class="item-widget">

          <h1><?= '<small>'.get_currency_symbol($this->general_settings['currency']).'</small>'.number_format($ad['price']) ?></h1>

          <p class="text-center"><?= (!empty($ad['negotiable'])) ? 'Negociable' : 'Precio' ?></p>  

        </div>

<div class="profile-widget">

          <h1>Vendedor</h1> 

          <hr class="line-separator">

          <img src="<?= base_url(get_user_profile_photo($ad['seller'])) ?>" alt="profile_widget_img">

          <h5><?= $ad['firstname'].' '.$ad['lastname'] ?></h5>

          <p>Desde: <?= date('d-m-Y',strtotime($ad['since'])) ?> </p>

          <br>

          <button hreftype="button" class="btn btn-primary btn-block btn-contact" data-contact="<?= $ad['contact'] ?>">Mostrar Número</button>

          <a href="<?= base_url('inbox/'.$ad['id'].'/'.$ad['slug']) ?>" class="btn btn-success btn-block">Enviar Mensaje</a>

        </div>

     



        



         <!-- Map 

        <div class="profile-widget h300px">

          <div id="map" class="h100p"></div>

        </div>-->



      </div>

    </div>

    <!-- row/ -->



    <?php if($similar_ads): ?>



    <h3>Anúncios Similares</h3>

    <div class="row d-flex justify-content-center">

      <div id="adv_gp_products_3_columns_carousel" class="carousel slide gp_products_carousel_wrapper swipe_x ps_easeOutCirc" data-ride="carousel" data-duration="2000" data-interval="5000" data-pause="hover" data-column="<?= count($similar_ads) ?>" data-m576="1" data-m768="1" data-m992="<?= count($similar_ads) ?>" data-m1200="<?= count($similar_ads) ?>">

        <!--========= Wrapper for slides =========-->

        <div class="carousel-inner" role="listbox">



          <?php

            $counter = 1;

            foreach ($similar_ads as $ad):

          ?>

          <!--========= 1st slide =========-->

          <div class="carousel-item <?= ($counter == 1) ? 'active' : '' ?>">

            <div class="row"> <!-- Row -->

            <div class="col gp_products_item">

              <div class="gp_products_inner">

                <div class="gp_products_item_image">

                  <a href="<?= base_url('ad/'.$ad['slug']) ?>">

                    <img src="<?= base_url($ad['img_1']) ?>" alt="" width="100%" height=""  />

                  </a>

                </div>

               
                <div class="gp_products_item_caption">

                  <ul class="gp_products_caption_name">

                    <li><a href="<?= base_url('ad/'.$ad['slug']) ?>"><?= $ad['title'] ?></a></li>

                    <li><small><?= date_time($ad['created_date']) ?></small><a href="<?= base_url('ad/'.$ad['slug']) ?>" class="pull-right"><small><?= get_currency_symbol($this->general_settings['currency']); ?></small><?= number_format($ad['price']) ?></a></li>
                  <li><small><?=($ad['location']) ?></small></li>
                   <ul class="gp_products_caption_rating mt-2">

                  <?php



                    $rating = get_post_rating($ad['id']);



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



                 <?php $favorite = is_favorite($ad['id'],$this->session->user_id); ?>



                  <li class="pull-right"><a href="javascript:void(0)" class="btn-favorite"><i class="fa <?= ($favorite) ? 'fa-heart' : 'fa-heart-o' ?> i-favorite" data-post="<?= $ad['id'] ?>"></i></a></li>



                </ul>


                  </ul>

                </div>

              </div>

            </div>

            </div>

          </div>



          <?php 

            $counter++; 

            endforeach; 

          ?>



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

    <!-- slider End -->



    <?php endif; ?>

  </div>  

</section>

<!-- End item detail Area -->


<script src="https://maps.googleapis.com/maps/api/js?key=<?= $this->general_settings['map_api_key'] ?>&libraries=places&callback=initMap" async defer></script>

<script>
(function($) {

  $(document).on('click','.btn-contact',function(){

    $this = $(this);

    $this.text($this.data('contact'));

    $this.removeClass('btn-contact');

  });
  
})(jQuery);
</script>



<script>

  var map;

      function initMap() {



        map = new google.maps.Map(document.getElementById('map'), {

          center: {lat: <?= $ad['lat'] ?>, lng: <?= $ad['lang'] ?>},

          zoom: 10

        });



        var marker = new google.maps.Marker({

          position: {lat: <?= $ad['lat'] ?>, lng: <?= $ad['lang'] ?>},

          map: map

        });

      }

</script>