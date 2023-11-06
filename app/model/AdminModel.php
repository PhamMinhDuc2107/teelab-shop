<?php 

class AdminModel extends Model
{
	protected $table = "admin";
	public $allowedColumns =["id", "username", "password", "email"];
}

?>