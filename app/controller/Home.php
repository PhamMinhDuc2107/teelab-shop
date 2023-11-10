<?php 

class Home extends Controller
{
	private $BannerModel;
	private $CategoriesModel;
	private $ProductModel;
	public function __construct()
	{
		$this->BannerModel = $this->model("BannerModel");
		$this->CategoriesModel = $this->model("CategoriesModel");
		$this->ProductModel = $this->model("ProductModel");
		$this->ProductModel->limit = 100;
	}
	public function index () 
	{
		$categories = $this->CategoriesModel->findAll();
		$products = $this->ProductModel->where(["remove"=>0]);
		$categorie_actives = $this->CategoriesModel->where(["status" => 1]);
		$banner = $this->BannerModel->where(["status" => 1]);
		$results = [];
		if(isset($categorie_actives)) 
		{
			$index = 0;
			foreach($categorie_actives as  $category)
			{
				if($category ->status===1) 
				{
					$results[$index]["category"] = $category;
					$results[$index]['products']= [];
					foreach($products as $product)
					{
						if(+$category->id === +$product->category_id)
						{
							array_push($results[$index]['products'], $product);
						}
					}
					$index = $index + 1 ;
				}
			}
		}
		$this->view("client/layout", [
			"page"=>"home",
			"title" => "Home Page",
			"dataBanner" => $banner,
			"dataCategories" => $categories,
			"data"=>$results,
			"categorie_actives" => $categorie_actives
		]);
	}
}

?>