<!DOCTYPE html>
<html lang="en">
   <?php include_once("includes/head.php"); ?>
 <body style="background-color:#fff; ">
<!-- Navigation -->
    <?php include_once("includes/login_header_menu.php"); ?> 
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
                            
                        <?php if(!empty($message)){echo $message;} ?>

                         <a id="btn-login" href="index.php" class="btn btn-success">Continue...  </a>
                        </div>                     
                    </div>  
        </div>
        
    </div>
    <!-- login -->
    <?php include_once("includes/footer.php"); ?>
 