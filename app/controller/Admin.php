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
		if(getSession("login") || isset($_COOKIE['user'])) {
			$this->view("cpanel/layout", [
				"title" => "Admin - Dashboard",
				"page" => "dashboard/dashboard",
				"heading" => "Dashboard",
			]);
		}else {
			redirect("admin/login");
		}
	}
	public function login()
	{
		if(getSession("login") || isset($_COOKIE['user'])) {
			redirect("admin");
		}else {
			$this->view("cpanel/layoutAuth", [
				"title" => "Login - Dashboard",
			]);
		}
		
	}
	public function login_post()
	{
		if(isset($_POST)) {
			$username = isset($_POST['username']) ? $_POST['username'] : "";
			$password = isset($_POST['password']) ? $_POST['password'] : "";
			$remember = isset($_POST['remember']) ? 1 : 0;
			$user = $this->AdminModel->where(["username" => $username]);
			if(isset($user[0])) 
			{
				if(password_verify($password,$user[0]->password)) 
				{
					if($remember == 1) {
						setcookie("user", "usr=".$user[0]->username."&hash=".$user[0]->password, time() + (3600 * 24 * 30));
					}
					setSession("login", true);
					setSession("user", $user[0]);
					redirect("admin");					
				}else 
				{
					redirect("admin/login?invalid");
				}
			}else 
			{
				redirect("admin/login?invalid");
			}
		}  
	}
	public function logout() 
	{
		if(getSession("login") || isset($_COOKIE['user'])) {
			if($_COOKIE['user']) {
				setcookie("user","", time() - 3600*24*30);
			}
			removeSession("login");
			removeSession("user");
			redirect("admin/login");
		}else {
			redirect("admin/login");
		}
	}
}

?>