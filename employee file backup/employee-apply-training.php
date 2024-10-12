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
                                              Apply For Training
                                          </div>
                                      </div>
                                       <div class="panel-body">
                                        <?php if(isset($_GET['admin']) == "admin"){
                                        echo "<div class=\"alert alert-danger\">" . "Please Select Your Admin" . "</div>";
                                        }
                                        ?>
                                              <form action="action_page.php" method="post">
                                                      <div class="form-group">
                                                        <label for="email">Select Training Type:</label>
                                                        <select class="form-control" name="training_code" id="mySelect" required="required">
                                                          <option value="" >--Please Select Training Type--</option>
                                                           <?php 
                                                                $sql = "SELECT `TrainingsType code`, `TrainingsType name`, `Type` FROM tbltrainingstypes";
                                                                $stmt= $conn->prepare($sql);
                                                                $stmt->execute();
                                                                $result = $stmt->get_result();
                                                                if($result->num_rows > 0){
                                                                  while ($row = $result->fetch_assoc()) {
                                                                    # code...
                                                                    echo "<option value=\"{$row['TrainingsType code']}\">{$row['TrainingsType name']}</option>";
                                                                  }
                                                                }
                                                                 ?>                                         
                                                      </select>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="email">Select Approving Manager:</label>
                                                        <select class="form-control" name="trainingadmin_id" id="mySelect" required="required">
                                                          <option value="" >--Please Select Approving Manager--</option>
                                                           <?php 
                                                              $sql = "SELECT `User ID`, `Full name`, `Type` FROM tblaccess";
                                                              $stmt= $conn->prepare($sql);
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
                                                        <label for="subject">Subject:</label>
                                                        <input type="text" class="form-control" id="subject" name="training_subject" maxlength="100" required="required">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="comment">Body:</label>
                                                        <textarea class="form-control" rows="5" id="comment" name="training_body" required="required"></textarea>
                                                      </div>
                                                      <input type="submit" name="applytraining" value="Apply" class="btn btn-success" onclick="return confirm('Are you sure you want to apply for this Training?')">
                                            </form>        
                                      </div>
                          </div>
            </div>           
       </div>
  <?php include_once("includes/footer.php"); ?>