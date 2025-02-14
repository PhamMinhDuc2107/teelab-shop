<?php 
class Model
{
   use Database;
   public $limit     = 12;
   public $offset       = 0;
   public $order_type   = "ASC";
   public $order_column = "id";
   public $errors       = [];
   public function getAll()
   {
      $query = "select * from $this->table order by $this->order_column $this->order_type";
      return $this->query($query);
   }
   public function findAll()
   {
      $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
      return $this->query($query);
   }
   public function getTotalRecords() 
   {
      $query = "select * from $this->table";
      $result = $this->query($query);
      $count = count($result);
      return $count;
   }
   public function getSearchTotalRecords(array $col_name, $q, array $condition = [] ) 
   {
      $query = "select count(*) from $this->table where ";
      if(!empty($condition)) 
      {
         foreach($condition as $key => $value)
         {
            $query .= $key ."= :".$key ." AND ";
         }
      }
      foreach($col_name as $item) 
      {
         $query.= $item." like "."\"%$q%\""." or ";
      }
      $query = trim($query, " or ");
      return $this->query($query, $condition);
   }
   public function getDataSearch(array $col_name,string $q) {
      $query = "select * from $this->table where ";
      foreach($col_name as $item) 
      {
         $query.= $item." like "."\"%$q%\""." or ";
      }
      $query = trim($query, " or ");
      $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
      return $this->query($query, []);
   }
   public function insert_get_id($data) {
      $query = $this->insert_shared($data);
      show($query);
      show($data);
      $id = $this->query_id($query, $data);
      return $id;
   }
   public function where($data, $data_not = [])
   {
      $keys = array_keys($data);
      $keys_not = array_keys($data_not);
      $query = "select * from $this->table where ";

      foreach ($keys as $key) {
         $query .= $key . " = :". $key . " && ";
      }

      foreach ($keys_not as $key) {
         $query .= $key . " != :". $key . " && ";
      }

      $query = trim($query," && ");

      $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
      $data = array_merge($data, $data_not);

      return $this->query($query, $data);
   }
   public function first($data, $data_not = [])
   {
      $keys = array_keys($data);
      $keys_not = array_keys($data_not);
      $query = "select * from $this->table where ";

      foreach ($keys as $key) {
         $query .= $key . " = :". $key . " && ";
      }

      foreach ($keys_not as $key) {
         $query .= $key . " != :". $key . " && ";
      }

      $query = trim($query," && ");

      $query .= " limit $this->limit offset $this->offset";
      $data = array_merge($data, $data_not);

      $result = $this->query($query, $data);
      if($result)
         return $result[0];

      return false;
   }

   public function insert($data)
   {

      /** remove unwanted data **/
      $query = $this->insert_shared($data);
      if(empty($this->query($query, $data))){
         return true;
      }
      return false;
   }

   public function update( $id,$data, $id_column = 'id')
   {

      /** remove unwanted data **/
      if(!empty($this->allowedColumns))
      {
         foreach ($data as $key => $value) {

            if(!in_array($key, $this->allowedColumns))
            {
               unset($data[$key]);
            }
         }
      }

      $keys = array_keys($data);
      $query = "update $this->table set ";

      foreach ($keys as $key) {
         $query .= $key . " = :". $key . ", ";
      }
      $query = trim($query,", ");
      $query .= " where $id_column = :$id_column ";
      $data[$id_column] = $id;
      $result = $this->query($query, $data);
      if(empty($result)) {
         return true;
      }
      return false;
   }

   public function delete($id, $id_column = 'id')
   {
      $data[$id_column] = $id;
      $query = "delete from $this->table where $id_column = :$id_column ";
      $result = $this->query($query, $data);
      if(empty($result)){
         return true;
      }
      return false;
   }
   public function insert_shared($data) 
   {
      if(!empty($this->allowedColumns))
      {
         foreach ($data as $key => $value) {

            if(!in_array($key, $this->allowedColumns))
            {
               unset($data[$key]);
            }
         }
      }
      $keys = array_keys($data);

      $query = "insert into $this->table (".implode(",", $keys).") values (:".implode(",:", $keys).")";
      return $query;
   }
}