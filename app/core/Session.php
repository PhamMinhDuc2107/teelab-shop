<?php
function getSession($key) 
{
   $value = isset($_SESSION["$key"]) ?$_SESSION["$key"]  : false;
   if($value) {
      return $value;
   }
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

function cartAdd($id,$product, $quantity)
{
   $carts = getSession("carts");
   if(isset($carts[$id])) 
   {
      $carts[$id]['quantity'] = $carts[$id]['quantity'] >= $product->quantity ||
      $carts[$id]['quantity'] + $quantity >= $product->quantity||
      $carts[$id]['quantity'] > $product->quantity ? 
      $product->quantity : 
      $carts[$id]['quantity'] + $quantity;
   }else 
   {
      $carts[$id] = [
         'id' => $id,
         'name' => $product->name,
         'img' => $product->img,
         'quantity' => $quantity >= $product->quantity ? $product->quantity : $quantity ,
         'price' => $product->price,
         'discount' => $product->discount,
      ];
   }
   setSession("carts", $carts);
}
function removeCart($id) 
{
   $carts = getSession("carts");
   if($carts[$id])
   {
      unset($carts[$id]);
   }
   setSession("carts", $carts);
}
function cartTotal()
{
   $carts = getSession("carts");
   $number = 0;
   if(!empty($carts) && is_array($carts))
   {
      foreach($carts as $cart)
      {
         $number += +$cart['quantity'];
      }
   }
   return $number;
}
function cartTotalPrice()
{
   $carts = getSession("carts");
   $number = 0;
   if(!empty($carts) && is_array($carts))
   {
      foreach($carts as $cart)
      {
         $price = $cart['price'] - ($cart['price'] * $cart['discount'] / 100);
         $number += $price * +$cart['quantity']; 
      }
   }
   return $number;
}