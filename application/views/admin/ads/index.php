<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card card-default color-palette-bo">
      <div class="card-header">
        <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-edit"></i>
            &nbsp; Manage Ads </h3>
        </div>
      </div>

      <div class="card-body">
        <?php echo form_open("/",'class="filterdata"') ?> 
          <div class="row">
            <div class="col-2">
              <label>Category:</label>
              <select onchange="filter_data()" name="ad_search_category"  class="form-control select2 admin-category">
                <option value=""> --Select--</option>
                <?php   foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?> </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-2 admin-subcategory-wrapper">
              <label>Sub Category:</label>
              <span class="admin-subcategory">
              <select onchange="filter_data()" name="subcategory"  class="form-control select2">
                <option value=""> --Select--</option>
              </select>
              </span>
            </div>
            <div class="col-2">
              <label>Packages:</label>
              <select onchange="filter_data()" name="ad_search_package"  class="form-control select2">
                <option value=""> --Select--</option>
                <?php   foreach ($packages as $package): ?>
                <option value="<?php echo $package['id']; ?>"> <?php echo $package['title']; ?> </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-2">
              <label>Status:</label>
              <select onchange="filter_data()" name="ad_search_status"  class="form-control select2">
                <option value=""> --Select--</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
                <option value="2">Expired</option>
              </select>
            </div>
            <div class="col-2">
              <label>Date From:</label>
              <input name="ad_search_from" type="text" class="form-control form-control-inline input-medium datepicker" />
            </div>
            <div class="col-2">
              <label>Date To:</label>
              <input name="ad_search_to" type="text" class="form-control form-control-inline input-medium datepicker" />
            </div>
            <div class="col-2 text-right">
              <button type="button" onclick="filter_data()" class="btn btn-success mg-t-20">Submit</button>
              <a href="<?= base_url('admin/ads'); ?>" class="btn btn-danger mg-t-20" >
                <i class="fa fa-repeat"></i>
              </a>
            </div>
          </div>
        <?php echo form_close(); ?>
        <hr>
        <!-- Load Admin list (json request)-->
        <div class="data_container"></div>
      </div>

    </div>
    <!-- /card -->
  </section>
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

//------------------------------------------------------------------
function filter_data()
{
$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/admin/dist/img')?>/loading.png"/></div>');
$.post('<?=base_url('admin/ads/search')?>',$('.filterdata').serialize(),function(){
  $('.data_container').load('<?=base_url('admin/ads/ad_list')?>');
});
}
//------------------------------------------------------------------
function load_records()
{
$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/admin/dist/img')?>/loading.png"/></div>');
$('.data_container').load('<?=base_url('admin/ads/ad_list')?>');
}
load_records();
</script>

<script>
  $('#ads').addClass('active');
</script>