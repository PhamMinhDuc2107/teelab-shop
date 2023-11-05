<?php 

class ProductModel extends Model
{
	protected $table = "product";
	protected $allowedColumns =["id", "name", "price", "discount", 'quantity',"img", "subtext", "category_id","delete"];
	public function getDataProduct() {
		$query = "SELECT product.id, product.name,product.price, product.discount, product.quantity, product.img, categories.title
		FROM $this->table
		JOIN categories
		ON product.category_id = categories.id";
		$result  = $this->query($query, []);
		if($result) {
			return $result;
		}
		return false;
	}
}
?>