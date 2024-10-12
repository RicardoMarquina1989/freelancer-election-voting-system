<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php'); ?>
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
          <h1>Employee</h1>
      </div>
  </div>
  
</div>
     <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Activation Request</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><!-- <a href="#">Forgot password?</a> --></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post" action="submit-empactivate.php">
                             <?php if(isset($_GET['employee']) AND ($_GET['employee']== 0)){
                                    echo "<p class=\"alert alert-danger\">"; 
                                echo "You are not an employee. Please contact the Admin"; 
                                echo "</p>";
                              }?>
                              <?php if(isset($_GET['employee']) AND ($_GET['employee']== 1)){
                                    echo "<p class=\"alert alert-info\">"; 
                                echo "CONGRATULATIONS! Activation request submitted successfully. You will receive email alert when activated. Thanks"; 
                                echo "</p>";
                              }?>
                                 <?php if(isset($_GET['activated']) AND ($_GET['activated']== 1)){
                                    echo "<p class=\"alert alert-danger\">"; 
                                echo "You have requested for activation before. Please check your mail or contact the Admin. Thanks"; 
                                echo "</p>";
                              }?>                          
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
  <div class="home-image">
    <div class="">
    
    </div>
  </div>
   <div class="spacebar"></div>


  
   <!-- services --> 
  <div class="container">
    <div class="row">       
      <div class="col-md-12">
          <div class="footer-social-media">
            <h4></h4>
                    
          </div>
      </div>      
    </div>
  </div>
  <div class="spacebar"></div> 
    <?php include_once("includes/footer.php"); ?>