<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php if(isset($_POST['email']) && isset($_POST['updatepass']) &&
 (!empty($_POST['email']))){
$message="";
$pass1 = test_input($_POST['pass1']);
$pass2 = test_input($_POST['pass2']);
$uppercase = preg_match('@[A-Z]@', $pass1);
$lowercase = preg_match('@[a-z]@', $pass1);
$number = preg_match('@[0-9]@', $pass1);
$specialChars = preg_match('@[^\w]@', $pass1);
$email = $_POST['email'];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
$message = "Password do not match, both password should be same.";

}elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass1) < 8 ) {
			$message = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
}else{
$pass1 = md5($pass1);
$sql = "UPDATE `tblclientsregistrations` SET `Password`= ?, `trn_date`= ? WHERE `Email address`= ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss",$pass1,$curDate,$email);
$result = $stmt->execute();
 if($result === TRUE){
    $del = "DELETE FROM `password_reset_temp` WHERE `email`= ?";
	$stmt = $conn->prepare($del);
	$stmt->bind_param("s",$email);
	$result = $stmt->execute();
  	$message = "Congratulations! Your password has been updated successfully.";
  }else{
    $message = "Not Successful";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
   <?php include_once("includes/head.php"); ?>
 <body style="background-color:#fff; ">
<!-- Navigation -->
    <?php // include_once("includes/login_header_menu.php"); ?> 
    <div class="spacebar"></div>
   <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" >
  <div class="breadcrumb1">
      <div class="bread-title">
          <h1>Password Reset</h1>
      </div>
  </div>
  
</div>
     <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                   

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                       <p class="alert alert-danger"><?php if(!empty($message)){echo $message;} ?><p>

                        </div>                     
                    </div>  
        </div>
        
    </div>
    <?php
}
?>
<?php include_once("includes/footer.php"); ?>