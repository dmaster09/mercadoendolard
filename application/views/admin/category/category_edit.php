<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card card-default">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"> <i class="fa fa-list"></i>&nbsp; Edit Category </h3>
        </div>
        <div class="d-inline-block pull-right">
          <a href="<?= base_url('admin/category'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Category List</a>
          <a href="<?= base_url('admin/category/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New category</a>
        </div>
      </div>

      <div class="card-body">
        <?php echo form_open_multipart(base_url('admin/category/edit/'.$category['id']), 'class="form-horizontal jsform"' )?>
          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-12">
              <input type="text" name="category" class="form-control" id="category" placeholder="Name" value="<?= $category['name'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-12">
              <textarea name="description" class="form-control" placeholder="Description"><?= $category['description'] ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Picture</label>
            <div class="col-sm-12">
              <input type="file" class="form-control" name="picture">
              <input type="hidden" name="old_picture" value="<?= $category['picture'] ?>">
              <br>
              <p>Used in the categories area on the homepage (Related to the type of display: "Picture as Icon").</p>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Active</label>
            <div class="col-sm-12">
              <input type="checkbox" name="active" <?= ($category['status']) ? 'checked' : '' ?>>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Show on Home Page</label>

            <div class="col-sm-12">
              <input type="checkbox" name="home_page" <?= ($category['show_on_home']) ? 'checked' : '' ?>>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Update Category" class="btn btn-primary pull-right">
            </div>
          </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </section>
</div>
<script>
  $("#category").addClass('active');
</script>
