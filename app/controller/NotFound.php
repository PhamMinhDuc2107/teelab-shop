<?php 
class NotFound extends Controller
{
	private $CategoriesModel;
	public function __construct()
	{
		$this->CategoriesModel = $this->model("CategoriesModel");
	}
	public function index() { 
		$categories = $this->CategoriesModel->findAll();

		$this->view("client/layout",[
			"page" => "404",
			"title" => "Not Found",
			"dataCategories"=> $categories

		]);
	}
}
?>