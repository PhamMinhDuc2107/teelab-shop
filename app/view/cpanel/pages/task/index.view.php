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
<?php
   $admins = isset($data['admins']) ? $data['admins'] :  "";
?>
<table class="table table-bordered">
  <thead class="table-primary text-white">
    <tr>
      <th class="col-1">Id</th>
      <th class="col-2">Title</th>
      <th class="col-1">Assigned_to</th>
      <th class="col-1">Created_by</th>
      <th class="col-2">Created_at</th>
      <th class="col-2">Due_date</th>
      <th class="col-2">Status</th>
      <th class="col-2">Actions</th>

    </tr>
  </thead>
  <tbody>
    <?php if($data['tasks']) :?>
      <?php foreach($data["tasks"] as $item) : ?>
        <tr>
          <th class="col-1"><?php echo $item->id ?></th>
          <td class="col-2"><?php echo $item->title ?></td>
          <td class="col-1">
         <?php
            foreach($admins as $admin)
            {
               if($admin->id === $item->assigned_to)
               {
                  echo $admin->username;
               }
            }
          ?></td>
          <td class="col-1">
         <?php
            foreach($admins as $admin)
            {
               if($admin->id === $item->created_by)
               {
                  echo $admin->username;
               }
            }
          ?></td>
          <td class="col-2">
         <?php
           echo $item->created_at;
          ?></td>
           <td class="col-2">
         <?php
           echo $item->due_date;
          ?></td>
          <td class="col-2 text-center">
            <?php if($item->status === 1):?>
                <span style="color:rgb(30, 198, 83);">Hoàn thành</span>
            <?php else:?>
                <span style="color:rgb(19, 183, 233)">Chưa hoàn thành</span>
            <?php endif;?>
          </td>
          <td class="col-2">
            <div class="d-flex justify-content-center align-items-center">
              <a href="<?php echo ROOT.'task/task_detail/'.$item->id ?>"  class="d-block text-primary btn-edit-category">
                  <img src="https://pic.onlinewebfonts.com/thumbnails/icons_108143.svg" alt="" class="d-inline-block" style="width: 16px; height: 16px">
              </a>
              <a href="<?php echo ROOT.'task/edit_task/'.$item->id ?>"  class="d-block text-primary btn-edit-category">
                <i class="fa-regular fa-pen-to-square inline-block px-2"></i>
              </a>
              <a href="<?php echo ROOT.'task/delete_task/'.$item->id ?>" class="d-block text-danger btn-delete-category" onClick="alert('Delete Task!')">
                <i class="fa-solid fa-trash inline-block px-2"></i>
              </a>
            </div>
          </td>
        </tr>
      <?php endforeach;  ?>
    <?php endif; ?>
  </tbody>
</table>