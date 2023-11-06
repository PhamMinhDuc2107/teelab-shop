<?php 

class ProductImgModel extends Model
{
	protected $table = "product_img";
	public $allowedColumns =["id", "product_id", "img"];

}
?>