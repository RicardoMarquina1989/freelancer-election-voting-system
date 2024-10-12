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
            <div class="col-md-7"><div class="spacebar"></div>
                     <div class=" panel panel-info">
                          <div class="panel-heading">
                              <div class="panel-tilte">
                                  Create Announcement
                              </div>
                          </div>
                          <div class="panel-body">
                               <form action="action_page.php" method="post">
                                     <div class="form-group">
                                      <label for="companyCode">Date:</label>
                                      <input type="date" name="annc_date" class="form-control" id="" placeholder="Enter Announcement Date..." required="required"  autofocus="autofocus">
                                    </div>
                                    <div class="form-group">
                                      <label for="vacancyCategory">Title:</label>
                                      <input type="text" name="annc_title" class="form-control" id="" placeholder="Enter Announcement Title..." required="required" maxlength="100">
                                    </div>
                                     <div class="form-group">
                                      <label for="email">Select Recipient:</label>
                                      <select class="form-control" name="annc_recipient" id="mySelect" required="required">
                                        <option value="" >--Please Select Recipient--</option>
                                        <option value="E">Employee</option>
                                        <option value="C">Candidate</option>                    
                                    </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="body">Body:</label>
                                      <textarea class="form-control" name="annc_body" rows="15" id="comment" required="required"></textarea>
                                    </div>
                                    <input type="submit" name="saveAnnc" value="Save" class="btn btn-success">          
                           </form>        
                          </div>
                     </div>  
            </div>    
       </div>
<?php include_once("includes/footer.php"); ?>