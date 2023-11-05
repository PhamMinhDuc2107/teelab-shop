<?php 

class Home extends Controller
{
	private $BannerModel;
	private $CategoriesModel;
	public function __construct()
	{
		$this->BannerModel = $this->model("BannerModel");
		$this->CategoriesModel = $this->model("CategoriesModel");
	}
	public function index () {
		$categories = $this->CategoriesModel->where(["status" => 1]);
		$banner = $this->BannerModel->where(["status" => 1]);
		$this->view("client/layout", [
			"page"=>"home",
			"title" => "Home Page",
			"dataBanner" => $banner,
			"dataCategories" => $categories
		]);
	}
}

?>