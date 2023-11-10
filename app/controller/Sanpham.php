<?php 
class Sanpham extends Controller
{
	private $CategoriesModel;
	private $ProductModel;
	private $ProductImgModel;
	public function __construct()
	{
		$this->CategoriesModel = $this->model("CategoriesModel");
		$this->ProductModel = $this->model("ProductModel");
		$this->ProductImgModel = $this->model("ProductImgModel");
		if(isset($_GET['page'])) 
		{
			$this->ProductModel->offset = ($_GET['page'] - 1 ) * $this->ProductModel->limit;
		}
	}
	public function index($slug) 
	{

		$categories = $this->CategoriesModel->findAll();
		
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
		$count = $this->ProductModel->getSearchTotalRecords(["category_id"],$category_id,['category_id'=>$category_id]);
		$count = $count[0]->{"count(*)"};
		$per_page = ceil($count/$this->ProductModel->limit);
      $categories_actives = $this->CategoriesModel->where(['status'=> 1]);
		$this->view("client/layout", [
			"page"=>"product",
			"title" => "$category_name",
			"heading"=>"$category_name",
			"dataCategories" => $categories,
			"products"=>$products,
			"per_page"=>$per_page,
			"categories_actives"=>$categories_actives
		]);
	}
	public function all() {
		$products = $this->ProductModel->where(['remove'=>0]);
		$categories = $this->CategoriesModel->findAll();
		$count = $this->ProductModel->getTotalRecords();
		$limit = $this->ProductModel->limit;
		$per_page = ceil($count/$limit);
      $categories_actives = $this->CategoriesModel->where(['status'=> 1]);
		$this->view("client/layout", [
			"page"=>"product",
			"title" => "Tất cả sản phẩm",
			"heading"=>"Tất cả sản phẩm",
			"dataCategories" => $categories,
			"products"=>$products,
			"per_page"=>$per_page,
			"categories_actives" => $categories_actives
		]);
	}
	public function chitiet($id) {
		$recent_view = getSession("recent_view");
		$id= esc($id);
      $categories_actives = $this->CategoriesModel->where(['status'=> 1]);
		$product = $this->ProductModel->where(['id'=>$id]);
		if(empty($recent_view[$id])) {
			$recent_view[$id] = [
				'id' => $id,
				'name' => $product[0]->name,
				'img' => $product[0]->img,
				"quantity" => $product[0]->quantity,
				'price' => $product[0]->price,
				'discount' => $product[0]->discount,
				"categories_actives" => $categories_actives
			];
		};
		setSession("recent_view", $recent_view);
		$category_id = $product[0]->category_id;
		$categories = $this->CategoriesModel->findAll();
		$detail_img = $this->ProductImgModel->where(['product_id' => $id]);
		$related_product = $this->ProductModel->where(['category_id' => $category_id],["id" => $id]);
		$this->view("client/layout", [
			"page"=>"product_detail",
			"title" => $product[0]->name,
			"dataCategories" => $categories,
			"product"=>$product,
			"related_product" => $related_product,
			"detail_img" => $detail_img,
		]);
	}
}
?>