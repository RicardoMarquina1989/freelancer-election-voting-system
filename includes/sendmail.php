<?php
         $to = "$email_address";
         $subject = "Additt Portal Employee Activation";
         $mail_message = "<h2>Dear ({$surname}), {$firstname}  </h2>";
         $mail_message .= "<b>Your request for activation on Additt Portal has been granted. You can now signin using your email and password</b>";         
         $header = "From:noreply@additt.com \r\n";
         //$header .= "Cc:afgh@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         $retval = mail ($to,$subject,$mail_message,$header);
         if( $retval == true ) {   
         }else {   
         }
      ?>