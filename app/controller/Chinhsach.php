<?php 
class Chinhsach extends Controller
{
	private $CategoriesModel;
	
	public function __construct()
	{
		$this->CategoriesModel = $this->model("CategoriesModel");
	}
	public function index()
	{
		$categories = $this->CategoriesModel->findAll();
		$categorie_actives = $this->CategoriesModel->where(["status" => 1]);
		$this->view("client/layout",[
			"page"=>"policy",
			"title"=>"Chính sách đổi trả",
			"dataCategories" => $categories,
			"categorie_actives" => $categorie_actives
		]);
	}
}
?>