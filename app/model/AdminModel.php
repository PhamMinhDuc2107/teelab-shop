<?php 

class AdminModel extends Model
{
	protected $table = "admin";
	public $allowedColumns =["id", "username", "password", "email"];
	public function getAdminAll()
	{
		$query = "SELECT * FROM $this->table";
		$result =  $this->query($query, []);
		if($result)
		{
			return $result;
		}
		return false;
	}
}

?>