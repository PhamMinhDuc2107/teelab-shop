<?php 

class CategoriesModel extends Model
{
	protected $table = "categories";
	public $allowedColumns =["id", "title", "slug", "status"];

	public function getCategories() 
	{
		$result = $this->findAll();
		if($result) {
			return $result;
		}
		return false;
	}

}

?>