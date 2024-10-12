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
  // this is the left side
  include("employee/employee_dashboard_leftside.php");
   ?>
            <div class="col-md-9"><div class="spacebar"></div>
                         <div class="panel panel-info">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              Apply For a Leave
                                          </div>
                                      </div>

                                       <div class="panel-body">
                                         <?php if(isset($_GET['admin']) == "admin"){
                                        echo "<div class=\"alert alert-danger\">" . "Please Select Your Admin" . "</div>";
                                      }
                                      ?>
                                              <form action="action_page.php" method="post">
                                                        <div class="form-group">
                                                        <label for="email">Leave Type:</label>
                                                        <select class="form-control" name="leave_type" id="mySelect" required="required">
                                                          <option value="" >--Please Select Leave Type--</option>
                                                          <?php 
                                                              $sql = "SELECT `LeavesType name` FROM tblleavestypes";
                                                                $stmt= $conn->prepare($sql);
                                                                $stmt->execute();
                                                                $result = $stmt->get_result();
                                                                if($result->num_rows > 0){
                                                                  while ($row = $result->fetch_assoc()) {
                                                                    # code...
                                                                    echo "<option value=\"{$row['LeavesType name']}\">{$row['LeavesType name']}</option>";
                                                                  }
                                                                }
                                                                 ?>                                       
                                                      </select>
                                                      </div>
                                                        <div class="form-group">
                                                        <label for="email">Leave Year:</label>
                                                        <input type="text" class="form-control" id="email" name="leave_year" maxlength="4" required="required" placeholder="Example: 2018">
                                                      </div>
                                                        <div class="form-group">
                                                        <label for="email">Begining Date:</label>
                                                        <input type="date" class="form-control" id="email" name="leave_beginingdate" maxlength="10" required="required" placeholder="Select Date">
                                                      </div>
                                                        <div class="form-group">
                                                        <label for="email">Leave Duration in days:</label>
                                                        <input type="text" class="form-control" id="email" name="leave_duration" maxlength="3" required="required" placeholder="Example: 10">
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="email">Select Approving Manager:</label>
                                                        <select class="form-control" name="leaveadmin_id" id="mySelect" required="required">
                                                          <option value="" >--Please Select Approving Manager--</option>
                                                           <?php 
                                                          $sql = "SELECT `User ID`, `Full name`, `Type` FROM tblaccess";
                                                          $stmt = $conn->prepare($sql);
                                                          $stmt->execute();
                                                          $result = $stmt->get_result();
                                                          if($result->num_rows > 0){
                                                            while ($row = $result->fetch_assoc()) {
                                                              # code...
                                                              echo "<option value=\"{$row['User ID']}\">{$row['Full name']}</option>"; 
                                                            }
                                                            
                                                          }
                                                           ?>                                         
                                                      </select>
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="email">Subject:</label>
                                                        <input type="text" class="form-control" id="email" name="leave_subject" maxlength="100" required="required" placeholder="Enter Leave Subject...">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="comment">Body:</label>
                                                        <textarea class="form-control" rows="5" id="comment" name="leave_body" required="required"></textarea>
                                                      </div>
                                                      <input type="submit" name="applyleave" value="Apply" class="btn btn-success">
                                             </form>
                                      </div>
                          </div>
            </div>    
       </div>
<?php include_once("includes/footer.php"); ?>