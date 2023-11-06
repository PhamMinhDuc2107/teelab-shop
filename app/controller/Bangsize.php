<?php 
class Bangsize extends Controller
{
	public function __construct()
	{
		$this->CategoriesModel = $this->model("CategoriesModel");
	}
	public function index()
	{
		$categories = $this->CategoriesModel->findAll();
		$categorie_actives = $this->CategoriesModel->where(["status" => 1]);
		$this->view("client/layout",[
			"page"=>"bang_size",
			"title"=>"Bảng sizes",
			"dataCategories" => $categories,
			"categorie_actives" => $categorie_actives
		]);
	}
}
?>