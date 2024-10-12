<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<!DOCTYPE html>
<html lang="en">
  <?php include_once("includes/head.php"); ?>
 <body style="background-color:#f0f0f7; ">
    <!-- Navigation -->
   <?php include_once("includes/header_menu.php"); ?> 
   <?php
  // admin dashboard left side here
  include('includes/admin_dashboard_leftside.php');
   ?>
            <div class="col-md-5"><div class="spacebar"></div>
                     <div class=" panel panel-info">
                          <div class="panel-heading">
                              <div class="panel-tilte">
                                  Documents
                              </div>
                          </div>
                          <div class="panel-body">
                          <?php include("includes/message_alert.php"); ?>
                               <form action="add_file.php" method="post" enctype="multipart/form-data">
                                                      <div class="form-group">
                                                        <label for="">Document Date:</label>
                                                        <input type="date" name="document_date" class="form-control" id="" placeholder="Enter Document Date..." required="required"  autofocus="autofocus">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="">Document Name:</label>
                                                        <input type="text" name="document_name" class="form-control" id="" placeholder="Enter document name..." required="required"  maxlength="40">
                                                      </div>  
                                                       <div class="form-group">
                                                        <label for="">Upload Document:</label>
                                                        <input type="file" name="uploaded_file" class="" required="required">
                                                      </div>                                                    
                                                      <input type="submit" name="submit" value="Upload File" class="btn btn-success">
                                                      
                                             </form>        
                          </div>
                     </div>
            </div>
       </div>
   <?php include_once("includes/footer.php"); ?>