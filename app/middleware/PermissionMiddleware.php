<?php
   class PermissionMiddleware extends Middleware
   {
      private $RuleModel;
      private $PermissionModel;
      public function __construct()
      {
         $this->RuleModel = $this->model("RuleModel");
         $this->PermissionModel = $this->model("PermissionModel");
      }
       public function handle($requiredUrl) 
      {
         $admin_id  = getSession("user")->id;
         $rules = $this->PermissionModel->getDataPermissionWithAdminId($admin_id);
         $admin_rules = [];
         $super_admin = "superadmin";
         if(!empty($rules))
         {
            foreach ($rules as $rule) 
            {
               array_push($admin_rules, $rule->url);
            }
         }else
         {
            redirect("cpanel/forbidden");
         }
         $is_super_admin = in_array($super_admin,  $admin_rules);
         if (!in_array($requiredUrl, $admin_rules) && !$is_super_admin) {
            http_response_code(403);
            redirect("cpanel/forbidden");
            exit();
        }
      }
  }
?>