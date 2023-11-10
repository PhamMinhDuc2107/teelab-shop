<?php 

class CouponModel extends Model
{
	protected $table = "coupons";
	public $allowedColumns =["id", "code", "discount_amount","quantity", "start", "end" ];

}

?>