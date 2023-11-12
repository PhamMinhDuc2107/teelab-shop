<?php 

class OrderModel extends Model
{
	protected $table = "orders";
	public $allowedColumns =["id", "shipping_id", "coupon_id", "quantity","total", "date", "order_status"];
	public function getDataOrder() {
		$query = "SELECT orders.id, orders.quantity, orders.total, orders.date, orders.order_status, shipping.name, shipping.madonhang,coupons.code
		FROM orders
		JOIN shipping ON orders.shipping_id = shipping.id
		LEFT JOIN coupons ON orders.coupon_id = coupons.id;
		";
		$result  = $this->query($query, []);
		if($result) {
			return $result;
		}
		return false;
	}
}
?>