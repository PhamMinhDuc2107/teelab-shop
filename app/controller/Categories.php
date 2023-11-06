<?php 

class Categories extends Controller
{
	protected $CategoriesModel;
	public function __construct() 
	{
		$this->CategoriesModel = $this->model("CategoriesModel");
		$GLOBALS['categories'] = $this->CategoriesModel->findAll();
	}
	public function index() 
	{
		if(isset($_GET['page']) && $_GET['page'] !== "")
		{
			$this->CategoriesModel->offset = $_GET['page'];
		}
		if(isset($_GET['col']) && $_GET['col'] !== "") {
			$this->CategoriesModel->order_column = $_GET['col'];
		}
		if(isset($_GET['order']) && $_GET['order'] !== "") {
			$this->CategoriesModel->order_type = $_GET['order'];
		}
		if(isset($_GET['q']) && $_GET['q'] !== "") 
		{
			$q = $_GET['q'];
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
		if($this->CategoriesModel->delete($id)) 
		{
			$messager['mes'] = "Xoá danh mục sản phẩm thành công!";
			redirect('categories?msg='.urldecode(serialize($messager)));
		}
		return false;
	}
}
?>