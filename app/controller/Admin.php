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
		$this->PermissionMiddleware->handle("admin");
		BaseModelHelper::handleSorting($this->AdminModel);
		$admin = BaseModelHelper::getSearchData($this->AdminModel, ['username', "email"]);
		$per_page = BaseModelHelper::getPaginationData($this->AdminModel);

		$this->view("cpanel/layout", [
			"title" => "List Admin - Dashboard",
			"page" => "admin/index",
			"heading" => "Admin",
			"data" => $admin,
			"pagination" => $per_page,
			"col" => $this->AdminModel->allowedColumns,
		]);
	}

	public function add_admin()
	{
			$this->PermissionMiddleware->handle("admin/add_admin");
			$this->view("cpanel/layout", [
					"title" => "Add Admin - Dashboard",
					"page" => "admin/form_admin",
					"heading" => "Add New Admin",
					"action" => "admin/add_admin_post",
			]);
	}

	public function add_admin_post()
	{
			if ($_POST) {
					$username = $_POST['username'] ?? "";
					$password = $_POST['password'] ?? "";
					$password = password_hash($password, PASSWORD_DEFAULT);
					$email = $_POST['email'] ?? "";
					$data = ["username" => $username, "password" => $password, "email" => $email];

					$message = $this->AdminModel->insert($data) ? "Thêm admin thành công!" : "Thêm admin không thành công!";
					redirect('admin?msg=' . urlencode(serialize(['mes' => $message]))); // Simplified message handling
			}
	}

	public function edit_admin($id)
	{
			$this->PermissionMiddleware->handle("admin/edit_admin");
			$record = $this->AdminModel->where(["id" => $id]);
			$this->view("cpanel/layout", [
					"title" => "Edit Admin - Dashboard",
					"page" => "admin/form_admin",
					"heading" => "Edit New Admin",
					"action" => "admin/edit_admin_post/$id",
					"data" => $record,
			]);
	}

	public function edit_admin_post($id)
	{
			if ($_POST) {
					$username = $_POST['username'] ?? "";
					$password = $_POST['password'] ?? "";
					$email = $_POST['email'] ?? "";
					$data = ["username" => $username, "email" => $email];
					if (!empty($password)) {
							$password = password_hash($password, PASSWORD_DEFAULT);
							$data["password"] = $password; // Directly add password to $data
					}
					$message = $this->AdminModel->update($id, $data) ? "Cập nhật admin thành công!" : "Cập nhật admin không thành công!";
					redirect('admin?msg=' . urlencode(serialize(['mes' => $message])));
			}
	}

	public function delete_admin($id)
	{
			$this->PermissionMiddleware->handle("admin/delete_admin");
			$message = $this->AdminModel->delete($id) ? "Xoá admin thành công!" : "Xoá admin không thành công!";
			redirect('admin?msg=' . urlencode(serialize(['mes' => $message])));
	}
	public function rule()
	{
			$this->PermissionMiddleware->handle("admin/rule");

			BaseModelHelper::handleSorting($this->RuleModel);
			$rules = BaseModelHelper::getSearchData($this->RuleModel, $_GET['q'] ?? null, ['name', "url"]);
			$per_page = BaseModelHelper::getPaginationData($this->RuleModel);

			$this->view("cpanel/layout", [
					"title" => "List Rule - Dashboard",
					"page" => "rule/index",
					"heading" => "Rule",
					"data" => $rules,
					"pagination" => $per_page,
					"col" => $this->RuleModel->allowedColumns,
			]);
	}

	public function add_rule()
	{
			$this->PermissionMiddleware->handle("admin/add_rule");
			$this->view("cpanel/layout", [
					"title" => "Add Rule - Dashboard",
					"page" => "rule/form_rule",
					"heading" => "Add Rule",
					"action" => "admin/add_rule_post"
			]);
	}

	public function add_rule_post()
	{
			if ($_POST) {
					$name = $_POST["name"] ?? "";
					$url = $_POST["url"] ?? "";
					$data = ['name' => $name, "url" => $url];
					$result = $this->RuleModel->insert($data);
					BaseModelHelper::handleMessage($result, "Thêm rule thành công!", "Thêm rule không thành công!", 'admin/rule');
			}
	}
	public function edit_rule($id)
	{
			$this->PermissionMiddleware->handle("admin/edit_rule");
			$rule = $this->RuleModel->where(["id" => $id]);
			$this->view("cpanel/layout", [
					"title" => "Edit Rule - Dashboard", // Corrected title
					"page" => "rule/form_rule",
					"heading" => "Edit Rule", // Corrected heading
					"action" => "admin/edit_rule_post/" . $id,
					"data" => $rule
			]);
	}
	public function edit_rule_post($id)
	{
			if ($_POST) {
					$name = $_POST["name"] ?? "";
					$url = $_POST["url"] ?? "";
					$data = ['name' => $name, 'url' => $url];
					$result = $this->RuleModel->update($id, $data);
					BaseModelHelper::handleMessage($result, "Cập nhật rule thành công!", "Cập nhật rule không thành công!", 'admin/rule');
			}
	}
	public function delete_rule($id)
	{
			$this->PermissionMiddleware->handle("admin/delete_rule");
			$result = $this->RuleModel->delete($id);
			BaseModelHelper::handleMessage($result, "Xoá rule thành công!", "Xoá rule không thành công!", 'admin/rule');
	}
	public function add_rule_admin($id)
	{
			$id = esc($id);
			$this->RuleModel->limit = 100;
			$rules = $this->RuleModel->findAll();
			$permissions = $this->PermissionModel->where(["admin_id" => $id]);
			$this->view("cpanel/layout", [
					"title" => "Add Rule Admin - Dashboard",
					"page" => "rule/add_rule_admin",
					"heading" => "Add Rule Admin",
					"rules" => $rules,
					"permissions" => $permissions,
					"action" => "admin/add_rule_admin_post/" . $id
			]);
	}
	public function add_rule_admin_post($admin_id)
	{
			if ($_POST) {
					$permissions = $_POST['permissions'] ?? [];

					if (!empty($permissions)) {
							$success = true;
							foreach ($permissions as $rule_id) {
									if (!$this->PermissionModel->insert(["admin_id" => $admin_id, "rule_id" => $rule_id])) {
											$success = false;
											break;
									}
							}
							$message = $success ? "Thêm quyền thành công!" : "Thêm quyền không thành công!";
							redirect('admin/rule?msg=' . urlencode(serialize(['mes' => $message])));
					}
			}
	}
}
?>
