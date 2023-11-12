<?php
   class AdminMiddleware {
      public function handle() {
         if (!getSession("login")) {
            redirect("cpanel/login");
            exit();
         }
      }
   }
?>