<?php
   class Checkout extends Controller
   {
      private $CouponModel;
      private $OrderModel;
      private $OrderDetailModel;
      private $ShippingModel;
      public function __construct()
      {
         $this->CouponModel = $this->model("CouponModel");
         $this->OrderDetail = $this->model("OrderDetail");
         $this->OrderDetailModel = $this->model("OrderDetailModel");
         $this->ShippingModel = $this->model("ShippingModel");
      }
      public function index() 
      {
         $this->view("client/checkout", ["title" => "Thanh toán"]);
      }
      public function check_coupon_ajax()
      {
         $code = isset($_POST['code']) ? esc($_POST['code']) :"";
         $coupon = $this->CouponModel->where(['code' => $code]);
         $data = [];
         if(!empty($coupon))
         {
            $coupon = $coupon[0];
            $data['code'] = $coupon->code;
            $data['discount_amount'] = $coupon->discount_amount;
            $data['quantity'] = $coupon->quantity;
            $data['start'] = $coupon->start;
            $data['end'] = $coupon->end;
         }
         $data['total'] = cartTotalPrice();
         echo json_encode($data);
      }
      public function checkout_post() 
      {
         if($_POST)
         {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $madonhang = substr(str_shuffle($permitted_chars), 0, 15);
            $email = isset($_POST["email"]) ? esc($_POST["email"]) :"";
            $name = isset($_POST["name"]) ? esc($_POST["name"]) :"";
            $phone = isset($_POST["phone"]) ? esc($_POST["phone"]) :"";
            $address = isset($_POST["address"]) ? esc($_POST["address"]) :"";
            $note = isset($_POST["note"]) ? esc($_POST["note"]) :"";
            $coupon = isset($_POST["coupon"]) ? esc($_POST["coupon"]) :"";
            $data = ["email" => $email,"name" =>  $name,"phone" =>  $phone, "address" => $address,"note"=> $note];
            $paymentMethod = isset($_POST["paymentMethod"]) ? $_POST["paymentMethod"] :"";
            switch ($paymentMethod)
            {
               case "cash":
                  $shipping_id = $this->ShippingModel->insert_get_id($data);
                 if(isset($coupon))
                 {
                  $dataCoupon = $this->CouponModel->where(['code' => $coupon]);
                  if(isset($data))
                  {
                    $quantity = $dataCoupon->quantity - 1;
                    $this->CouponModel->update(['quantity' => $quantity]);
                  }
                 }
                 $dataOrders = [
                  ""
                 ]
                 $order_id  =$this->OrderModel->insert_get_id($dataOrders);
                  break;
               case "momo" : 
                  echo"momo";
                  break;
               case "vnpay" : 
                  echo"vnpay";
                  break;
   
            }
         }
      }
   }
?>