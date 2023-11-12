<?php 

class Admin extends Controller
{
	private $AdminModel;
	private $RuleModel;
	private $PermissionModel;
	private $AuthMiddleware;
	private $PermissionMiddleware;
	public function __construct() 
	{
		$this->AuthMiddleware = $this->middleware("AdminMiddleware");
		$this->AuthMiddleware->handle();
		$this->PermissionMiddleware = $this->middleware("PermissionMiddleware");
		$this->AdminModel = $this->model("AdminModel");
		$this->RuleModel = $this->model("RuleModel");
		$this->PermissionModel = $this->model("PermissionModel");
	}
	public function index()
	{
		if(isset($_GET['page']) && $_GET['page'] !== "")
		{
			$this->AdminModel->offset = (esc($_GET['page']) - 1 ) * $this->AdminModel->limit;

		}
		if(isset($_GET['col']) && $_GET['col'] !== "") {
			$this->AdminModel->order_column =esc($_GET['col']);
		}
		if(isset($_GET['order']) && $_GET['order'] !== "") {
			$this->AdminModel->order_type =esc($_GET['order']);
		}
		if(isset($_GET['q']) && $_GET['q'] !== "") 
		{
			$q = esc($_GET['q']);
			$col_name = ['username', "email"];
			$admin = $this->AdminModel->getDataSearch($col_name, $q);
		}else 
		{
			$admin = $this->AdminModel->findAll();
		}
		$this->PermissionMiddleware->handle("admin");
		$count = $this->AdminModel->getTotalRecords();
		$limit = $this->AdminModel->limit;
		$per_page = ceil($count/$limit);
		$admin = $this->AdminModel->findAll();
		$this->view("cpanel/layout", [
			"title" => "List Admin - Dashboard",
			"page"=>"admin/index",
			"heading" => "Admin",
			"data"=>$admin,
			"pagination" => $per_page,
			"col" => $this->AdminModel->allowedColumns,
		]);
	}
	public function add_admin() 
	{
		$this->PermissionMiddleware->handle("admin/add_admin");
		$this->view("cpanel/layout", [
			"title" => "Add Admin - Dashboard",
			"page"=>"admin/form_admin",
			"heading" => "Add New Admin",
			"action"=>"admin/add_admin_post",
		]);
	}
	public function add_admin_post() 
	{
		if($_POST)
		{
			$username = isset($_POST['username']) ? $_POST['username'] : "";
			$password = isset($_POST['password']) ? $_POST['password'] : "";
			$password = password_hash($password, PASSWORD_DEFAULT);
			$email = isset($_POST['email']) ? $_POST['email'] : "";
			$data = ["username" => $username, "password" => $password, "email" => $email];
			if($this->AdminModel->insert($data)) 
			{
				$messager['mes'] = "Thêm admin thành công!";
				redirect('admin?msg='.urldecode(serialize($messager)));
			}else {
				$messager['mes'] = "Thêm admin không thành công!";
				redirect('admin?msg='.urldecode(serialize($messager)));
			}
		}
	}
	public function edit_admin($id) 
	{
		$this->PermissionMiddleware->handle("admin/edit_admin");
		$record = $this->AdminModel->where(["id" => $id]);
		$this->view("cpanel/layout", [
			"title" => "Edit Admin - Dashboard",
			"page"=>"admin/form_admin",
			"heading" => "Edit New Admin",
			"action"=>"admin/edit_admin_post/$id",
			"data" => $record,
		]);
	}
	public function edit_admin_post($id) 
	{
		
		if($_POST)
		{
			
			$username = isset($_POST['username']) ? $_POST['username'] : "";
			$password = isset($_POST['password']) ? $_POST['password'] : "";
			$email = isset($_POST['email']) ? $_POST['email'] : "";
			$data = ["username" => $username, "email" => $email];
			if(!empty($password)) {
				$password = password_hash($password, PASSWORD_DEFAULT);
				$data = ["username" => $username,"password" => $password, "email" => $email];
			}
			show($data);
			if($this->AdminModel->update($id,$data)) 
			{
				$messager['mes'] = "Cập nhật admin thành công!";
				redirect('admin?msg='.urldecode(serialize($messager)));
			}else {
				$messager['mes'] = "Cập nhật admin không thành công!";
				redirect('admin?msg='.urldecode(serialize($messager)));
			}
		}
	}
	public function delete_admin($id) 
	{
		$this->PermissionMiddleware->handle("admin/delete_admin");
		if($this->AdminModel->delete($id)) 
		{
			$messager['mes'] = "Xoá admin thành công!";
			redirect('admin?msg='.urldecode(serialize($messager)));
		}else {
			$messager['mes'] = "Xoá admin không thành công!";
			redirect('admin?msg='.urldecode(serialize($messager)));
		}
	}
	public function rule()
	{
		$this->PermissionMiddleware->handle("admin/rule");
		if(isset($_GET['page']) && $_GET['page'] !== "")
		{
			$this->RuleModel->offset = (esc($_GET['page']) - 1 ) * $this->RuleModel->limit;

		}
		if(isset($_GET['col']) && $_GET['col'] !== "") {
			$this->RuleModel->order_column =esc($_GET['col']);
		}
		if(isset($_GET['order']) && $_GET['order'] !== "") {
			$this->RuleModel->order_type =esc($_GET['order']);
		}
		if(isset($_GET['q']) && $_GET['q'] !== "") 
		{
			$q = esc($_GET['q']);
			$col_name = ['username', "email"];
			$rules = $this->RuleModel->getDataSearch($col_name, $q);
		}else 
		{
			$rules = $this->RuleModel->findAll();
		}
		$count = $this->RuleModel->getTotalRecords();
		$limit = $this->RuleModel->limit;
		$per_page = ceil($count/$limit);
		$admin = $this->RuleModel->findAll();
		$this->view("cpanel/layout", [
			"title" => "List Rule - Dashboard",
			"page"=>"rule/index",
			"heading" => "Rule",
			"data"=>$rules,
			"pagination" => $per_page,
			"col" => $this->RuleModel->allowedColumns,
		]);
		
	}
	public function add_rule() 
	{
		$this->PermissionMiddleware->handle("admin/add_rule");
		$this->view("cpanel/layout", [
			"title" => "Add Rule - Dashboard",
			"page"=> "rule/form_rule",
			"heading" => "Add Rule",
			"action" => "admin/add_rule_post"
		]);
	}
	public function add_rule_post()
	{
		if($_POST)
		{
			$name = isset($_POST["name"]) ? esc($_POST["name"]) :"";
			$url = isset($_POST["url"]) ? esc($_POST["url"]) :"";
			$data = ['name' => $name, "url"=> $url];
			if($this->RuleModel->insert($data))
			{
				$messager['mes'] = "Thêm rule thành công!";
				redirect('admin/rule?msg='.urldecode(serialize($messager)));
			}
		}
	}
	public function edit_rule($id) 
	{
		$this->PermissionMiddleware->handle("admin/edit_rule");
		$rule = $this->RuleModel->where(["id" => $id]);
		$this->view("cpanel/layout", [
			"title" => "Add Rule - Dashboard",
			"page"=>"rule/form_rule",
			"heading" => "Add Rule",
			"action" => "admin/edit_rule_post/".$id,
			"data" => $rule
		]);
	}
	public function edit_rule_post($id)
	{
		if($_POST)
		{
			$name = isset($_POST["name"]) ? esc($_POST["name"]) :"";
			$url = isset($_POST["url"]) ? esc($_POST["url"]) :"";
			if($this->RuleModel->update($id, ['name' => $name, 'url' => $url]))
			{
				$messager['mes'] = "Cập nhật rule thành công!";
				redirect('admin/rule?msg='.urldecode(serialize($messager)));
			}
		}
	}
	public function delete_rule($id)
	{
		$this->PermissionMiddleware->handle("admin/delete_rule");
		if($this->RuleModel->delete($id))
			{
				$messager['mes'] = "Xoá rule thành công!";
				redirect('admin/rule?msg='.urldecode(serialize($messager)));
			}
	}
	public function add_rule_admin($id)
	{
		$id = esc($id);
		$this->RuleModel->limit = 100;
		$rules = $this->RuleModel->findAll();
		$permissions = $this->PermissionModel->where(["admin_id" =>$id]);
		$this->view("cpanel/layout", [
			"title" => "Add Rule Admin - Dashboard",
			"page"=>"rule/add_rule_admin",
			"heading" => "Add Rule Admin",
			"rules"=>$rules,
			"permissions" => $permissions,
		]);
	}
}


?>