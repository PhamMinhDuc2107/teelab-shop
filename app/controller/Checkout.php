<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
   class Checkout extends Controller
   {
      private $CouponModel;
      private $OrderModel;
      private $OrderDetailModel;
      private $ShippingModel;
      private $ProductModel;
      private $Email;
      public function __construct()
      {
         $this->CouponModel = $this->model("CouponModel");
         $this->OrderModel = $this->model("OrderModel");
         $this->OrderDetailModel = $this->model("OrderDetailModel");
         $this->ShippingModel = $this->model("ShippingModel");
         $this->ProductModel = $this->model("ProductModel");
         $this->Email= new Email();
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
            $data = ["email" => $email,"name" =>  $name,"phone" =>  $phone, "address" => $address,"note"=> $note, "method" => 0,"madonhang" => $madonhang];
            if($email === "" || $name === '' || $phone === "" || $address ="" || $note === "") 
            {
               redirect("checkout?invalid");
            }
            $total_quantity = cartTotal();
            $total_price = cartTotalPrice();
            $now  =date('Y-m-d H:i:s');
            $carts = getSession("carts");
            $data_mail = [];
            $data_mail['carts'] = $carts;
            $data_mail['data_info'] = $data;
            $payment_method = isset($_POST["paymentMethod"]) ? $_POST["paymentMethod"] :"";
            switch ($payment_method)
            {
               case "cash":
                  $shipping_id = $this->ShippingModel->insert_get_id($data);
                 if($coupon !== "")
                 {
                  $data_coupon = $this->CouponModel->where(['code' => $coupon]);
                  if(isset($data_coupon))
                  {
                    $quantity = $data_coupon[0]->quantity - 1;
                    $this->CouponModel->update($data_coupon[0]->id,['quantity' => $quantity]);
                    $data_mail['coupon'] = $data_coupon[0]->discount_amount;
                    $data_mail['total_price_coupon'] = +$total_price - $data_coupon[0]->discount_amount;
                    $data_orders = [
                     "shipping_id"=> +$shipping_id,
                     "coupon_id" => +$data_coupon[0]->id,
                     "quantity" =>  +$total_quantity,
                     "total" => +$total_price - $data_coupon[0]->discount_amount,
                     "date" => $now,
                     "order_status" => 0
                    ];
                  }
                 }else 
                 {
                  $data_orders = [
                     "shipping_id"=> +$shipping_id,
                     "coupon_id" => null,
                     "quantity" =>  +$total_quantity,
                     "total" => +$total_price,
                     "date" => $now,
                     "order_status" => 0
                    ];
                 }
                 $order_id  =$this->OrderModel->insert_get_id($data_orders);
                 foreach($carts as $cart)
                 {
                  $data_cart = [
                     "order_id" => $order_id ,
                     "product_id" => $cart['id'],
                     "quantity" => $cart["quantity"],
                     "price"=> $cart["price"],
                  ];
                  $this->OrderDetailModel->insert($data_cart);
                  $product = $this->ProductModel->where(['id' => $cart['id']])[0];
                  $data_product  = [
                     "quantity" => $product->quantity - $cart['quantity'],
                  ];
                  $this->ProductModel->update($cart['id'], $data_product);
                 }
                 $this->Email->send_mail("Order Information ", $data_mail, $email);
                 removeSession("carts");
                 redirect("giohang?valid");
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