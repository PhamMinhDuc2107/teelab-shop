<?php
class CheckOrder extends Controller
{
	private $CategoriesModel;
	private $ShippingModel;
	private $OrderDetailModel;
	public function __construct()
	{
		$this->CategoriesModel = $this->model("CategoriesModel");
		$this->ShippingModel = $this->model("ShippingModel");
		$this->OrderDetailModel = $this->model("OrderDetailModel");
	}
	public function index()
	{
		$categories = $this->CategoriesModel->findAll();
		$categorie_actives = $this->CategoriesModel->where(["status" => 1]);
		$this->view("client/layout",[
			"page"=>"check_order",
			"title"=>"Kiểm tra đơn hàng",
			"dataCategories" => $categories,
			"categorie_actives" => $categorie_actives,
			"action"=>"checkOrder/check_order_post",
		]);
	}
	public function check_order_post()
	{
		if($_POST)
		{
			$method = isset($_POST["check_order"]) ? esc($_POST["check_order"]) :"";
			$value = isset($_POST["search_value"]) ? esc($_POST["search_value"]) :"";
			switch ($method) 
			{
				case "madonhang":
					$shipping = $this->ShippingModel->where(['madonhang'=> $value]);
					$shipping_id = $shipping[0]->id;
					$data = $this->ShippingModel->getDataShipping($shipping_id);
					$order_details = $this->OrderDetailModel->getDataOrderDetail($data[0]->id);
					$html = $this->build_table_order($data);
					$html .= $this->build_table_order_detail($order_details);
					echo  $html;
					break;
			}
		}
	}
	public function build_table_order($data) 
	{
		$html = "
		<h2 class='info-title'>Thông tin đơn hàng</h2>
		<table style='width: 100%'>
			<thead class='info-table-heading' style='font-weight: bold; font-size:15px' >
				<tr>
					<td class='info-table-item' style='width:20%; border: 1px solid #eee'>Mã đơn hàng</td>
					<td class='info-table-item' style='width:15%; border: 1px solid #eee'>Ngày</td>
					<td class='info-table-item' style='width:30%; border: 1px solid #eee'>Địa chỉ</td>
					<td class='info-table-item' style='width:15%; border: 1px solid #eee'>Giá trị đơn hàng</td>
					<td class='info-table-item' style='width:20%; border: 1px solid #eee'>Thông tin vận chuyển</td>
				</tr>
			</thead>
			<tbody id='table-content'>";
    for ( $i = 0; $i < count($data); $i++) {
		$method  = "Đang chuẩn bị";
		if($data[$i]->method === 1) {
			$method = "Đang vận chuyển";
	  } else if($data[$i]->method === 2) {
			$method = "Giao hàng thành công";
	  }
		
		$html .= "<tr>";
      $html .= "<td class='info-table-item' style='width:20%; border: 1px solid #eee'>" ."<a style='display:inline-block;text-decoration: underline; color: red' class='order-detail'>".
		$data[$i]->madonhang
		."</a>".'</td>';
      $html .= "<td class='info-table-item' style='width:15%; border: 1px solid #eee' data-id='".$data[$i]->id."'>" .$data[$i]->date.'</td>';
      $html .= "<td class='info-table-item' style='width:30%; border: 1px solid #eee'>" .$data[$i]->address.'</td>';
      $html .= "<td class='info-table-item' style='width:15%; border: 1px solid #eee'>" .number_format($data[$i]->total).'đ</td>';
      $html .= "<td class='info-table-item' style='width:20%; border: 1px solid #eee'>" .$method .'</td>';
	 	$html .= '</tr>';
    }
	 $html .= "</tbody>
		</table>";
    return $html;
	}
	public function build_table_order_detail($data)
	{
		$html = "
		<h2 class='info-title'>Thông tin chi tiết đơn hàng</h2>
		<table style='width: 100%'>
		<thead class='info-table-heading' style='font-weight: bold; font-size:15px' >
			<tr>
				<td class='info-table-item' style='width:10%; border: 1px solid #eee'>Ảnh</td>
				<td class='info-table-item' style='width:60%; border: 1px solid #eee'>Tên sản phẩm</td>
				<td class='info-table-item' style='width:10%; border: 1px solid #eee'>Giá</td>
				<td class='info-table-item' style='width:10%; border: 1px solid #eee'>Giảm giá</td>
				<td class='info-table-item' style='width:10%; border: 1px solid #eee'>Số lượng</td>
			</tr>
		</thead>
		<tbody id='table-content'>";
		foreach ($data as $item) 
		{
			$html.= '<tr>';
			$html .= 	"
			<td class='info-table-item' style='width:10%; border: 1px solid #eee'>
				<img src='".ASSET."uploads/product/".$item->img."' style='display:inline-block'>
			</td>";
			$html .= "<td class='info-table-item' style='width:60%; border: 1px solid #eee'>".$item->name."</td>";
			$html .= "<td class='info-table-item' style='width:10%; border: 1px solid #eee'>".number_format($item->price)."đ</td>";
			$html .= "<td class='info-table-item' style='width:10%; border: 1px solid #eee'>".$item->discount."%</td>";
			$html .= "<td class='info-table-item' style='width:10%; border: 1px solid #eee'>".$item->quantity."</td>";
			$html .= "</tr>";
		}
		$html .= "</tbody>
		</table>";
		return $html;
	}
}
?>