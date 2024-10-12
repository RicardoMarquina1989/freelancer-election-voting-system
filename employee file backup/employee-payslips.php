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
            <div class="col-md-2"><div class="spacebar"></div>
                 <div class="breadcrumb1">
                      <div class="bread-title">
                          <h1>Pay Slips Listing</h1>
                      </div>
                  </div>
                <div class="spacebar"></div>
                 <table class="table table-hover" style="font-size: 12px; padding: 1px;">
                       <tr class="thbg">
                         <th>Payroll Date </th>
                         <th>&nbsp;</th>
                       </tr>
                       <?php 
                       $user_id = $_SESSION['user_id']; 
                        $sql = "SELECT `Date`, `EmployeeID` FROM tblpayroll WHERE `EmployeeID` = ? ORDER BY `Date` DESC";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i",$user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                       while($row = $result->fetch_array()){
                        $payslip = date('Y M',strtotime($row['Date']));
                        ?>
                        <tr>
                         <td><?php echo $payslip; ?></td>
                         <td align="right"><a href="epayslips.php?empid=<?php echo $row['EmployeeID']; ?>&dt=<?php echo urlencode($row['Date']); ?>&Payslip=preview slip" class="">View</a></td>
                         </tr>
                         <?php
                       } 
                       ?>
                  </table> 
            </div>
       </div>
  <?php include_once("includes/footer.php"); ?>