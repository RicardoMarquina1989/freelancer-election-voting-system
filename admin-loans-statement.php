<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_POST['update_statement']) && !empty($_POST['app_id'])){
  $app_id = test_input($_POST['app_id']);
  $sent= ACT_Y;
  $remark = test_input($_POST['remark']);
  $admin_id = test_input($_POST['admin_id']);
  $date_sent = date('Y-m-d H:i:s');
  $sql = "UPDATE tblloansstatementsapply SET `Date sent` = ?, `Sent` = ?, `Remark` = ?, `Sent by User ID` =? WHERE `ApplicationID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssii",$date_sent,$sent,$remark,$admin_id,$app_id);
  $result = $stmt->execute();
  if($result === TRUE){
    $message = "Successful";
  }else{
    $message = "Not Successful";
  }
  }  ?>
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
            <div class="col-md-8"><div class="spacebar"></div>
                            <div class="breadcrumb1">
                                      <div class="bread-title">
                                              <h1>Loans Statement Request</h1>
                                      </div>
                            </div>
                                    <div class="spacebar"></div>
                              <div class="row">
                                              <?php if(!empty($message)){
                                                echo "<div class=\"alert alert-info\">" . $message. "</div>";
                                              }
                                              ?>                             
                              </div>
                              <div class="row">
                                   
                               <table class="table table-striped table-bordered">
                                           <tr class="thbg">
                                            <th>Date Applied</th>
                                             <th>Client Code</th>
                                             <th>Client Name</th>
                                             <th>Loan Type</th>
                                             <th>From</th>
                                             <th>To</th>
                                             <th>Status</th>
                                           </tr>
                                           <?php 
                                           $sentval = ACT_N;
                                            $sqlreq = "SELECT `l`.`ApplicationID`,`l`.`Client code`,`l`.`LoanType`, `l`.`Date applied`, `l`.`FromDate`, `l`.`ToDate`,`c`.`Client name`, `t`.`LoansScheme name` FROM tblloansstatementsapply AS l LEFT JOIN tblclients AS c ON `l`.`Client code`=`c`.`Client code` LEFT JOIN tblloansschemes as t ON `l`.`LoanType`= `t`.`LoansScheme code` WHERE `l`.`Sent`= ? ORDER BY `ApplicationID` ASC LIMIT 50";
                                            $stmt = $conn->prepare($sqlreq);
                                            $stmt->bind_param("s",$sentval);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                           while($rowreq = $result->fetch_assoc()){
                                            ?>
                                            <tr>
                                              <td><?php echo date('d-M-Y',strtotime($rowreq['Date applied'])); ?></td>
                                             <td><?php echo $rowreq['Client code']; ?></td>
                                             <td><?php echo $rowreq['Client name']; ?></td>
                                             <td><?php echo $rowreq['LoansScheme name']; ?></td>
                                             <td><?php echo date('d-M-Y',strtotime($rowreq['FromDate'])); ?></td>
                                             <td><?php echo date('d-M-Y',strtotime($rowreq['ToDate'])); ?></td>
                                             <td><?php echo "Pending"; ?></td>
                                             <!--<td> <form method="post"><input type ="text" name="remark" maxlength="100" required="required"></td>
                                             <input type="hidden"  name="admin_id" value="<?php echo $id; ?>">
                                             <td><input type="submit" name="update_statement" value="Mark Sent" class="btn btn-success">
                                             -->
                                              <input type="hidden" name="app_id" value="<?php echo $rowreq['ApplicationID']; ?>"></form></td> 
                                             </tr> 
                                         <?php 
                                     } ?> 
                                          
                                </table>
                        </div>                
            </div>     
       </div>
<?php include_once("includes/footer.php"); ?>