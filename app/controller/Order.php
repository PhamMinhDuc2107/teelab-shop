<?php
   class Order extends Controller
   {
      private $ProductModel;
      private $OrderModel;
      private $ShippingModel;
      private $OrderDetailModel;
      private $AuthMiddleware;
      private $PermissionMiddleware;
      private $Excel ;
      public function __construct()
      {
         $this->AuthMiddleware = $this->middleware("AdminMiddleware");
         $this->AuthMiddleware->handle();
         $this->PermissionMiddleware = $this->middleware("PermissionMiddleware");
         $this->ProductModel = $this->model("ProductModel");
         $this->OrderModel = $this->model("OrderModel");
         $this->ShippingModel = $this->model("ShippingModel");
         $this->OrderDetailModel = $this->model("OrderDetailModel");
         $this->Excel = new Excel();
      }
      public function index()
      {
		   $this->PermissionMiddleware->handle("order");

         if(isset($_GET['page']) && $_GET['page'] !== "")
		   {
			   $this->OrderModel->offset = (esc($_GET['page']) - 1 ) * $this->OrderModel->limit;
		   }
		   if(isset($_GET['col']) && $_GET['col'] !== "") {
			   $this->OrderModel->order_column = esc($_GET['col']);
		   }
		   if(isset($_GET['order']) && $_GET['order'] !== "") {
		   	$this->OrderModel->order_type = esc($_GET['order']);
	   	}
		   if(isset($_GET['q']) && $_GET['q'] !== "") 
		   {
            $q = esc($_GET['q']);
            $col_name = ['madonhang', "name"];
            $products = $this->OrderModel->getDataSearch($col_name, $q);
		   }else 
		   {
		   	$products = $this->OrderModel->getDataOrder();
         }
         $data = $this->OrderModel->getDataOrder();
         
         $this->view("cpanel/layout", [
            "title" => "Manager Order - Orders",
            "page"=>"order/index",
            "heading" => "Orders",
            "data" => $data
         ]);
      }
      /**
      * @param int $id
      * @return void
      */
      public function order_detail($id)
      {
		   $this->PermissionMiddleware->handle("order/order_detail");
         $order = $this->OrderModel->where(['id' => $id])[0];
         $shipping_id = $order->shipping_id;
         $shipping = $this->ShippingModel->where(['id'=> $shipping_id])[0];
         $order_detail = $this->OrderDetailModel->getDataOrderDetail($id);
         $this->view("cpanel/layout", [
            "page"=> "order/order_detail",
            "heading" => "Deail Orders",
            "title" => "Detail Order - Orders",
            'shipping' => $shipping,
            "order" => $order,
            "order_detail" => $order_detail
         ]);
      }
      public function update_order($id)
      {
		   $this->PermissionMiddleware->handle("order/update_order");
         $order = $this->OrderModel->where(["id"=> $id])[0];
         $shipping = $this->ShippingModel->where(["id"=> $order->shipping_id])[0];
         if($shipping->method === 0)
         {
            $this->ShippingModel->update($shipping->id, ['method' => 1]);
         }elseif($shipping->method === 1)
         {
            $this->ShippingModel->update($shipping->id, ['method' => 2]);
            $this->OrderModel->update($id, ['order_status'=> 1]);
         }
         redirect('order/order_detail/'.$id);
      }
      public function export_excel()
      {  
         $data_orders = $this->OrderModel->getDataOrder();
         $data = [];
         if(!empty($data_orders) && count($data_orders) > 0)
         {
            $keys = array_keys((array)$data_orders[0]);
            array_push($data, $keys);
            foreach($data_orders as $item)
            {
               $data_item = [];
               foreach($item as $key => $value)
               {
                  $data_item[$key]  = $value;
               }
               array_push($data, array_values($data_item));            
            };
         }
         $this->Excel->export();
      }
   }
?>