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
          <h1>Employee</h1>
      </div>
  </div>
  
</div>
     <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Activation Request Form</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><!-- <a href="#">Forgot password?</a> --></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post" action="submit-empactivate.php">
                              <?php if(isset($_GET['mismatch']) AND ($_GET['mismatch']== 1)){
                                    echo "<p class=\"alert alert-danger\">"; 
                                echo "Password Not Match. Please calm down and enter your information correctly"; 
                                echo "</p>";
                              }?>
                                    
                                     <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon">EMAIL</span>
                                        <input id="login-username" type="email" class="form-control" name="empl_email" value="" placeholder="Enter Your Email..." maxlength="30" required="required">                                        
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon">EMPLOYEE CODE</span>
                                        <input id="ecode" type="text" class="form-control" name="empl_code" value="" placeholder="Enter Your Employee Code..." maxlength="20" required="required">
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon">PASSWORD</span>
                                        <input id="login-password" type="password" class="form-control" name="empl_pass1" value="" placeholder="Enter Your Password..." maxlength="20" required="required">
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon">RE-TYPE PASSWORD</span>
                                        <input id="login-password" type="password" class="form-control" name="empl_pass2" value="" placeholder="Enter Your Password Again..." maxlength="20" required="required">
                                    </div>

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <!-- <a id="btn-login" href="" class="btn btn-success">Login  </a> -->
                                     <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                     

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
  
  
  
  </body>
</html>