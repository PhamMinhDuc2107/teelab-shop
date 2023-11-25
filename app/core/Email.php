<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   class Email extends Controller
   {  
      /**
       * send email
       * @access public
       * @param string $title
       * @param array $data
       * @param string|array $email
       * @param string $view
       * @return void
       */
      public function send_mail(string $title,array $data, string|array  $email ,string $view="client/send_mail")
      {
         $mail = new PHPMailer(true);
         try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = EMAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL;
            $mail->Password = EMAIL_SECRET;
            $mail->SMTPSecure = EMAIL_SMTP_SECURE;
            $mail->Port = EMAIL_PORT;
            $mail->setFrom(EMAIL, 'Oder Information PMD - SHOP');
            $mail->addAddress($email, 'Recipient Name');
            $mail->isHTML(true);
            $mail->Subject = $title;
            ob_start();
            $this->view($view,['data' => $data]);
            $emailBody = ob_get_clean();
             $mail->Body    =  $emailBody;
             $mail->AltBody    = 'Body of the Email';
             $mail->send();
             echo 'Email has been sent successfully!';
         } catch (Exception $e) {
             echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
         }
      }
   }
?>