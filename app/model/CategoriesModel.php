<?php 

class CategoriesModel
{
	use Model;
	private $table = "categories";
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