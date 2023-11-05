<?php 
class Product extends Controller
{
	private $ProductModel;
	private $ProductImgModel;
	private $CategoriesModel;
	public function __construct() 
	{
		$this->ProductModel = $this->model("ProductModel");
		$this->ProductImgModel = $this->model("ProductImgModel");
		$this->CategoriesModel = $this->model("CategoriesModel");
	}
	public function index() 
	{
		$products = $this->ProductModel->getDataProduct();
		$this->view("cpanel/layout", [
			"title" => "List Product - Dashboard",
			"page"=>"products/index",
			"heading" => "Product",
			'data' => $products
		]);
	}
	public function add_product() 
	{
		$categories = $this->CategoriesModel->findAll();
		$this->view("cpanel/layout", [
			"title" => "Add Product - Dashboard",
			"page"=>"products/form_product",
			"heading" => "Add New Product",
			"action"=>"product/add_product_post",
			"dataCategories" => $categories,
		]);
	}	
	public function add_product_post () 
	{
		if(isset($_POST['submit_category']))
		{
			$name = isset($_POST['name']) ? $_POST['name'] : "";
			$price = isset($_POST['price']) ? $_POST['price'] : "";
			$discount = isset($_POST['discount']) ? $_POST['discount'] : "";
			$quanity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
			$subtext = isset($_POST['subtext']) ? $_POST['subtext'] : "";
			$subtext = json_encode($subtext);
			$category = isset($_POST['category']) ? $_POST['category'] : "";
			$unique_img = unique_img("image");
			$file_tmp = $_FILES['image']["tmp_name"];
			$path = "assets/uploads/product/";
			$path_upload = $path.$unique_img;
			$data = ["name" => $name, "price" =>$price, "discount" => $discount,"quantity" =>$quanity, 
			"subtext" => $subtext,"img" => $unique_img, "category_id" => $category];
			$id = $this->ProductModel->insert_get_id($data);
			if(isset($id)) 
			{
				move_uploaded_file($file_tmp,$path_upload);
				$dataImgs = upload_list_img($path, "image-details", 2000000, ["jpg", "jpeg","webp"]);
				show($dataImgs);
				foreach($dataImgs as $item) 
				{
					$data = ["product_id" => $id, "img" => $item];
					$this->ProductImgModel->insert($data);
				} 
				$messager['mes'] = "Thêm sản phẩm thành công!";
				// redirect('product?msg='.urldecode(serialize($messager)));
			}

		}
	}
}
?>