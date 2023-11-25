<?php 
class Product extends Controller
{
	private $ProductModel;
	private $ProductImgModel;
	private $CategoriesModel;
	private $AuthMiddleware;
	private $PermissionMiddleware;
	public function __construct() 
	{
		$this->AuthMiddleware = $this->middleware("AdminMiddleware");
		$this->AuthMiddleware->handle();
		$this->PermissionMiddleware = $this->middleware("PermissionMiddleware");
		$this->ProductModel = $this->model("ProductModel");
		$this->ProductImgModel = $this->model("ProductImgModel");
		$this->CategoriesModel = $this->model("CategoriesModel");
		
	}
	public function index() 
	{
		$this->PermissionMiddleware->handle("product");

		if(isset($_GET['page']) && $_GET['page'] !== "")
		{
			$this->ProductModel->offset = (esc($_GET['page']) - 1 ) * $this->ProductModel->limit;
		}
		if(isset($_GET['col']) && $_GET['col'] !== "") {
			$this->ProductModel->order_column = esc($_GET['col']);
		}
		if(isset($_GET['order']) && $_GET['order'] !== "") {
			$this->ProductModel->order_type = esc($_GET['order']);
		}
		if(isset($_GET['q']) && $_GET['q'] !== "") 
		{
			$q = esc($_GET['q']);
			$col_name = ['name', "category"];
			$products = $this->ProductModel->getDataSearch($col_name, $q);
		}else 
		{
			$products = $this->ProductModel->getDataProducts();
		}
		$count = $this->ProductModel->getTotalRecords();
		$limit = $this->ProductModel->limit;
		$per_page = ceil($count/$limit);		
		$this->view("cpanel/layout", [
			"title" => "List Product - Dashboard",
			"page"=>"products/index",
			"heading" => "Product",
			'data' => $products,
			"pagination" => $per_page,
			"col" => $this->ProductModel->allowedColumns,
		]);
	}
	public function add_product() 
	{
		$this->PermissionMiddleware->handle("product/add_product");

		$categories = $this->CategoriesModel->getAll();
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
			"subtext" => $subtext,"img" => $unique_img, "category_id" => $category,"remove" => 0];
			$id = $this->ProductModel->insert_get_id($data);
			if(isset($id)) 
			{
				move_uploaded_file($file_tmp,$path_upload);
				$dataImgs = upload_list_img($path, "image-details", 2000000, ["jpg", "jpeg","webp"]);
				foreach($dataImgs as $item) 
				{
					$data = ["product_id" => $id, "img" => $item];
					$this->ProductImgModel->insert($data);
				} 
				$messager['mes'] = "Thêm sản phẩm thành công!";
				redirect('product?msg='.urldecode(serialize($messager)));
			}
		}
	}
	public function edit_product ($id) 
	{
		$this->PermissionMiddleware->handle("product/edit_product");

		$product = $this->ProductModel->getDataProduct(["id" => $id]);
		$categories = $this->CategoriesModel->findAll();
		$this->view("cpanel/layout", [
			"title" => "Edit Product - Dashboard",
			"page"=>"products/form_product",
			"heading" => "Edit Product",
			"product" =>$product,
			"action"=>"product/edit_product_post/$id",
			"dataCategories" => $categories,
		]);

	}
	public function edit_product_post ($id)
	{
		$name = isset($_POST['name']) ? $_POST['name'] : "";
		$price = isset($_POST['price']) ? $_POST['price'] : "";
		$discount = isset($_POST['discount']) ? $_POST['discount'] : "";
		$quanity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
		$subtext = isset($_POST['subtext']) ? $_POST['subtext'] : "";
		$subtext = json_encode($subtext);
		$category = isset($_POST['category']) ? $_POST['category'] : "";
		$img = isset($_FILES['image']) ? $_FILES['image'] : "";
		$img_detail = isset($_FILES['image']) ? $_FILES['image'] : "";
		$img_detail = isset($_FILES['image-details']) ? $_FILES['image-details'] : "";
		$tmp_img = $img['tmp_name'];
		$path = "assets/uploads/product/";
		$product = $this->ProductModel->where(["id" => $id]);
		if(empty($tmp_img)) {
			$data = ["name" => $name, "price" =>$price, "discount" => $discount,"quantity" =>$quanity, 
			"subtext" => $subtext, "category_id" => $category,"remove" => 0];
			$this->ProductModel->update($id,$data);
			$messager['mes'] = "Sửa sản phẩm thành công!";
			redirect('product?msg='.urldecode(serialize($messager)));
		}else 
		{
			if(file_exists($path.$product[0]->img))
			{
				delete_img("product/".$product[0]->img);
			}
			$unique_img = unique_img("image");
			$path_upload = $path.$unique_img;
			move_uploaded_file($tmp_img, $path_upload);
			$data = ["name" => $name, "price" =>$price, "discount" => $discount,"quantity" =>$quanity, 
			"subtext" => $subtext, "category_id" => $category,"remove" => 0, "img" => $unique_img];
			$this->ProductModel->update($id,$data);
			$messager['mes'] = "Sửa sản phẩm thành công!";
			redirect('product?msg='.urldecode(serialize($messager)));
		}
		if(!empty($img_detail['name'])) 
		{
			$img_details = $this->ProductImgModel->where(['product_id'=>$id]);
			foreach($img_details as $item )
			{
				$this->ProductImgModel->delete($item->id);
			}
			if(isset($img_details))
			{
				foreach($img_details as $item) {
					delete_img("product/".$item->img);
				}
			}
			$data_img_details = upload_list_img("assets/uploads/product/", "image-details");
			foreach($data_img_details as $item) 
			{
				$data = ["product_id" => $id, "img" => $item];
				$this->ProductImgModel->insert($data);
				$messager['mes'] = "Sửa sản phẩm thành công!";
				redirect('product?msg='.urldecode(serialize($messager)));
			} 
		}

	}
	public function delete_product($id) 
	{
		$this->PermissionMiddleware->handle("product/delete_product");
		
		$product = $this->ProductModel->where(["id" => $id]);
		if($product)
		{
			$this->ProductModel->update($id,["remove" => 1]);
			$messager['mes'] = "Xoá sản phẩm thành công!";
			redirect('product?msg='.urldecode(serialize($messager)));
		}
	}
}
?>