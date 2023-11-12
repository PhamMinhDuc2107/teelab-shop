<?php $rules = isset($data['data']) ? $data['data'] : "" ?>
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
<div class="mb-3"><a href="<?php echo ROOT.'admin'?>" class="btn btn-primary d-inline-block">Quay lại</a></div>

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
      <?php $rules = isset($data['rules']) ? $data['rules'] : ""?>
      <?php 
      $permissions = isset($data['permissions']) ? $data['permissions'] : "";
      ?>
  
    <?php if($rules) :?>
      <?php foreach($rules as $item) : ?>
        <tr>
          <th class="col-1"><?php echo $item->id ?></th>
          <td class="col-6"><?php echo $item->name ?></td>
          <td class="col-3"><?php echo $item->url ?></td>
          <td class="col-2">
            <div class="d-flex justify-content-center align-items-center">
              <input type="checkbox" name="permissions[]" value="<?php echo $item->id?>" 
              <?php 
              foreach($permissions as $permission)
              {
               echo +$permission->rule_id === +$item->id ? "checked" : "";
              }
              
              ?>
              >
            </div>
          </td>
        </tr>
      <?php endforeach;  ?>
    <?php endif; ?>
  </tbody>
</table>