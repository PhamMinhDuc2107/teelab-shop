<?php 
class Giohang extends Controller
{
	private $CategoriesModel;
	private $ProductModel;
	private $errors =[];
	public function __construct ()
	{
		$this->CategoriesModel = $this->model("CategoriesModel");
		$this->ProductModel = $this->model("ProductModel");
	}
	public function index()
	{
		$categories = $this->CategoriesModel->findAll();
		$categories_actives = $this->CategoriesModel->where(["status" => 1]);

		$this->view("client/layout",[
			"page"=>"cart",
			"title"=>"Giỏ hàng",
			"dataCategories" => $categories,
			"categories_actives"=>$categories_actives
		]);
	}
	public function add_cart() 
	{
		$id = isset($_POST['id']) ? $_POST['id'] : "";
		$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
		$product = $this->ProductModel->where(['id'=>$id])[0];
		cartAdd($id, $product, $quantity);
		redirect("giohang");
	}
	public function remove_cart($id) 
	{
		removeCart($id);
		redirect("giohang");
	}

	public function add_cart_with_ajax()
	{
		$quantity = isset($_POST["quantity"]) ? +$_POST["quantity"] : "";
		$id = isset($_POST["id"]) ? +$_POST["id"] : "";
		$carts = getSession("carts");
		$product = $this->ProductModel->where(["id" => $id])[0];
		$data = [];
		if($quantity > $product->quantity) {
			$data['mes'] = "Chỉ còn lại $product->quantity sản phẩm";
			$data['quantity'] = $product->quantity;
		}else {
			$carts[$id]['quantity'] = $quantity;
			setSession("carts", $carts);
		}
		$data['data'] = $carts;
		$data['total'] = cartTotalPrice();
		$data['totalQuantity'] = cartTotal();
		echo json_encode($data);
	}
	public function check_quantity_cart() 
	{
		$quantity = isset($_POST["quantity"]) ? +$_POST["quantity"] : "";
		$id = isset($_POST["id"]) ? +$_POST["id"] : "";
		$product = $this->ProductModel->where(["id" => $id])[0];
		$carts = getSession("carts");
		$data = [];
		if (!$carts && +$quantity > +$product->quantity) {
			$data['mes'] = "Sản phẩm chỉ còn lại $product->quantity";
			$data['quantity'] = $product->quantity;
		} else if (isset($carts[$id]) && $carts[$id]['quantity'] + $quantity > $product->quantity) {
			$a = $product->quantity - $carts[$id]['quantity'];
			$data['mes'] = "Sản phẩm chỉ còn lại $a";
			$data['quantity'] = $a;
		}else 
		{
			$data['quantity'] = $quantity;

		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
}
?>