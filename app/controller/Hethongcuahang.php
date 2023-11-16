<?php 
class Hethongcuahang extends Controller
{
	private $CategoriesModel;
	public function __construct()
	{
		$this->CategoriesModel = $this->model("CategoriesModel");
	}
	public function index()
	{
		$categories = $this->CategoriesModel->findAll();
		$categories_actives = $this->CategoriesModel->where(["status" => 1]);
		$this->view("client/layout",[
			"page"=>"he_thong_cua_hang",
			"title"=>"Hệ thống cửa hàng",
			"dataCategories" => $categories,
			"categorie_actives" => $categories_actives
		]);
	}
}
?>