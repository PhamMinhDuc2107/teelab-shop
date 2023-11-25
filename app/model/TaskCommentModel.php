<?php
   class TaskCommentModel extends Model
   {
      public $table="task_comments";
      public $allowedColumns =["comment_id", "task_id", "admin_id",'content', 'created_at'];
   }
?>