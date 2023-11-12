<?php 

class PermissionModel extends Model
{
	protected $table = "permission";
	public $allowedColumns =["id", "admin_id", "rule_id"];
	public function getDataPermissionWithAdminId($admin_id) {
		$query = "SELECT permission.id, permission.admin_id, rules.name, rules.url
		FROM $this->table
		JOIN rules
		ON permission.rule_id = rules.id
		WHERE permission.admin_id = $admin_id
		order by $this->order_column $this->order_type limit $this->limit offset $this->offset ";
		$result  = $this->query($query, []);
		if($result) {
			return $result;
		}
		return false;
	}

}
?>