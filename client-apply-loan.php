<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<!DOCTYPE html>
<html lang="en">
 <?php include_once("includes/head.php"); ?>
 <body style="background-color:#f0f0f7; ">
<?php global $manager; ?>
    <!-- Navigation -->
       <?php include_once("includes/header_menu.php"); ?> 
 
  <?php
  // this is the left side
  include("client/client_dashboard_leftside.php");
   ?>
            <div class="col-md-8"><div class="spacebar"></div>
            <div class="breadcrumb1">
                              <div class="bread-title">
                                  <h1>Apply for Loan</h1>
                              </div>
                        </div>
                        <div class="spacebar"></div>
                         <div class="panel panel-info">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              Please fill all the fields below to apply for a new loan.
                                          </div>
                                      </div>

                                       <div class="panel-body">
                                        <?php if(isset($_GET['admin']) == "admin"){
                                        echo "<div class=\"alert alert-danger\">" . "Invalid Client Code. Application Failed" . "</div>";
                                      }
                                      ?>
                                              <form action="action_page.php" method="post">
                                                       <div class="form-group">
                                                        <label for="loan">Loan Type:</label>
                                                       <select class="form-control" name="loan_type" id="mySelect" required="required">
                                                          <option value="" >--Please Select Loan Type--</option>
                                                         <?php 
                                                                                        $sql = "SELECT `LoansScheme code`,`LoansScheme name` FROM tblloansschemes";
                                                                                          $stmt= $conn->prepare($sql);
                                                                                          //$stmt->bind_param("s",$activated);
                                                                                            $stmt->execute();
                                                                                              $result = $stmt->get_result();
                                                                                        if($result->num_rows > 0){
                                                                                          while ($row = $result->fetch_assoc()) {
                                                                                            ?>
                                                                                            <option value="<?php echo $row['LoansScheme code']; ?>"><?php echo $row['LoansScheme name'] . " - ". $row['LoansScheme code']; ?> </option>
                                                                                            <?php
                                                                                          }
                                                                                        }
                                                                                         ?>                               
                                                      </select>
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="loan">Loan Amount:</label>
                                                        <input type="number" class="form-control" name="loan_amount" id="subject" maxlength="16" required="required" placeholder="Example: 500000">
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="date">Date Applied:</label>
                                                        <input type="date" class="form-control" name="loan_dateapplied" id="subject" required="required" placeholder="Pick date">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="date">Start Date:</label>
                                                        <input type="date" class="form-control" name="loan_startdate" id="subject" required="required" placeholder="Pick date">
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="deduction">Monthly Deduction:</label>
                                                        <input type="number" class="form-control" name="loan_monthlydeduction" id="subject" required="required" placeholder="Example: 35000">
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="subject">Subject:</label>
                                                        <input type="text" class="form-control" name="loan_subject" id="subject" maxlength="100" required="required" placeholder="Enter Subject...">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="comment">Body:</label>
                                                        <textarea class="form-control" rows="5" name="loan_body" id="comment" required="required"></textarea>
                                                      </div>
                                                       <div class="form-group">
                                                        <input type="hidden" name="client_code" value="<?php echo $ecode; ?>">
                                                        <input type="hidden" name="client_email" value="<?php echo $client_email; ?>">
                                                      </div>
                                                      <input type="submit" name="applyloan" value="Apply" class="btn btn-success" onclick="return confirm('Are you sure you want to apply for this loan?')">
                                            </form>        
                                      </div>
                          </div>
            </div>    
       </div>
<?php include_once("includes/footer.php"); ?>