<?php
function getSession($key) 
{
   $value = isset($_SESSION["$key"]) ?$_SESSION["$key"]  : false;
   return false;
}
function setSession( $key, $value) 
{
   $_SESSION["$key"] = $value;
}
function removeSession( $key) 
{
   if($_SESSION[$key]) {
      unset($_SESSION[$key]);
   }
}