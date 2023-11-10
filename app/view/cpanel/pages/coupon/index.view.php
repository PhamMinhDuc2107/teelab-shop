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
  <thead class="text-white table-primary">
    <tr>
      <th class="col-1">id</th>
      <th class="col-2">Code</th>
      <th class="col-2">Discount Amounts</th>
      <th class="col-1">Quantity</th>
      <th class="col-2">Time start</th>
      <th class="col-2">Time end</th>
      <th class="col-2">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if($data['data']) :?>
      <?php foreach($data["data"] as $item) : ?>
        <tr>
          <th class="col-1"><?php echo $item->id ?></th>
          <td class="col-2"><?php echo $item->code ?></td>
          <td class="col-2"><?php echo number_format($item->discount_amount )?></td>
          <td class="col-2"><?php echo $item->quantity ?></td>
          <td class="col-2"><?php echo $item->start ?></td>
          <td class="col-2"><?php echo $item->end ?></td>
          <td class="col-2">
            <div class="d-flex justify-content-center align-items-center">
              <a href="<?php echo ROOT.'coupon/edit_coupon/'.$item->id ?>"  class="d-block text-primary btn-edit-category">
                <i class="inline-block px-2 fa-regular fa-pen-to-square"></i>
              </a>
              <a href="<?php echo ROOT.'coupon/delete_coupon/'.$item->id ?>" class="d-block text-danger btn-delete-category" onClick="alert('Delete Category!')">
                <i class="inline-block px-2 fa-solid fa-trash"></i>
              </a>
            </div>
          </td>
        </tr>
      <?php endforeach;  ?>
    <?php endif; ?>
  </tbody>
</table>