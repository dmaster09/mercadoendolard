<!-- start banner Area -->
<section class="banner-area relative" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          Edita tu Anuncios
        </h1> 
        <p class="text-white link-nav">
          <a href="<?= base_url('profile/ads') ?>">Anuncios </a> <span class="lnr lnr-arrow-right"></span> <a href=""> Editar</a>
        </p>
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->  

<!-- Start Add Job Detail Area -->
<section class="error_area section-full">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="add_job_content col-12">

        <?php $this->load->view('themes/_messages'); ?>

        <?php 
          $attributes = array('method' => 'post','class' => 'jsform'); 
          echo form_open_multipart('seller/ads/edit/'.$post['id'],$attributes); 
        ?>

        <div class="row">
          <div class="col-md-6">
            <div class="headline">
              <h3><i class="fa fa-info"></i> Detalles del Anuncio</h3>
            </div>

            <div class="add_job_detail">
              
              <div class="row">
                <div class="col-md-12">
                  <div class="submit-field">
                    <h5>Categoria *</h5>
                    
                    <?php

                      $where = array('status' => 1);
                      $rows = get_records_where('ci_categories',$where);
                      $options = array('' => 'Selecciona una Opción') + array_column($rows,'name','id');
                      echo form_dropdown('category',$options,$post['category'],'class="select2 form-control category" required');
                    
                    ?>
                  </div>
                </div>
              </div>

              <?php if($post['subcategory']): ?>
              <div class="row">
                <div class="col-md-12 subcategory-wrapper">
                  <div class="submit-field">
                    <h5>Sub Categoria *</h5>
                    <div class="subcategory">
                      <?php

                      $where = array('status' => 1,'parent' => $post['category']);
                      $rows = get_records_where('ci_subcategories',$where);
                      $options = array('' => 'Selecciona una Opción') + array_column($rows,'name','id');
                      echo form_dropdown('subcategory',$options,$post['subcategory'],'class="select2 form-control select-subcategory" required');
                    
                    ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php endif; ?>

              <span class="custom-field-wrapper">
                <?php  
                  if(!empty($post['subcategory']))
                    echo $this->fields->subcategory_fields_by_ad_id($post['subcategory'],$post['id']);
                  else
                    echo $this->fields->category_fields_by_ad_id($post['category'],$post['id']);
                ?>
              </span>

              <div class="row">
                <div class="col-md-12">
                  <div class="submit-field">
                    <h5>Titulo *</h5>
                    <input class="form-control" type="text" name="title" placeholder="Titulo del Anuncio" value="<?= $post['title'] ?>" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="submit-field">
                    <h5>Precio *</h5>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="input-group">
                          <div class="input-group-append">
                            <span class="input-group-text"><?= get_currency_symbol($this->general_settings['currency']) ?></span>
                          </div>
                          <input type="text" class="form-control" name="price" placeholder="Precio" required value="<?= $post['price'] ?>">
                          <div class="input-group-append">
                            <span class="input-group-text">
                              <input type="checkbox" name="negotiable" value="1" <?= ($post['negotiable'] == '1') ? 'checked' : '' ?>> Negociable
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          <!--   <div class="row">
                <div class="col-md-12">
                  <div class="submit-field">
                    <h5>Tags <small>(opcional)</small></h5>
                    <input class="form-control" name="tags" type="text" placeholder="e.g. best car, grocery item in LA" value="<?= $post['tags'] ?>">
                    <small class="form-text text-muted">Minimo 3 Caracteres</small>
                  </div>
                </div>
              </div> -->

              <div class="row">
                <div class="col-md-12">
                  <div class="submit-field">
                    <h5>Descripción</h5>
                    <textarea class="form-control" rows="5" name="description"><?= $post['description'] ?></textarea>
                    <small class="form-text text-muted">Minimo 20 Caracteres</small>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- photo section -->
          <div class="col-md-6">  
            <div class="headline">
              <h3><i class="fa fa-camera"></i> Fotos</h3>
            </div>

            <div class="add_job_detail col-12">
              <small id="fileHelp" class="form-text text-muted">Usa imágenes que describan correctamente el anuncio</small>
             <small>Tamaño mínimo 360 x 220</small><br/>
              <div class="row">
                <div class="col-md-12">
                  <div class="submit-field"> 
                    <?php $img_1 = ($post['img_1']) ? $post['img_1'] : 'assets/img/default-img.jpg';  ?>
                    <div class="item__img__div">
                      <label  for="item_img_1" id="item_img_label_1" class="thumbnail_label">
                      <img src="<?= base_url($img_1) ?>" id="thumbnail_img_1" class="thumbnail_img" width="150">
                      <input type="file" name="img_1" id="item_img_1" class="hidden images" onchange="readURL(this,1)" accept="image/*">
                      </label>
                      <input type="hidden" name="old_img_1" value="<?= $post['img_1'] ?>">
                    </div>

                    <small>Mas imagenes:</small><br>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="submit-field"> 
                    <?php $img_2 = ($post['img_2']) ? $post['img_2'] : 'assets/img/default-img.jpg';  ?>
                    <div class="item__img__div">
                      <label  for="item_img_2" id="item_img_label_1" class="thumbnail_label">
                      <img src="<?= base_url($img_2) ?>" id="thumbnail_img_2" class="thumbnail_img" width="150">
                      <input type="file" name="img_2" id="item_img_2" class="hidden images" onchange="readURL(this,2)" accept="image/*">
                      </label>
                      <input type="hidden" name="old_img_2" value="<?= $post['img_2'] ?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="submit-field"> 
                    <?php $img_3 = ($post['img_3']) ? $post['img_3'] : 'assets/img/default-img.jpg';  ?>
                    <div class="item__img__div">
                      <label  for="item_img_3" id="item_img_label_1" class="thumbnail_label">
                      <img src="<?= base_url($img_3) ?>" id="thumbnail_img_3" class="thumbnail_img" width="150">
                      <input type="file" name="img_3" id="item_img_3" class="hidden images" onchange="readURL(this,3)" accept="image/*">
                      </label>
                      <input type="hidden" name="old_img_3" value="<?= $post['img_3'] ?>">
                    </div>
                  </div>
                </div>
               <div class="col-md-6">
                  <div class="submit-field"> 
                    <?php $img_4 = ($post['img_4']) ? $post['img_4'] : 'assets/img/default-img.jpg';  ?>
                    <div class="item__img__div">
                      <label  for="item_img_4" id="item_img_label_1" class="thumbnail_label">
                      <img src="<?= base_url($img_4) ?>" id="thumbnail_img_4" class="thumbnail_img" width="150">
                      <input type="file" name="img_4" id="item_img_4" class="hidden images" onchange="readURL(this,4)" accept="image/*">
                      </label>
                      <input type="hidden" name="old_img_4" value="<?= $post['img_4'] ?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="submit-field"> 
                    <?php $img_5 = ($post['img_5']) ? $post['img_5'] : 'assets/img/default-img.jpg';  ?>
                    <div class="item__img__div">
                      <label  for="item_img_5" id="item_img_label_1" class="thumbnail_label">
                      <img src="<?= base_url($img_5) ?>" id="thumbnail_img_5" class="thumbnail_img" width="150">
                      <input type="file" name="img_5" id="item_img_5" class="hidden images" onchange="readURL(this,5)" accept="image/*">
                      </label>
                      <input type="hidden" name="old_img_5" value="<?= $post['img_5'] ?>">
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
        </div>
        <!-- /row -->

        

        <!-- Location -->
        <div class="col-md-12">
          <div class="headline">
            <h3><i class="fa fa-map-marker"></i> Ubicación</h3>
            <small id="fileHelp" class="form-text text-muted">Agrega una Ubicación</small>
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-6 order-md-6 add_job_detail">
              <div class="row">
                <div class="col-md-12">
                  <div class="submit-field">
                    <h5>Pais *</h5>
                    <?php 
                      $options = array('' => 'Selecciona el Pais') + array_column($countries,'name','id');
                      echo form_dropdown('country',$options,$post['country'],'class="select2 form-control country" required');
                    ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="submit-field">

                    <h5>Estado *</h5>
                   
                    <?php 
                      $where = array('country_id' => $post['country']);
                      $rows = get_records_where('ci_states',$where);
                      $options = array('' => 'Selecciona el Estado') + array_column($rows,'name','id');
                      echo form_dropdown('state',$options,$post['state'],'class="select2 form-control state" required');
                    ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="submit-field">
                    <h5>Ciudad *</h5>
                    <?php 
                      $where = array('state_id' => $post['state']);
                      $rows = get_records_where('ci_cities',$where);
                      $options = array('' => 'Selecciona una Ciudad') + array_column($rows,'name','id');
                      echo form_dropdown('city',$options,$post['city'],'class="select2 form-control city" required');
                    ?>
                  </div>
                </div>
              </div>

              <div class="row address-wrapper">
                <div class="col-md-12">
                  <div class="submit-field">
                    <h5>Dirección (Opcional)</h5>
                    <input type="text" name="address" class="form-control" id="autocomplete" placeholder="Ej. Calle con Av. o Sector..." value="<?= $post['location'] ?>" >
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-6 order-md-6 pt-5">
              <div id="map" class="h100p-w95p"></div>
              <input type="hidden" name="address-lang" id="address-lang" class="address-lang" value="-66.8828408">
              <input type="hidden" name="address-lat" id="address-lat" class="address-lat" value="10.4954305">
            </div>
          </div>
        

 <!-- payments -->
  <div class="col-md-12">
    <div class="headline">
      <h3><i class="fa fa-dollar"></i> Tipo de Anuncio</h3>
      <small id="fileHelp" class="form-text text-muted">Puedes usar anuncios de pago para llegar a más personas</small>
    </div>

    <div class="add_job_detail col-12">
      <h5>Paquete Según exposición *</h5>
      <a  href="void:javascript(0)" class="btn btn-xs btn-success pull-right pack_return">Renovar / Cambiar</a>
      <br>
      <br>
       <input type="hidden" name="accion_pack" id="accion_pack" value="false">
          <div class="alert alert-success alert-dismissable">
            <!--     <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> -->
                
                    <i class="icon fa fa-info-circle"></i>
                    Estimado Usuario Usted esta Suscrito al Paquete :
                    <?php foreach($packages as $pack): 
                      if($pack['id']==$post['package']){
                        echo '<b>'.$pack['title'].'</b>';
                      }
                     
                     endforeach; ?>
                     que tiene Fecha de Expiración el dia : <b><?= date_time($post['expiry_date']); ?></b>
                     para Renovar o Cambiar seleccione Renovar
                
            </div>
        
        </div>
       <div class="m-b-15 class-package hidden">

      <?php foreach($packages as $pack): ?>
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <div class="submit-field">
              <label class="form-label">
                <input type="radio" class="form package-radio" name="package" value="<?= $pack['id'] ?>" data-price="<?= $pack['price'] ?>" <?=$pack['id']==$post['package']?"checked":"";?>>
                <?= $pack['title'] ?>
              </label>
            </div>
          </div>
          <div class="col-md-6 col-sm-6">
            <div class="submit-field">
              <?php $price = (!$pack['price']) ? '' : get_currency_symbol($this->general_settings['currency']).$pack['price']; ?>
              <?= $price ?> Por <?= $pack['no_of_days'] ?> Dias de Exposición
            </div>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="row payment-method-wrapper hidden">
        <div class="col-md-12">
          <div class="submit-field">
            <h5>Metodo de Pago *</h5>
            <select class="form-control payment-method" name="payment_method" >
              <option value="">Seleccione una Opción</option>
              <?php 
                  if($this->general_settings['paypal_status'] == 1) 
                  echo '<option value="1">Paypal</option>';
                  // if($this->general_settings['stripe_status'] == 1)
                  // echo '<option value="2">Stripe</option>';
                ?>
            </select>
          </div>
        </div>
      </div>
      </div>

         <?php 
            if($this->general_settings['stripe_status'] == 1):
          ?>
      <!-- stripe -->
      <div class="stripe hidden">
        <img src="<?= base_url('assets/img/stripe.png') ?>" width="200">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="username">Nombre Completo (Igual al de la tarjeta) *</label>
              <input type="text" name="name" placeholder="Jason Doe"  class="form-control">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="email">Correo *</label>
              <input type="email" name="email" id="email"  placeholder="test@example.com"  class="form-control">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="cardNumber">Numero de Tarjeta *</label>
              <div class="input-group">
                <input type="text" name="card-number" id="card-number" autocomplete="off" placeholder="Your card number" class="form-control" >
                <div class="input-group-append">
                  <span class="input-group-text text-muted">
                    <i class="fa fa-cc-visa mx-1"></i>
                    <i class="fa fa-cc-amex mx-1"></i>
                    <i class="fa fa-cc-mastercard mx-1"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label><span class="hidden-xs">Expiratición *</span></label>
              <div class="input-group">
                <input type="number" placeholder="MM" maxlength="2" name="card-expiry-month" id="card-expiry-month" class="form-control" >
                <input type="number" placeholder="YY" maxlength="4" name="card-expiry-year" id="card-expiry-year" class="form-control" >
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group mb-4">
              <label data-toggle="tooltip" title="3 digitos al reverso de su tarjeta">CVV *
                <i class="fa fa-question-circle"></i>
              </label>
              <input type="text" name="card-cvc" id="card-cvc" placeholder="CVV"  class="form-control">
            </div>
          </div>
        </div>
      </div>
      <!-- /Stripe -->

        <?php   
            endif;
            if($this->general_settings['paypal_status'] == 1):
          ?>

          <!-- Paypal -->
          <div class="paypal hidden">
            <img src="<?= base_url('assets/img/paypal.png') ?>" width="200">
          </div>
          <!-- /Paypal -->

          <?php  endif;   ?>
        
    </div>
  </div>     

        <!--  -->
        <div class="col-md-12">
          <div class="add_job_btn col-12 mt-5">
            <div class="submit-field">
               <input type="submit" class="job_detail_btn" value="Guardar Cambios" name="submit">
            </div>
          </div>
        </div>
      </div>
        <?php echo form_close(); ?>

      </div>
    </div>
  </div>  
</section>
<!-- End Add Job Detail Area -->
<script>
function readURL(input,i) {

  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {

    $('#thumbnail_img_'+i).attr('src', e.target.result);

    $('#item_img_label_'+i).after('<i class="cross-cons-img ficon ft-trash"></i>');

    }

    reader.readAsDataURL(input.files[0]);
  }
}

var hoy             = new Date();
var fechaFormulario = new Date("<?=$post['expiry_date'];?>");

// Compara solo las fechas => no las horas!!
hoy.setHours(0,0,0,0);

if (hoy <= fechaFormulario) {
  

}
else {
 $('.pack_return').addClass('hidden');
 $('.alert-success').addClass('hidden');
 $('.class-package').removeClass('hidden');
  $('#accion_pack').val("true");
}

$(document).on('click','.package-radio',function(){
    price = $(this).data('price');
    if (parseInt(price) > 0) {
      $('.payment-method-wrapper').removeClass('hidden');
    }
    else{
      $('.payment-method').val('');
      $('.payment-method-wrapper').addClass('hidden');
      $('.stripe').addClass('hidden');
      $('.paypal').addClass('hidden');
    }
  });

$(document).on('click','.pack_return',function(){
  if($('#accion_pack').val()=="true"){
    var pack="<?=$post['package'];?>";
   $('#accion_pack').val("false");
   $('.class-package').addClass('hidden');
   $('.pack_return').text("Renovar / Cambiar");
   $(".package-radio").each(function(){
   //  alert($(this).val())
    if($(this).val()==pack){
    $(this).prop('checked', false);
     }else{
       $(this).prop('checked', false);
     }
   });
  // $(".package-radio").val("<?=$post['package'];?>")

   $(".payment-method").val("");
   $('.payment-method-wrapper').addClass('hidden');

  }else{
    $('#accion_pack').val("true");
    $('.class-package').removeClass('hidden');
    $('.pack_return').text("Cancelar");

    $(".package-radio").each(function(){
   //  alert($(this).val())
    if($(this).val()==pack){
    $(this).prop('checked', false);
     }else{
       $(this).prop('checked', false);
     }
   });

  }
});

</script>
<!-- GEO Location -->
