<?php 

class OrderModel extends Model
{
	protected $table = "orders";
	public $allowedColumns =["id", "shipping_id", "coupon_id", "quantity","total", "date", "order_status"];

}
?>