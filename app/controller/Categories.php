<?php 

class Categories extends Controller
{
	protected $CategoriesModel;
	private $AuthMiddleware;
	private $PermissionMiddleware;
	public function __construct() 
	{
		$this->AuthMiddleware = $this->middleware("AdminMiddleware");
		$this->AuthMiddleware->handle();
		$this->PermissionMiddleware = $this->middleware("PermissionMiddleware");
		$this->CategoriesModel = $this->model("CategoriesModel");
		
	}
	public function index() 
	{
		$this->PermissionMiddleware->handle("categories");
		if(isset($_GET['page']) && $_GET['page'] !== "")
		{
			$this->CategoriesModel->offset = (esc($_GET['page']) - 1 ) * $this->CategoriesModel->limit;
		}
		if(isset($_GET['col']) && $_GET['col'] !== "") {
			$this->CategoriesModel->order_column = esc($_GET['col']);
		}
		if(isset($_GET['order']) && $_GET['order'] !== "") {
			$this->CategoriesModel->order_type = esc($_GET['order']);
		}
		if(isset($_GET['q']) && $_GET['q'] !== "") 
		{
			$q = esc($_GET['q']);
			$col_name = ['title', "slug"];
			$categories = $this->CategoriesModel->getDataSearch($col_name, $q);
		}else 
		{
			$categories = $this->CategoriesModel->findAll();
		}
		$count = $this->CategoriesModel->getTotalRecords();
		$limit = $this->CategoriesModel->limit;
		$per_page = ceil($count/$limit);
		$this->view("cpanel/layout", [
			"title" => "List - Categories",
			"page"=>"categories/index",
			"heading" => "Categories",
			"data" => $categories,
			"pagination" => $per_page,
			"col" => $this->CategoriesModel->allowedColumns,
		]);
	}	
	public function add_category() 
	{
		$this->PermissionMiddleware->handle("categories/add_category");
		$categories = $this->CategoriesModel->getCategories();
		$this->view("cpanel/layout", [
			"title" => "Add Categories - Dashboard",
			"page"=>"categories/form_category",
			"heading" => "Add New Category",
			"data" => $categories,
			"action"=>"categories/add_category_post",
		]);
	}	
	public function add_category_post () 
	{
		if(isset($_POST['submit_category']))
		{
			$name = isset($_POST['name']) ? $_POST['name'] : "";
			$slug = isset($_POST['slug']) ? $_POST['slug'] : "";
			$status = isset($_POST['status']) ? 1 : 0;
			$data = ["title" => $name, "slug" => $slug,"status" => $status];
			if($this->CategoriesModel->insert($data)) 
			{
				$messager['mes'] = "Thêm danh mục sản phẩm thành công!";
				redirect('categories?msg='.urldecode(serialize($messager)));
			}else {
				$messager['mes'] = "Thêm danh mục sản phẩm không thành công!";
				redirect('categories?msg='.urldecode(serialize($messager)));
			}
		}
	}
	public function edit_category($id) 
	{
		$this->PermissionMiddleware->handle("categories/edit_category");

		$category = $this->CategoriesModel->where(["id" => $id]);
		$this->view("cpanel/layout", [
			"title" => "Edit Categories - Dashboard",
			"page"=>"categories/form_category",
			"heading" => "Edit Category",
			"category" =>$category,
			"action"=>"categories/edit_category_post/$id",
		]);
	}	
	public function edit_category_post ($id) 
	{
		if(isset($_POST['submit_category']))
		{
			$name = isset($_POST['name']) ? $_POST['name'] : "";
			$slug = isset($_POST['slug']) ? $_POST['slug'] : "";
			$status = isset($_POST['status']) ? 1 : 0;
			$data = ["title" => $name, "slug" => $slug,"status" => $status];
			if($this->CategoriesModel->update($id, $data)) { 
				$messager['mes'] = "Sưa danh mục sản phẩm thành công!";
				redirect('categories?msg='.urldecode(serialize($messager)));
			}else {
				$messager['mes'] = "Sửa danh mục sản phẩm không thành công!";
				redirect('categories?msg='.urldecode(serialize($messager)));
			}
		}
	}

	public function delete_category ($id) 
	{
		$this->PermissionMiddleware->handle("categories/delete_category");
		if($this->CategoriesModel->delete($id)) 
		{
			$messager['mes'] = "Xoá danh mục sản phẩm thành công!";
			redirect('categories?msg='.urldecode(serialize($messager)));
		}
		return false;
	}
}
?>