<?php
Class Controller
{
   /**
    * function view 
    * @param string $name
    * @param array $data
    */
   public function view(string $name, array $data = [])
   {  
      $filename = "./app/view/".$name.".view.php";
      if(file_exists($filename)) 
      {
         require_once $filename;
      }else 
      {
         $filename =  "./app/view/client/pages/404.view.php";
         require $filename;
      }
   }
   /**
    * function model()
    * @param string $name
    */
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
   /**
    * function middleware
    * @param string $name
    */
   public function middleware(string $name)
   {  
      $filename = "./app/middleware/".$name.".php";
      if(file_exists($filename)) 
      {
         require_once $filename;
         return new $name();
      }
      return false;
   }
}