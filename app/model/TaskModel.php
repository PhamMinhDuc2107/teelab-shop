<?php
   class TaskModel extends Model
   {
      public $table="tasks";
      public $allowedColumns =["task_id", "title", "description",'assigned_to', 'created_by','created_at','due_date', 'status'];
   }
?>