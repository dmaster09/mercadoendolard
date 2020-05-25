
<?php 
  $attributes = array('method' => 'get','class' => 'filterForm filter-form'); 
  echo form_open(base_url('ads'),$attributes);

?>

<!-- Type -->
<div class="single-slidebar">
  <h4>Ordenar por</h4>
   <div class="row">
    <div class="col-12 form-group">
      <select name="ad_type" class="form-control filter-ad_type">
         <option value="" selected="">Seleccione</option>
        <option value="MNP">Menor precio</option>
        <option value="MYP">Mayor precio</option>
        <option value="MA">Mas antiguos</option>
        <option value="RT">Mas recientes</option>
        <option value="1">Destacados</option>
        <option value="2">Hot</option>
      </select>
    </div>
  </div>
</div> 
<!-- Locations -->

<div class="single-slidebar">
  <h4>Ubicación</h4>

  <div class="row">
    <div class="col-12 form-group">
      <select class="filter-country form-control" name="country">
        <option value="">País</option>
        <?php foreach($countries as $country):?>
          <option value="<?= $country['id']?>" <?=$country['id']==7?"selected":"";?> ><?= $country['name']?></option>
        <?php endforeach; ?>       
      </select>
    </div>
  </div>


  <div class="row">
    <div class="col-12 form-group filter-state-wrapper">
      <select class="filter-state form-control" name="Estado">
        <option value="">Estado</option>
      </select>
    </div>
  </div>

  <div class="row">
    <div class="col-12 form-group filter-city-wrapper">
      <select class="filter-city form-control" name="Ciudad" >
        <option value="">Ciudad</option>
      </select>
    </div>
  </div>

</div>


<!-- Category & sub Category & fields-->
<div class="single-slidebar">
  <h4>Categoria </h4>
  <!--  -->

  <div class="row">
    <div class="col-12 form-group">
      <?php
        $where = array('status' => 1);
        $rows = get_records_where('ci_categories',$where);
        $options = array('' => trans('all_categories')) + array_column($rows,'name','id');
        $category=(isset($_GET['category'])) ? $_GET['category'] : '';
        echo form_dropdown('category',$options,$category,'class="filter-category form-control"');

      ?>
    </div>
  </div>

    <div class="filter-subcategory-wrapper hidden"></div>
    <div class="filter-custom-field-wrapper hidden"></div>
</div>

<!-- Price -->
<div class="single-slidebar">
  <h4>Precio</h4>
  <div class="row">
    <div class="col-12">
      <p>
        <label for="amount">Rango de Precios:</label>
        <input type="text" id="amount" class="price-range" readonly>
      </p>
      <div id="slider-range"></div>
    </div>

    <input type="hidden" name="price-min" class="form-control" value="">
    <input type="hidden" name="price-max" class="form-control" value="">
    
  </div>
</div>

<!-- Keyward 
<div class="single-slidebar">
  <h4>Palabra Clave</h4>
  <div class="row">
    <div class="col-12 ">
      <input type="text" name="q" class="form-control" placeholder="Enter Keyword" value="<?= (isset($_GET['q'])) ? $_GET['q'] : '' ?>">
    </div>
  </div>
</div> -->


<!-- Button -->
<div class="single-slidebar">
  <div class="row">
    <button type="button" class="btn btn-success full-width filter-submit">Filtrar Búsqueda</button>
  </div>
</div>

<?php echo form_close(); ?>