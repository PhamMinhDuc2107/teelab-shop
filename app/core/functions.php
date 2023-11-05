<?php
function show($data):void 
{
   echo '<pre>';
   print_r($data);
   echo '<pre>';
}
function esc(string $str) 
{
   return htmlspecialchars($str);
}
function redirect($path) 
{
   header("Location:".ROOT."$path");
}
function checkLogin() 
{
   if(!getSession("login") ) {
      redirect("cpanel/login");
   }
}
function unique_img($name) 
{
   $img = isset($_FILES[$name]) ? $_FILES[$name]['name'] :"";
   $div = explode(".", $img);
   $file_ext = strtolower(end($div));
   $unique_img = $div[0].time().".".$file_ext;
   return $unique_img;
}
function upload_list_img (string $path, string $name,int $bytes = 2000000 ,array $rule = ["jpg", "jpeg","webp"]) 
{
   if(isset($_FILES)) {
      $extension = $rule;
      $bytes = $bytes ;
      $path = $path;
      $urlImgs = [];
      foreach ($_FILES[$name]['tmp_name'] as $key =>$value) {
         $name_img = $_FILES[$name]['name'][$key];
         $tmp_img = $_FILES[$name]['tmp_name'][$key];
         $div = explode(".", $name_img);
         $file_ext = strtolower(end($div));
         $unique_img = $div[0].time().".".$file_ext;
         array_push($urlImgs,$unique_img);
         move_uploaded_file($tmp_img,$path.$unique_img);
      }
      show($urlImgs);
   }
   return count($urlImgs) > 0 ? $urlImgs : null;
}
function delete_img($path) 
{
   unlink("assets/uploads/$path");

}