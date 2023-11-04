<?php 
class App {
   public $controller ='home';
   public $action= 'index';
   public $params =[];
   function __construct () {
      $url = $this->progressUrl();
      if($url != null) {
         $this->controller = ucfirst($url[0]);
         unset($url[0]);
      }
      $filename = './app/controller/'.ucfirst($this->controller).'.php';
      if (file_exists($filename)) {
         require_once $filename;
      } else {
         $filename = './app/controller/NotFound.php';
         require $filename;
         $this->controller = "NotFound";
      }
      $this->controller = new $this->controller();
      if(isset($url[1])) {
         if(method_exists($this->controller, $url[1])) {
            $this->action = $url[1];
            unset ($url[1]);
         }
      }
      $this->params = $url ? array_values($url) : [];
      call_user_func_array([$this->controller, $this->action], $this->params);
   }

   function progressUrl() {
      $url = isset($_GET['url'] )?$_GET['url'] : null;
      if($url != null) {
         $url = explode("/", filter_var(trim($url,"/")));
      }
      return $url;
   }
}
?>