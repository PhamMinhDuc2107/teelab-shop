<?php 

class OrderModel extends Model
{
	protected $table = "orders";
	public $allowedColumns =["id", "shipping_id", "coupon_id", "quantity","total", "date", "order_status"];
	public function getDataOrder() {
		$query = "SELECT orders.id, orders.quantity, orders.total, orders.date, orders.order_status, shipping.name, shipping.madonhang,coupons.code
		FROM orders
		JOIN shipping ON orders.shipping_id = shipping.id
		LEFT JOIN coupons ON orders.coupon_id = coupons.id
		order by $this->order_column $this->order_type limit $this->limit offset $this->offset
		";
		$result  = $this->query($query, []);
		if($result) {
			return $result;
		}
		return false;
	}
	public function gêtSearchOrder($col_name,$q)
	{
		$query = "SELECT orders.id, orders.quantity, orders.total, orders.date, orders.order_status, shipping.name, shipping.madonhang,coupons.code
		FROM orders
		JOIN shipping ON orders.shipping_id = shipping.id
		LEFT JOIN coupons ON orders.coupon_id = coupons.id WHERE ";
      foreach($col_name as $item) 
      {
         $query.= $item." like "."\"%$q%\""." or ";
      }
      $query = trim($query, " or ");
      $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
      return $this->query($query, []);
	}
}
?>