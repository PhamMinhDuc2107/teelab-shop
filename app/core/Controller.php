<?php
Class Controller
{
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