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

                                <?php if(isset($_GET['trainingapply']) == "success"){
                                        echo "<div class=\"alert alert-info\">" . "Training application submitted successfully" . "</div>";
                                      }
                                      ?>
                                         <div class="breadcrumb1">
                                              <div class="bread-title">
                                                  <h1>Training Application History</h1>
                                              </div>
                                          </div>
                                        <div class="spacebar"></div>
                                         <table class="table table-hover">
                                               <tr class="thbg">
                                                 <th>Date</th>
                                                 <th>Subject</th>
                                                 <th>Training Type</th>
                                                 <th>Body</th>
                                                 <th>Status</th>
                                                 <th>Manager's Remark</th>
                                               </tr>
                                               <?php
                                                $user_id = $_SESSION['user_id']; 
                                                $sql = "SELECT a.`Date`, a.`Subject`, a.`Body`, a.`Approved`, a.`Remark`,b.`TrainingsType name` FROM tbltrainingsapplications a JOIN tbltrainingstypes b ON a.`TrainingCode`= b.`TrainingsType code` WHERE a.`User ID` = ?  ORDER BY a.`Date` DESC";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("i",$user_id);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                               while($row = $result->fetch_array()){
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
                                                 <td><?php echo $training_date =date('d-M-Y',strtotime($row['Date'])) ; ?></td>
                                                 <td><?php echo $row['Subject']; ?></td>
                                                 <td><?php echo $row['TrainingsType name']; ?></td>
                                                 <td><?php echo custom_echo($row['Body'],50); ?></td>
                                                 <td><?php echo $status; ?></td>
                                                 <td><?php echo $row['Remark']; ?></td>
                                                 </tr>
                                                <?php
                                               } ?>
                                              
                                          </table> 
            </div>  
       </div>
  <?php include_once("includes/footer.php"); ?>