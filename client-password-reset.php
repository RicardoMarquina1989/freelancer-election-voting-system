<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php 
if(isset($_POST['passreset']) && (!empty($_POST["email_address"]))){    
      $email_address = test_input($_POST['email_address']);
      $email_clean = filter_var($email_address, FILTER_SANITIZE_EMAIL);
      $email = filter_var($email_clean, FILTER_VALIDATE_EMAIL);
     if (!$email){
       $message ="Invalid email address please type a valid email address!";
       }
else
       {
       $sql = "SELECT `Email address` FROM `tblclientsregistrations` WHERE `Email address`= ?";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_num_rows($result);
       if ($row==""){
       $message = "No user is registered with this email address!";
       }
      else
      {
   $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
   $expDate = date("Y-m-d H:i:s",$expFormat);
   $key = md5(2418*2+$email);
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $key = $key . $addKey;
// Insert Temp Table
    $sql2 = "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES (?,?,?)";
    $stmt=$conn->prepare($sql2);
    $stmt->bind_param("sss",$email,$key,$expDate);
    $result = $stmt->execute();
    if ($result === TRUE){
                $to = "$email_address";
                $subject = "Password Recovery - GROOMING (STAFF) COOPERATIVE";
                $mail_message.='<p>Please click on the following link to reset your password.</p>';
                $mail_message.='<p>-------------------------------------------------------------</p>';
                $mail_message.='<a href="https://www.gscms.org/client-change-password.php?
                key='.$key.'& email='.$email.'& action=reset" target="_blank">
                https://www.gscms.org/client-change-password.php
                ?key='.$key.'&email='.$email.'& action=reset</a>';   
                $mail_message.='<p>-------------------------------------------------------------</p>';
                $mail_message.='<p>Please be sure to copy the entire link into your browser.
                The link will expire after 1 day for security reason.</p>';
                $mail_message.='<p>If you did not request this forgotten password email, no action 
                is needed, your password will not be reset. However, you may want to log into 
                your account and change your security password as someone may have guessed it.</p>';    
                $mail_message.='<p>Thanks,</p>';
                $mail_message.='<p>GSCMS Team</p>';         
               $header = "From:noreply@gscms.org \r\n";
               $header .= "MIME-Version: 1.0\r\n";
               $header .= "Content-type: text/html\r\n";
               $retval = mail ($to,$subject,$mail_message,$header);
               $_SESSION['message'] = "An email has been sent to you with instructions on how to reset your password.";
          redirect_to("reset-report.php");
}else{
$_SESSION['message']  = "Sorry! unable to proccess your request.";
redirect_to("reset-report.php");
}
}
}
    }//end of if isset post submit
    ?>
    <!DOCTYPE html>
<html lang="en">
  <?php include_once("includes/head.php"); ?>
 <body style="background-color:#fff; ">


    <!-- Navigation -->
    <header>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <div class="menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href=""></a>
                    </li>
                    <li>
                        <a href=""></a>
                    </li>
                    <li>
                         <a href=""></a>
                    </li>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href=""></a>
                    </li>
                </ul>
               </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</header><div class="spacebar"></div>
   <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" >
  <div class="breadcrumb1">
      <div class="bread-title">
          <h1>Reset Password</h1>
      </div>
  </div>
  
</div>
     <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Reset Link</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><!-- <a href="#">Forgot password?</a> --></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post">
                             <?php if(!empty($message)){ 
                                echo "<p class=\"alert alert-danger\">"; 
                                echo $message; 
                                echo "</p>";
                               } ?>
                             
                                <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="" type="email" class="form-control" name="email_address" value="<?php if(isset($_POST['passreset'])){ echo htmlentities($email_address); }?>" placeholder="Enter Your Email..." required="required">                                        
                                </div>

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <!-- <a id="btn-login" href="" class="btn btn-success">Login  </a> -->
                                     <input type="submit" name="passreset" class="btn btn-success" value="Reset">
                                     

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 control">
                                      
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
        
    </div>
    <!-- login -->
<?php require_once("includes/footer.php"); ?>