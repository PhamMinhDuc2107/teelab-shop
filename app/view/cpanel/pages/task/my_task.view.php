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
<div class="container-fluid">
   <div class="col-md-12">
      <div class="panel panel-primary">
         <div class="panel-body">
            <table class="table">
               <thead>
               <tr class="text-center">
                  <th class="col-1">Id</th>
                  <th class="col-4">Title</th>
                  <th class="col-1">Created_by</th>
                  <th class="col-2">Due_date</th>
                  <th class="col-1">Status</th>
                  <th class="col-2">Actions</th>
               </tr>
               </thead>
               <tbody>
               <?php if($data['my_tasks']) :?>
                  <?php foreach($data["my_tasks"] as $item) : ?>
                  <tr>
                     <th class="col-1"><?php echo $item->id ?></th>
                     <td class="col-4"><?php echo $item->title ?></td>
                     <td class="col-1 text-center">
                     <?php
                        foreach($data['admins'] as $admin)
                        {
                           if($admin->id === $item->created_by)
                           {
                              echo $admin->username;
                           }
                        }
                     ?></td>
                     <td class="col-2 text-center">
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
                             Chi tiết
                        </a>
                        <?php if($item->status === 0): ?>
                        <a href="<?php echo ROOT.'task/my_submit/'.$item->id ?>"  class="d-block text-primary btn-edit-category ml-2 pl-2" style="border-left: 1px solid #eee">
                            Nộp
                        </a>
                        <?php endif;?>
                        </div>
                     </td>
                  </tr>
                  <?php endforeach;  ?>
               <?php endif; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>