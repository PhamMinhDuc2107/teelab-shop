<?php
   class Task extends Controller
   {
      private $AdminModel;
      private $TaskModel;
      private $TaskCommentModel;
      private $TaskAttachmentModel;
      public function __construct()
      {
         $this->AdminModel = $this->model("AdminModel");
         $this->TaskModel = $this->model("TaskModel");
         $this->TaskCommentModel = $this->model("TaskCommentModel");
         $this->TaskAttachmentModel = $this->model("TaskAttachmentModel");
      }
      public function index()
      {
         $tasks = $this->TaskModel->getAll();
         $admins= $this->AdminModel->getAll();
         $this->view("cpanel/layout", [
            'page'=>"task/index",
            "title" => "Nhiệm vụ",
            'heading'=>"Oke",
            "tasks" => $tasks,
            "admins" => $admins
         ]);
      }
      public function add_task()
      {
         $admins = $this->AdminModel->getAll();
         $this->view("cpanel/layout", [
            'page'=>"task/form_task",
            "title" => "Thêm nhiệm vụ",
            'heading'=>"Thêm nhiệm vụ",
            "action"=>'task/add_task_post',
            "admins" => $admins,
         ]);
      }
      public function add_task_post()
      {
         if(isset($_POST))
         {
            $title = isset($_POST['title']) ? esc($_POST['title']) :'';
            $description = isset($_POST['description']) ? ($_POST['description']) :'';
            $assign_to = +isset($_POST['assigned_to']) ? ($_POST['assigned_to']) :'';
            $due_date = isset($_POST['due_date']) ? $_POST['due_date'] :"";
            $due_date = str_replace("T", " ", $due_date);
            $created_by = +getSession("user")->id;
            $data = ["title" => $title, "description" => $description, "assigned_to" => $assign_to, "due_date" => $due_date, "status" =>0 , "created_at" => date("Y-m-d H:i"),"created_by" => $created_by];
            if($this->TaskModel->insert($data)) 
            {
            	$messager['mes'] = "Thêm danh mục sản phẩm thành công!";
            	redirect('task?msg='.urldecode(serialize($messager)));
            }else {
            	$messager['mes'] = "Thêm danh mục sản phẩm không thành công!";
            	redirect('task?msg='.urldecode(serialize($messager)));
            }
         }
      }
      public function edit_task($id) 
      {
         $admins = $this->AdminModel->getAll();
         $task = $this->TaskModel->where(["id" => $id]);
         $this->view("cpanel/layout", [
            "title" => "Edit Task - Dashboard",
            "page"=>"task/form_task",
            "heading" => "Edit Task",
            "task" =>$task,
            "admins" => $admins,
            "action"=>"task/edit_task_post/$id",
         ]);
      }	
      public function edit_task_post ($id) 
      {
         if(isset($_POST))
         {
            $title = isset($_POST['title']) ? esc($_POST['title']) :'';
            $description = isset($_POST['description']) ? json_encode($_POST['description']) :'';
            $assigned_to = +isset($_POST['assigned_to']) ? ($_POST['assigned_to']) :'';
            $due_date = isset($_POST['due_date']) ? $_POST['due_date'] :"";
            $due_date = str_replace("T", " ", $due_date);
            $created_by = +getSession("user")->id;
            $data = ["title" => $title, "description" => $description, "assigned_to" => $assigned_to, "due_date" => $due_date, "status" =>0 ,"created_by" => $created_by];
            if($this->TaskModel->update($id, $data)) { 
               $messager['mes'] = "Sửa nhiệm vụ thành công!";
               redirect('task?msg='.urldecode(serialize($messager)));
            }else {
               $messager['mes'] = "Sửa nhiệm vụ không thành công!";
               redirect('task?msg='.urldecode(serialize($messager)));
            }
         }
      }
      public function delete_task($id) 
	   {
         $task = $this->TaskModel->where(["id" => $id]);
         if($task)
         {
            $this->TaskModel->delete($id, "id");
            $messager['mes'] = "Xoá nhiệm vụ thành công!";
            redirect('task?msg='.urldecode(serialize($messager)));
         }
	   }
      public function task_detail($task_id)
      {
         $task_id = esc($task_id);
         $task = $this->TaskModel->where(['id'=> $task_id]);
         $admins = $this->AdminModel->getAll();
         $this->view("cpanel/layout", [
            'page'=>"task/task_detail",
            "title" => "Thông tin chi tiết nhiệm vụ",
            'heading'=>"Thông tin chi tiết nhiệm vụ",
            "task" => $task,
            "admins" => $admins
         ]);
      }
   }
?>