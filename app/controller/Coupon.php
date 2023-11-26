<?php
   class Coupon extends Controller
   {
      private $CouponModel;
      private $AuthMiddleware;
      private $PermissionMiddleware;
      public function __construct()
      {
         $this->AuthMiddleware = $this->middleware("AdminMiddleware");
		   $this->AuthMiddleware->handle();
         $this->PermissionMiddleware = $this->middleware("PermissionMiddleware");
         $this->CouponModel = $this->model("CouponModel");
         
      }
      public function index()
      {  
		   $this->PermissionMiddleware->handle("coupon");
         if(isset($_GET['page']) && $_GET['page'] !== "")
         {
            $this->CouponModel->offset = (esc($_GET['page']) - 1 ) * $this->CouponModel->limit;
         }
         if(isset($_GET['col']) && $_GET['col'] !== "") {
            $this->CouponModel->order_column = esc($_GET['col']);
         }
         if(isset($_GET['order']) && $_GET['order'] !== "") {
            $this->CouponModel->order_type = esc($_GET['order']);
         }
         if(isset($_GET['q']) && $_GET['q'] !== "") 
         {
            $q = esc($_GET['q']);
            $col_name = ['code', ];
            $coupons = $this->CouponModel->getDataSearch($col_name, $q);
         }else 
         {
            $coupons = $this->CouponModel->findAll();
         }
         $count = $this->CouponModel->getTotalRecords();
         $limit = $this->CouponModel->limit;
         $per_page = ceil($count/$limit);		
         $this->view("cpanel/layout", [
            "title" => "Coupons - Categories",
            "page"=>"coupon/index",
            "heading" => "Coupons",
            "data" => $coupons,
            "pagination" => $per_page,
			   "col" => $this->CouponModel->allowedColumns,
         ]);
      }
      public function add_coupon()
      {
		   $this->PermissionMiddleware->handle("coupon/add_coupon");

         $this->view("cpanel/layout", [
            "title" => "Add Coupons - Coupons",
            "page"=>"coupon/form_coupon",
            "heading" => "Add Coupons",
            "action" => "coupon/add_coupon_post"
         ]);
      }
      public function add_coupon_post()
      {
         if($_POST)
         {  
            $coupons = $this->CouponModel->findAll();
            $code =isset($_POST["code"]) ? esc($_POST["code"]) :"";
            $discount_amount =isset($_POST["discount_amount"]) ? esc($_POST["discount_amount"]) :"";
            $quantity =isset($_POST["quantity"]) ? esc($_POST["quantity"]) :"";
            $date_start =isset($_POST["date_start"]) ? esc($_POST["date_start"]) :"";
            $date_end =isset($_POST["date_end"]) ? esc($_POST["date_end"]) :"";
            $date_start = str_replace("T", " ", $date_start).":00";
            $date_end = str_replace("T", " ", $date_end).":00";
            $data = ["code" => $code, "discount_amount" => $discount_amount, "quantity" => $quantity, "start" => $date_start, "end" => $date_end];
            if($code !== "" || $discount_amount !== "" || $quantity !== "" || $date_start !== ""|| $date_end !== "")
            {
               $this->CouponModel->insert($data);
               $messenger['mes'] = "Thêm mã giảm giá thành công!";
               redirect('coupon?msg='.urldecode(serialize($messenger)));
			   }else 
            {
               $messenger['mes'] = "Thêm mã giảm giá không thành công!";
               redirect('coupon/add_coupon?msg='.urldecode(serialize($messenger)));
			   }
         }
      }
      public function edit_coupon($id)
      {
		   $this->PermissionMiddleware->handle("coupon/edit_coupon");

         $coupon = $this->CouponModel->where(['id' =>$id]);
         $this->view("cpanel/layout", [
            "title" => "Edit Coupons - Coupons",
            "page"=>"coupon/form_coupon",
            "heading" => "Edit Coupons",
            "action" => "coupon/edit_coupon_post/$id",
            "coupon" => $coupon
         ]);
      }
      public function edit_coupon_post($id)
      {
         if($_POST)
         {
            $code =isset($_POST["code"]) ? esc($_POST["code"]) :"";
            $discount_amount =isset($_POST["discount_amount"]) ? esc($_POST["discount_amount"]) :"";
            $quantity =isset($_POST["quantity"]) ? esc($_POST["quantity"]) :"";
            $date_start =isset($_POST["date_start"]) ? esc($_POST["date_start"]) :"";
            $date_end =isset($_POST["date_end"]) ? esc($_POST["date_end"]) :"";
            $date_start = str_replace("T", " ", $date_start).":00";
            $date_end = str_replace("T", " ", $date_end).":00";
            $data = ["code" => $code, "discount_amount" => $discount_amount, "quantity" => $quantity, "start" => $date_start, "end" => $date_end];
            if($code !== "" || $discount_amount !== "" || $quantity !== "" || $date_start !== ""|| $date_end !== "")
            {
               $this->CouponModel->insert($data);
               $messenger['mes'] = "Sửa mã giảm giá thành công!";
               redirect('coupon?msg='.urldecode(serialize($messenger)));
			   }else 
            {
               $messenger['mes'] = "Sửa mã giảm giá không thành công!";
               redirect('coupon/add_coupon?msg='.urldecode(serialize($messenger)));
			   }
         }
      }
      public function delete_coupon($id)
      {
		   $this->PermissionMiddleware->handle("coupon/delete_coupon");
            if($this->CouponModel->delete($id))
            {
               $messager['mes'] = "Xoá mã giảm giá thành công!";
               redirect('coupon?msg='.urldecode(serialize($messager)));
            }
      }
   }
?>