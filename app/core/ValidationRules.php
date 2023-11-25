<?php
   class ValidationRules
   {
      public static function isRequired($value){
         if (filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
          return true;
       }
       return false;	
       
     }
     public static function email($email){
         return filter_var($email, FILTER_VALIDATE_EMAIL);
     }
 
 
 
     public static function minLen($str, $args){
   
       return mb_strlen($str, 'UTF-8') >= (int)$args;
     }
 
     public static function maxLen($str, $args){
         return mb_strlen($str, 'UTF-8') <= (int)$args;
     }
    public static function integer($value){
         return filter_var($value, FILTER_VALIDATE_INT);
     }
 
    public static function alphaNum($value){
         return preg_match('/\A[a-z0-9]+\z/i', $value);
     }
   }
?>