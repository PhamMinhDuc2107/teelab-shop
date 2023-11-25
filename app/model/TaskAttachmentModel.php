<?php
   class TaskAttachmentModel extends Model
   {
      public $table="task_attachments";
      public $allowedColumns =["attachment_id", "task_id", "file_name"];
   }
?>