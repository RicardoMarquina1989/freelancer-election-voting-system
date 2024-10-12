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

                 
                                <?php if(isset($_GET['leaveapply']) == "success"){
                                        echo "<div class=\"alert alert-info\">" . "Leave Application submitted successfully" . "</div>";
                                      }
                                      ?>
                                         <div class="breadcrumb1">
                                            <div class="bread-title">
                                                <h1>Leave Application History</h1>
                                            </div>
                                        </div>
                                        <div class="spacebar"></div>
                                         <table class="table table-hover">
                                               <tr class="thbg">
                                                 <th>Date Applied</th>
                                                 <th>Leave Type</th>
                                                 <th>Duration(Days)</th>
                                                 <th>Begining Date</th>
                                                 <th>Status</th>
                                                 <th>Manager's Remark</th>
                                               </tr>
                                               <?php 
                                                $user_id = $_SESSION['user_id'];
                                                $sql = "SELECT `Date`, Subject, LeaveType, `Approved`, BeginingDate, Duration, Remark FROM tblleavesapplications WHERE `User ID` = ? ORDER BY `Date` DESC";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("i",$user_id);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                               while($row = $result->fetch_array()){
                                                $leave_date = date('d-M-Y',strtotime($row['Date']));
                                                $begining_date = date('d-M-Y',strtotime($row['BeginingDate']));
                                                 if($row['Approved'] == 'Y'){
                                                  $status = "Approved";
                                                }elseif ($row['Approved'] == 'N') {
                                                  $status = "Pending";
                                                }elseif($row['Approved'] == 'D'){
                                                  $status = "Rejected";
                                                }else{

                                                }
                                                ?>
                                                <tr>
                                                 <td><?php echo format_date($row['Date']); ?></td>
                                                 <td><?php echo $row['LeaveType']; ?></td>
                                                 <td><?php echo $row['Duration']; ?></td>
                                                 <td><?php echo format_date($row['BeginingDate']); ?></td>
                                                 <td><?php echo $status; ?></td>
                                                 <td><?php echo $row['Remark']; ?></td>
                                                 </tr>"; 
                                                 <?php 
                                               } ?>
                                              
                                          </table>
            </div> 
       </div>
<?php include_once("includes/footer.php"); ?>