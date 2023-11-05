<?php 

class Admin extends Controller
{
	private $AdminModel;
	public function __construct() 
	{
		$this->AdminModel = $this->model("AdminModel");
	}
	public function index()
	{
		$admin = $this->AdminModel->findAll();
		$this->view("cpanel/layout", [
			"title" => "List Admin - Dashboard",
			"page"=>"admin/index",
			"heading" => "Admin",
			"data"=>$admin,
		]);
	}
	public function add_admin() 
	{
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
		if($this->AdminModel->delete($id)) 
		{
			$messager['mes'] = "Xoá admin thành công!";
			redirect('admin?msg='.urldecode(serialize($messager)));
		}else {
			$messager['mes'] = "Xoá admin không thành công!";
			redirect('admin?msg='.urldecode(serialize($messager)));
		}
	}
}


?>