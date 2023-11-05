<?php 

class AdminModel extends Model
{
	protected $table = "admin";
	protected $allowedColumns =["id", "username", "password", "email"];
}

?>