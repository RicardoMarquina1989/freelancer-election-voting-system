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
<?php 
// heade navigation
include("includes/header_menu.php");
?>
<?php
// admin dashboard left side here
include('includes/admin_dashboard_leftside.php');
?>
            <div class="col-md-9"><div class="spacebar"></div>
                <div class="breadcrumb1">
                      <div class="bread-title">
                              <h1>Approve Leave</h1>
                      </div>
            </div>
               <div class="spacebar"></div>
                      <div class="">
                                     <?php include("includes/message_alert.php"); ?>
                                         <table class="table table-hover">
                                               <tr class="thbg">
                                                 <th>Date Applied</th>
                                                 <th>Employee Code</th>
                                                 <th>Subject</th>
                                                 <th>Status</th>
                                                 <th>&nbsp;</th>
                                               </tr>
                                               <?php 
                                                $sql = "SELECT `ApplicationID`, `Date`, `Employee code`, `Subject`, `Approved` FROM tblleavesapplications WHERE `Manager code`=? ORDER BY `Date` DESC LIMIT 100";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("s",$id);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if($result->num_rows > 0){
                                               while($row = $result->fetch_array()){
                                                $date_applied = date('d-M-Y',strtotime($row['Date']));
                                                 if($row['Approved'] == 'Y'){
                                                      $status = "Approved";
                                                    }elseif ($row['Approved'] == 'N') {
                                                      # code...
                                                      $status = "Pending";
                                                    }elseif($row['Approved'] == 'D'){
                                                      $status = "Declined";
                                                    }else{

                                                    }
                                                  echo "<tr>
                                                 <td>{$date_applied}</td>
                                                 <td>{$row['Employee code']}</td>
                                                 <td>{$row['Subject']}</td>
                                                 <td>{$status}</td>
                                                 <td><a href=\"admin-reviewleave.php?appid={$row['ApplicationID']}&case=Leave Application\" class=\"btn btn-success\">Review</a></td>
                                                 </tr>"; 
                                               } 
                                             }?>
                                              
                                          </table>
                      </div>
            </div>  
       </div>
  <?php include_once("includes/footer.php"); ?>