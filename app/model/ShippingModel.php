<?php 

class ShippingModel extends Model
{
	protected $table = "shipping";
	public $allowedColumns =["id", "name", "phone",'email', 'address','note','method', 'madonhang'];

}
?>