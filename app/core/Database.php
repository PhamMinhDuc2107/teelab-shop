<?php 
Trait Database
{
   /**
    * func connect()
    * @return string $con
    */
   private function connect()
   {
      try {
         $string = "mysql:hostname=".DB_HOST.";dbname=".DB_NAME;
         $con = new PDO($string,DB_USER,DB_PASS);
         $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $con;
      }catch(PDOException $e)
      {
         echo "". $e->getMessage();
      }
   }
   /**
    * function query
    * @param string $query
    * @param array $data
    * @return array $result
    */
   public function query($query, $data = [])
   {
      $con = $this->connect();
      $stm = $con->prepare($query);
      $check = $stm->execute($data);
      if($check)
      {
         $result = $stm->fetchAll(PDO::FETCH_OBJ);
         if(isset($result))
         {
            return $result;
         }
      }
      return false;
   }
   /**
    * function query_id 
    * @param string $query
    * @param array $data
    * @return 
    */
   public function query_id($query, $data = [])
   {
      $con = $this->connect();
      $stm = $con->prepare($query);
      if($stm->execute($data))
      {
         return $con->lastInsertId();
      }
   }
   /**
    * function get_row 
    * @param string $query
    * @param array $data
    * @return array $result
    */
   public function get_row($query, $data = [])
   {
      $con = $this->connect();
      $stm = $con->prepare($query);
      $check = $stm->execute($data);
      if($check)
      {
         $result = $stm->fetchAll(\PDO::FETCH_OBJ);
         if(is_array($result) && count($result))
         {
            return $result[0];
         }
      }

      return false;
   }
}


