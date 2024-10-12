<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php
  if(isset($_POST['client_submit_msg'])){
    require_once("includes/clientmsg-process.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <?php include_once("includes/head.php"); ?>
 <body style="background-color:#f0f0f7; ">
<!-- Navigation -->
    <?php include_once("includes/header_menu.php"); ?> 
  <?php
  // this is the left side
  include("client/client_dashboard_leftside.php");
   ?>
            <div class="col-md-9">
                        <div class="row">
                            <div class="sendmessage-container col-md-11">
                              <?php
                                  if(isset($_GET['msg']))
                                  {
                                    if($_GET['msg'] = "ok")
                                        {
                                          echo "<h3> Message Sent </h3>";
                                        }
                                  }
                                  else
                                  {
                                    include_once("includes/send_message_form.php");
                                  }
                              ?> 
                            </div>                   
                        </div> 
                
            </div>   <!-- col-md-9 end -->    
       </div>
 <?php include_once("includes/footer.php"); ?>