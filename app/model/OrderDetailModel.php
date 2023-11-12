<?php 

class OrderDetailModel extends Model
{
	protected $table = "order_detail";
	public $allowedColumns =["id", "order_id", "product_id", "quantity", 'price'];
	public function getDataOrderDetail($id)
	{
		$query = "SELECT order_detail.product_id, order_detail.order_id, product.img,order_detail.quantity,order_detail.price,product.name,product.discount
		FROM order_detail
		JOIN product ON order_detail.product_id = product.id
		WHERE order_detail.order_id = $id;
		";
		$result  = $this->query($query, []);
		if($result) {
			return $result;
		}
		return false;
	}
}
?>