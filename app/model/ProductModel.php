<?php 

class ProductModel extends Model
{
	public $table = "product";
	public $allowedColumns =["id", "name", "price", "discount", 'quantity',"img", "subtext", "category_id","remove"];
	public function getDataProducts() {
		$query = "SELECT product.id, product.name,product.price, product.discount, product.quantity, product.img, categories.title
		FROM $this->table
		JOIN categories
		ON product.category_id = categories.id WHERE product.remove = 0  order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
		$result  = $this->query($query, []);
		if($result) {
			return $result;
		}
		return false;
	}
	public function getDataProduct($data) {
		$query = "SELECT product.id, product.name,product.price, product.discount, product.quantity, product.img,product.category_id,product.subtext, categories.title
		FROM $this->table
		JOIN categories
		ON product.category_id = categories.id WHERE product.id =  :id";
		$result  = $this->query($query, $data);
		if($result) {
			return $result;
		}
		return false;
	}
}
?>