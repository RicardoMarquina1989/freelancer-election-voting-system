<?php require_once("includes/session.php");?>
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
          <h1>Member Registration</h1>
      </div>
  </div>
  
</div>
     <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                   

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post" action="submit-empactivate.php">
                            
                           
                            <h4><?php if(isset($_GET['success']) && ($_GET['success'] == "no")){ 
                        echo "Sorry your registration could not be completed at the moment. Please try again later"; 
                         } ?></h4>
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <a id="btn-login" href="index.php" class="btn btn-success">Continue...  </a>
                                     
                                     

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="padding-top:15px; font-size:85%" >
                                           
                                        <!--<a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Click here to register
                                        </a> -->
                                       
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
        
    </div>
    <!-- login -->
  <?php include_once("includes/footer.php"); ?>