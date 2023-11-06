<?php 
class Sanpham extends Controller
{
	private $CategoriesModel;
	private $ProductModel;
	public function __construct()
	{
		$this->CategoriesModel = $this->model("CategoriesModel");
		$this->ProductModel = $this->model("ProductModel");
	}
	public function index($slug) 
	{
		$products = $this->ProductModel->where(['remove'=>0]);
		$categories = $this->CategoriesModel->findAll();
		if(isset($_GET['page'])) 
		{
			$this->ProductModel->offset = $_GET['page'];
		}
		if(isset($slug))
		{
			$category = $this->CategoriesModel->getDataSearch(['slug'], $slug);
			if(isset($category[0]))
			{
				$category_id = $category[0]->id;
				$products = $this->ProductModel->where(['category_id'=>$category_id]);
				$category_name =  $this->CategoriesModel->where(['id'=>$category_id]);
				$category_name = $category_name[0]->title;
			}else 
			{
				$this->view("client/layout",[
					"page" => "404",
					"title" => "Not Found",
					"dataCategories"=> $categories
				]);
			}
		}else 
		{
			$products = $this->ProductModel->where(['remove'=>0]);
		}
		$count = count($products);
		$limit = $this->ProductModel->limit;
		$per_page = ceil($count/$limit);
		$this->view("client/layout", [
			"page"=>"product",
			"title" => "$category_name",
			"heading"=>"$category_name",
			"dataCategories" => $categories,
			"products"=>$products,
			"per_page"=>$per_page
		]);
	}
	public function all() {
		$products = $this->ProductModel->where(['remove'=>0]);
		$categories = $this->CategoriesModel->findAll();
		$count = count($products);
		$limit = $this->ProductModel->limit;
		$per_page = ceil($count/$limit);
		$this->view("client/layout", [
			"page"=>"product",
			"title" => "Tất cả sản phẩm",
			"heading"=>"Tất cả sản phẩm",
			"dataCategories" => $categories,
			"products"=>$products,
			"per_page"=>$per_page
		]);
	}
}
?>