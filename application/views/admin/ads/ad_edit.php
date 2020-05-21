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

	          &nbsp; Edit Post </h3>

	      </div>

	      <div class="d-inline-block float-right">

	        <a href="<?= base_url('admin/posts'); ?>" class="btn btn-success pull-right"><span class="fa fa-list"></span> View Post List</a>

	      </div>

	    </div>

		<div class="card-body">

			<div class="row">

				<?php $attributes = array('method' => 'post');

				echo form_open_multipart('admin/ads/edit/'.$ad_detail['id'],$attributes);

				?>

				<div class="add_post_content col-lg-12">

					<div class="add_post_detail">

						<div class="row">



							<div class="col-md-12">

								<div class="form-group">

									<h5>Category*</h5>

									<?php 

										$options = array('' => 'Select Option') + array_column($categories, 'name','id');

										echo form_dropdown('category',$options,$ad_detail['category'],'class="form-control select2 admin-category"');

									?>

								</div>

							</div>



							<div class="col-md-12 col-sm-12 admin-subcategory-wrapper">

				              <div class="form-group">

				                <h5>Sub Category *</h5>

				                <div class="admin-subcategory">

				                	<?php

				                	$where = array('status' => 1,'parent' => $ad_detail['category']);

					                $rows = get_records_where('ci_subcategories',$where);

					                $options = array('' => 'Select an Option') + array_column($rows,'name','id');

					                echo form_dropdown('subcategory',$options,$ad_detail['subcategory'],'class="select2 form-control select-subcategory" required');

					                ?>

				                </div>

				              </div>

				            </div>



				        </div>

				            <span class="custom-field-wrapper">

					            <?php  

					              if(!empty($ad_detail['subcategory']))

					                echo $this->fields->subcategory_fields_by_ad_id($ad_detail['subcategory'],$ad_detail['id'],'admin');

					              else

					                echo $this->fields->category_fields_by_ad_id($ad_detail['category'],$ad_detail['id'],'admin');

					            ?>

				          	</span>

				        <div class="row">

							<div class="col-md-12">

								<div class="form-group">

									<h5>Title*</h5>

									<input type="text" name="title" class="form-control" value="<?= $ad_detail['title'] ?>" required>

								</div>

							</div>



							<div class="col-md-12">

								<div class="form-group">

									<h5>Price*</h5>

									<input type="text" name="price" class="form-control" value="<?= $ad_detail['price'] ?>" required="">

								</div>

							</div>



							<div class="col-md-12">

								<div class="form-group">

									<h5>Tags</h5>

									<input type="text" name="tags" class="form-control" value="<?= $ad_detail['tags'] ?>">

								</div>

							</div>



							<div class="col-md-12">

								<div class="form-group">

									<h5>Description</h5>

									<textarea name="description" class="form-control"><?= $ad_detail['description'] ?></textarea>

								</div>

							</div>



							<div class="col-md-12">

								<div class="form-group">

									<h5>Photos*</h5>

									<div class="row">

							            <div class="col-md-2 col-sm-2">

							              <div class="form-group"> 

							                <?php $img_1 = ($ad_detail['img_1']) ? $ad_detail['img_1'] : 'assets/img/default-img.jpg';  ?>

							                <div class="item__img__div">

							                  <label  for="item_img_1" id="item_img_label_1" class="thumbnail_label">

							                  <img src="<?= base_url($img_1) ?>" id="thumbnail_img_1" class="thumbnail_img" width="150">

							                  <input type="file" name="img_1" id="item_img_1" class="hidden images" onchange="readURL(this,1)" accept="image/*">

							                  </label>

							                  <input type="hidden" name="old_img_1" value="<?= $ad_detail['img_1'] ?>">

							                </div>



							                <small>Thumbnail Image</small>

							              </div>

							            </div>

							            <div class="col-md-2 col-sm-2">

							              <div class="form-group"> 

							                <?php $img_2 = ($ad_detail['img_2']) ? $ad_detail['img_2'] : 'assets/img/default-img.jpg';  ?>

							                <div class="item__img__div">

							                  <label  for="item_img_2" id="item_img_label_1" class="thumbnail_label">

							                  <img src="<?= base_url($img_2) ?>" id="thumbnail_img_2" class="thumbnail_img" width="150">

							                  <input type="file" name="img_2" id="item_img_2" class="hidden images" onchange="readURL(this,2)" accept="image/*">

							                  </label>

							                  <input type="hidden" name="old_img_2" value="<?= $ad_detail['img_2'] ?>">

							                </div>



							              </div>

							            </div>

							            <div class="col-md-2 col-sm-2">

							              <div class="form-group"> 

							                <?php $img_3 = ($ad_detail['img_3']) ? $ad_detail['img_3'] : 'assets/img/default-img.jpg';  ?>

							                <div class="item__img__div">

							                  <label  for="item_img_3" id="item_img_label_1" class="thumbnail_label">

							                  <img src="<?= base_url($img_3) ?>" id="thumbnail_img_3" class="thumbnail_img" width="150">

							                  <input type="file" name="img_3" id="item_img_3" class="hidden images" onchange="readURL(this,3)" accept="image/*">

							                  </label>

							                  <input type="hidden" name="old_img_3" value="<?= $ad_detail['img_3'] ?>">

							                </div>



							              </div>

							            </div>

							          </div>

								</div>

							</div>

						</div>



						<!-- Location -->

						<div class="row">

				            <div class="col-md-12 col-sm-12">

				              <div class="form-group">

				                <h5>Country *</h5>

				                <?php 

				                  $options = array('' => 'Select Country') + array_column($countries,'name','id');

				                  echo form_dropdown('country',$options,$ad_detail['country'],'class="select2 form-control country" required');

				                ?>

				              </div>

				            </div>



				            <div class="col-md-12 col-sm-12">



				                <div class="form-group">



				                  <h5>State *</h5>



				                  <?php 

				                    $where = array('country_id' => $ad_detail['country']);

				                    $rows = get_records_where('ci_states',$where);

				                    $options = array('' => 'Select State') + array_column($rows,'name','id');

				                    echo form_dropdown('state',$options,$ad_detail['state'],'class="select2 form-control state" required');

				                  ?>



				                </div>

				            </div>



				            <div class="col-md-12 col-sm-12">

				              <div class="form-group">

				                <h5>City *</h5>

				                <?php 

				                  $where = array('state_id' => $ad_detail['state']);

				                  $rows = get_records_where('ci_cities',$where);

				                  $options = array('' => 'Select City') + array_column($rows,'name','id');

				                  echo form_dropdown('city',$options,$ad_detail['city'],'class="select2 form-control city" required');

				                ?>

				              </div>

				            </div>



				            <div class="col-md-12 col-sm-12">

				              <div class="form-group">

				                <h5>Street Address *</h5>

				                <input type="text" name="address" class="form-control" id="autocomplete-o" placeholder="Enter Street Address" value="<?= $ad_detail['location'] ?>" required>

				              </div>

				            </div>

				        </div>

				        <!-- /location -->



				        <!-- status -->

				        <div class="row">

				            <div class="col-md-12 col-sm-12">

				              <div class="form-group">

				                <h5>Status *</h5>

				                <?php 

				                  $options = array('0' => 'Inactive','1' => 'Active','Expired');

				                  echo form_dropdown('is_status',$options,$ad_detail['is_status'],'class="select2 form-control" required');

				                ?>

				              </div>

				            </div>

				        </div>

				        <!-- /status -->



					</div>

				</div>

				<div class="add_job_btn col-lg-12 mt-3">

					<div class="form-group">

						<input type="hidden" name="seller" value="<?= $ad_detail['seller'] ?>">

						<input type="hidden" name="old_status" value="<?= $ad_detail['is_status'] ?>">

						<input type="submit" class="btn btn-primary pull-right" name="edit_ad" value="Update">

					</div>

				</div>

				<?php echo form_close(); ?>

			</div>

		</div>

	</div>

</section>

</div>



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

</script>

