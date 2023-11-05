<?php 
if(!empty($_GET['msg']))
{
  $msg = unserialize(urldecode($_GET['msg']));
  foreach($msg as $key => $value) 
  {
    echo "<span style='color:blue;font-wright: bold; font-size: 15px;margin-bottom: 10px;display: inline-block'>$value</span>";
  }
} 
?>
<table class="table table-bordered">
  <thead class="table-primary text-white">
    <tr>
      <th class="col-1">id</th>
      <th class="col-2">Image</th>
      <th class="col-2">Name</th>
      <th class="col-2">Price</th>
      <th class="col-1">Discount</th>
      <th class="col-1">Quantity</th>
      <th class="col-1">Category</th>
      <th class="col-2">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if($data['data']) :?>
      <?php foreach($data["data"] as $item) : ?>
        <tr>
          <th class="col-1"><?php echo $item->id ?></th>
          <td class="col-3"><img src="<?php echo ROOT."assets/uploads/product/".$item->img ?>" alt=""></td>
          <td class="col-4"><?php echo $item->name ?></td>
          <td class="col-3"><?php echo $item->price ?></td>
          <td class="col-3"><?php echo $item->discount ?></td>
          <td class="col-3"><?php echo $item->quantity ?></td>
          <td class="col-3"><?php echo $item->title ?></td>
        </td>
        <td class="col-2">
          <div class="d-flex justify-content-center align-items-center">
            <a href="<?php echo ROOT.'categories/edit_category/'.$item->id ?>"  class="d-block text-primary btn-edit-category">
              <i class="fa-regular fa-pen-to-square inline-block px-2"></i>
            </a>
            <a href="<?php echo ROOT.'categories/delete_category/'.$item->id ?>" class="d-block text-danger btn-delete-category" onClick="alert('Delete Category!')">
              <i class="fa-solid fa-trash inline-block px-2"></i>
            </a>
          </div>
        </td>
      </tr>
    <?php endforeach;  ?>
  <?php endif; ?>
</tbody>
</table>