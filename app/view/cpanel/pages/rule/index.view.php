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
      <th class="col-1">Id</th>
      <th class="col-6">Name</th>
      <th class="col-3">Url</th>
      <th class="col-2">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if($data['data']) :?>
      <?php foreach($data["data"] as $item) : ?>
        <tr>
          <th class="col-1"><?php echo $item->id ?></th>
          <td class="col-6"><?php echo $item->name ?></td>
          <td class="col-3"><?php echo $item->url ?></td>
          <td class="col-2">
            <div class="d-flex justify-content-center align-items-center">
              <a href="<?php echo ROOT.'admin/edit_rule/'.$item->id ?>"  class="d-block text-primary btn-edit-category">
                <i class="fa-regular fa-pen-to-square inline-block px-2"></i>
              </a>
              <a href="<?php echo ROOT.'admin/delete_rule/'.$item->id ?>" class="d-block text-danger btn-delete-category" onClick="alert('Delete Rule!')">
                <i class="fa-solid fa-trash inline-block px-2"></i>
              </a>
            </div>
          </td>
        </tr>
      <?php endforeach;  ?>
    <?php endif; ?>
  </tbody>
</table>