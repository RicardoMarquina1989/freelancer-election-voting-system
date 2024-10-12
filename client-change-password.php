<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php 
$error ="";
if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
&& ($_GET["action"]=="reset") && !isset($_POST["action"])){
  $key = $_GET["key"];
  $email = $_GET["email"];
  $curDate = date("Y-m-d H:i:s");
  $query = "SELECT * FROM `password_reset_temp` WHERE `key`= ? AND `email`= ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ss",$key,$email);
  $stmt->execute();
 $result = $stmt->get_result();
 //$row = mysqli_num_rows($result);
    if($result->num_rows== NULL ){
  $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is 
deactivated.</p>
<p><a href="https://www.gscms.org/client-password-reset.php">
Click here</a> to reset password.</p>';
  }else{
  $row = $result->fetch_array();;
  $expDate = $row['expDate'];
  if ($expDate >= $curDate){
  ?>
  <br />
  <!DOCTYPE html>
<html lang="en">
  <?php include_once("includes/head.php"); ?>
 <body style="background-color:#fff; ">


    <!-- Navigation -->
    <div class="spacebar"></div>
   <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" >
  <div class="breadcrumb1">
      <div class="bread-title">
          <h1>Change Password</h1>
      </div>
  </div>
  
</div>
     <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Change Password</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><!-- <a href="#">Forgot password?</a> --></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post" action="resetpass.php">
                             <?php if(!empty($message)){ 
                                echo "<p class=\"alert alert-danger\">"; 
                                echo $message; 
                                echo "</p>";
                               } ?>
                             
                                <div style="margin-bottom: 25px" class="input-group">
                                        <input type="hidden" class="form-control" name="email" value="<?php echo $email;?>">                                        
                                </div>
                                 <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><label>New Password</label></span>
                                        <input id="pass" type="password" class="form-control" name="pass1" maxlength="30" required="required">                                        
                                </div>
                                 <div style="margin-bottom: 25px" class="input-group">
                                  
                                        <span class="input-group-addon"><label>Confirm Password</label></span>
                                        <input id="pass" type="password" class="form-control" name="pass2" maxlength="30" required="required">                                        
                                </div>
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <!-- <a id="btn-login" href="" class="btn btn-success">Login  </a> -->
                                     <input type="submit" class="btn btn-success" name="updatepass" value="Update Password">
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
<?php
}else{
$error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which 
as valid only 24 hours (1 days after request).<br /><br /></p>";
            }
      }
if($error!=""){
  echo "<div class='error'>".$error."</div><br />";
  }     
} // isset email key validate end
?>
    <!-- login -->
<?php require_once("includes/footer.php"); ?>