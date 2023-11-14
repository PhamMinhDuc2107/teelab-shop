<?php 

class ShippingModel extends Model
{
	protected $table = "shipping";
	public $allowedColumns =["id", "name", "phone",'email', 'address','note','method', 'madonhang'];
	public function getDataShipping($shipping_id)
	{
		$query = "SELECT orders.id, orders.total, orders.date, shipping.madonhang, shipping.address,shipping.method
		FROM $this->table
		JOIN orders ON $this->table.id = orders.shipping_id
		WHERE $this->table.id = $shipping_id";
		$result  = $this->query($query, []);
		if($result) {
			return $result;
		}
		return false;
	}
}
?>