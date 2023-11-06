<?php 
class BannerModel extends Model
{
	protected $table = "banner";
	public $allowedColumns =["id", "title", "img", "status"];

}
?>