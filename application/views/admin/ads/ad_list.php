<div class="adv-table table-responsive">

  <table id="example1" class="table table-bordered table-hover">

    <thead>

      <tr>

        <th>#</th>

        <th>Title</th>

        <th>Category</th>

        <th>Sub Category</th>

        <th>Price</th>

        <th>Status</th>

        <th width="100" class="text-right">Action</th>

      </tr>

    </thead>

    <tbody>

        <?php $counter = 1;
          foreach($ads as $record): 

            $status = ($record['is_status'] == 1)? 'checked': '';

        ?>

        <tr>

          <td><?= $counter; ?></td>

          <td><?= $record['title']; ?></td>

          <td><?= $record['category_name']; ?></td>

          <td><?= $record['subcategory_name']; ?></td>

          <td><?= number_format($record['price']) ?></td>

          <td>

            <span class="btn btn-success btn-sm">

              <?php if($record['is_status'] == 0)  echo 'Inactive'; ?>

              <?php if($record['is_status'] == 1) echo 'Active'; ?>

              <?php if($record['is_status'] == 2) echo 'Expired'; ?>

            </span>

          </td>

          <td>

            <a class="btn btn-sm btn-success" href="<?= base_url("admin/ads/edit/".$record['id'])?>" title="View" > 

           <i class="fa fa-eye"></i></a>&nbsp;&nbsp;



            <a class="edit btn btn-sm btn-warning" href="<?= base_url("admin/ads/edit/".$record['id']) ?>" title="Edit" > 

           <i class="fa fa-edit"></i></a>&nbsp;&nbsp;



           <a class="btn btn-sm btn-danger btn-delete" href="<?= base_url("admin/ads/del/".$record['id']) ?>" title="Delete"> 

           <i class="fa fa-remove"></i></a>

          </td>

        </tr>

      <?php $counter++; endforeach; ?>

    </tbody>

  </table>

</div>



<script>

  $(function () {

    $("#example1").DataTable();

  });

</script>