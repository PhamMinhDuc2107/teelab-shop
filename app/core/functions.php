<?php
function show($data):void {
   echo '<pre>';
   print_r($data);
   echo '<pre>';
}
function esc(string $str) {
   return htmlspecialchars($str);
}
function redirect($path) {
   header("Location:".ROOT."$path");
}
function checkLogin() {
   if(getSession("login")  || $_COOKIE['user']) {
      redirect("admin");
   }else {
      redirect("admin/login");
   }
}