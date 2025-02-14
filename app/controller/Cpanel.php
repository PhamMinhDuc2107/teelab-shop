<?php

class Cpanel extends Controller
{
   private $AdminModel;
   private $AuthMiddleware;

   public function __construct()
   {
      $this->AdminModel = $this->model("AdminModel");
      $this->AuthMiddleware = $this->middleware("AdminMiddleware");
   }

   public function index()
   {
      $this->AuthMiddleware->handle();
      $this->view("cpanel/layout", [
         "title" => "Admin - Dashboard",
         "page" => "dashboard/dashboard",
         "heading" => "Dashboard",
      ]);
   }
   public function login()
   {
      if (getSession("login")) {
         redirect("cpanel");
      }
      $this->view("cpanel/layoutAuth", [
         "title" => "Login - Dashboard",
      ]);
   }

   public function login_post()
   {
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
         $username = $_POST['username'] ?? "";
         $password = $_POST['password'] ?? "";
         $remember = isset($_POST['remember']) ? 1 : 0;

         $user = $this->AdminModel->where(["username" => $username]);

         if (!empty($user) && password_verify($password, $user[0]->password)) {
            setSession("login", true);
            setSession("user", [
               "id" => $user[0]->id,
               "username" => $user[0]->username,
               "role" => $user[0]->role ?? "admin"
            ]);

            if ($remember == 1) {
               $token = bin2hex(random_bytes(32)); // Tạo token bảo mật
               setcookie("user", "usr=" . $user[0]->username . "&hash=" . $token, time() + (3600 * 24 * 30), "/", "", false, true);
               // Lưu token vào database (cột `remember_token` cần có trong bảng Admin)
               $this->AdminModel->update(["remember_token" => $token], ["id" => $user[0]->id]);
            }

            redirect("cpanel");
         } else {
            redirect("cpanel/login?invalid");
         }
      }
   }

   public function logout()
   {
      $this->AuthMiddleware->handle();

      if (isset($_COOKIE['user'])) {
         setcookie("user", "", time() - 3600, "/", "", false, true);
      }

      removeSession("login");
      removeSession("user");
      redirect("cpanel/login");
   }

   public function forbidden()
   {
      $this->view("cpanel/layout", [
         "title" => "Forbidden - Dashboard",
         "page" => "Forbidden/index",
         "heading" => "",
      ]);
   }
}
?>
