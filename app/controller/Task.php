<?php
   class Task extends Controller
   {
      private $AdminModel;
      private $TaskModel;
      private $TaskCommentModel;
      private $TaskAttachmentModel;
      private $AuthMiddleware;
      private $PermissionMiddleware;
      public function __construct()
      {
         $this->AuthMiddleware = $this->middleware("AdminMiddleware");
         $this->AuthMiddleware->handle();
         $this->PermissionMiddleware = $this->middleware("PermissionMiddleware");
         $this->AdminModel = $this->model("AdminModel");
         $this->TaskModel = $this->model("TaskModel");
         $this->TaskCommentModel = $this->model("TaskCommentModel");
         $this->TaskAttachmentModel = $this->model("TaskAttachmentModel");
      }
      public function index()
      {
		$this->PermissionMiddleware->handle("task");

         BaseModelHelper::handleSorting($this->TaskModel);
         $tasks = BaseModelHelper::getSearchData($this->TaskModel, ['username', "email"]);
         $per_page = BaseModelHelper::getPaginationData($this->TaskModel);

         $admins= $this->AdminModel->getAll();
         $this->view("cpanel/layout", [
            'page'=>"task/index",
            "title" => "Nhiệm vụ",
            'heading'=>"Oke",
            "tasks" => $tasks,
            "admins" => $admins,
            "pagination" => $per_page,
			   "col" => $this->TaskModel->allowedColumns,
         ]);
         exit;
      }
      public function add_task()
      {
		   $this->PermissionMiddleware->handle("task/add_task");
         $admins = $this->AdminModel->getAll();
         $this->view("cpanel/layout", [
            'page'=>"task/form_task",
            "title" => "Thêm nhiệm vụ",
            'heading'=>"Thêm nhiệm vụ",
            "action"=>'task/add_task_post',
            "admins" => $admins,
         ]);
         exit;

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
         exit;

      }
      public function edit_task($id) 
      {
		$this->PermissionMiddleware->handle("task/edit_task");
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
         exit;

      }	
      public function edit_task_post ($id) 
      {
         if(isset($_POST))
         {
            $title = isset($_POST['title']) ? esc($_POST['title']) :'';
            $description = isset($_POST['description']) ? ($_POST['description']) :'';
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
         exit;

      }
      public function delete_task($id) 
	   {
		$this->PermissionMiddleware->handle("delete_task");

         $task = $this->TaskModel->where(["id" => $id]);
         if($task)
         {
            $this->TaskModel->delete($id, "id");
            $messager['mes'] = "Xoá nhiệm vụ thành công!";
            redirect('task?msg='.urldecode(serialize($messager)));
         }
         exit;

	   }
      public function task_detail($task_id)
      {
         $task_id = esc($task_id);
         $task = $this->TaskModel->where(['id'=> $task_id]);
         $detail = $this->TaskAttachmentModel->where(["task_id" => esc($task_id)]);
         $admins = $this->AdminModel->getAll();
         $this->view("cpanel/layout", [
            'page'=>"task/task_detail",
            "title" => "Thông tin chi tiết nhiệm vụ",
            'heading'=>"Thông tin chi tiết nhiệm vụ",
            "task" => $task,
            "admins" => $admins,
            "detail" => $detail
         ]);
         exit;

      }
      public function my_task()
      {
         $admin_id = +getSession("user")->id;
         $my_tasks = $this->TaskModel->where(["assigned_to" => $admin_id]);
         $admins = $this->AdminModel->getAll();
         $data = [
            'page'=>"task/my_task",
            "title" => "Thông tin nhiệm vụ của tôi",
            'heading'=>"Thông tin nhiệm vụ của tôi",
            "my_tasks"=>$my_tasks,
            "admins" => $admins
         ];
         $this->view("cpanel/layout", $data);
         exit;

      }
      public function my_submit($id)
      {
         $data=[
            'page'=>"task/form_submit_task",
            "title" => "Nộp báo cáo",
            'heading'=>"Nộp báo cáo",
            "action" =>'task/my_submit_post/'.esc($id)
         ];
         $this->view('cpanel/layout', $data);
         exit;
      }
      public function my_submit_post($id)
      {
         if(isset($_POST))
         {
            $description = isset($_POST['description']) ? esc($_POST['description']) :'';
            $allowedFormats = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];
            $fileTmp = $_FILES["file"]["tmp_name"];
            $fileName = $_FILES['file']['name'];
            $fileUnique = unique_img("file");
            $fileFormat = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (in_array($fileFormat, $allowedFormats)) 
            {
               $targetDir = "assets/uploads/files/";
               $targetPath = $targetDir.$fileUnique;
               $data = ['description' => $description, "file_name" => $fileUnique, "task_id" => esc(+$id)];

               if ($this->TaskAttachmentModel->insert($data)) 
               {
                  move_uploaded_file($fileTmp, $targetPath);
                  $this->TaskModel->update(esc(+$id),['status' => 1]);
                  $messager['mes'] = "Tải file lên thành công";
                  redirect('task/my_task?msg='.urldecode(serialize($messager)));
               }
            } else 
            {
               $messager['mes'] = "Định dạng file không hợp lệ. Chỉ cho phép tải lên file Word, Excel và PDF.";
               redirect('task/my_submit?msg='.urldecode(serialize($messager)));
            }
            
         }
      }
      public function download()
      {
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $filePath = "assets/uploads/files/".$_POST['file_path'];
            show($filePath);
            if (file_exists($filePath)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($filePath));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filePath));
                readfile($filePath);
                exit;
            } else {
                echo "File not found.";
            }
        } else {
            echo "Invalid request.";
        }
      }
   }
?>