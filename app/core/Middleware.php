<?php
   class Middleware 
   {
      public function model(string $name)
      {  
         $filename = "./app/model/".$name.".php";
         if(file_exists($filename)) 
         {
            require_once $filename;
            return new $name();
         }
         return false;
      }
      
   }
?>