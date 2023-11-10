<?php 

class OrderDetailModel extends Model
{
	protected $table = "order_detail";
	public $allowedColumns =["id", "order_id", "product_id", "quantity", 'price'];

}
?>