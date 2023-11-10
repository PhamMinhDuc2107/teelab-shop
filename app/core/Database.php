<?php 
Trait Database
{

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
   public function query_id($query, $data = [])
   {
      $con = $this->connect();
      $stm = $con->prepare($query);
      if($stm->execute($data))
      {
         return $con->lastInsertId();
         
      }
   }
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


