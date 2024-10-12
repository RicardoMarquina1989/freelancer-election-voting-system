<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['appid']) && (!empty($_GET['appid']))){$appid = intval($_GET['appid']);}?>
<?php if(isset($_POST['declineLeave'])){
  $approved = ACT_D;
  $remark = $_POST['loan_remark'];
  $sql = "UPDATE tblleavesapplications SET `Approved` = ?, `Remark` = ? WHERE `ApplicationID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi",$approved,$remark,$appid);
  $result = $stmt->execute();
  if($result === TRUE){
    redirect_to("admin-approve-leave.php");
  }else{
    $message = "Not Successful";
  }
  }  ?>
<?php if(isset($_POST['approveLeave'])){  
  $approved = ACT_Y;
  $remark = $_POST['loan_remark'];
  $sql = "UPDATE tblleavesapplications SET `Approved` = ?, `Remark` = ? WHERE `ApplicationID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi",$approved,$remark,$appid);
  $result = $stmt->execute();
  if($result === TRUE){
    redirect_to("admin-approve-leave.php");
  }else{
    $message = "Not Successful";
  }
  }  
  ?>
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
                                  Leave Review
                              </div>
                          </div>
                          <div class="panel-body">
                          <?php include("includes/message_alert.php"); ?>
                          <?php
                          $sql = "SELECT `ApplicationID`, `Date`, `Employee code`, `Subject`, `Body`,`Remark` FROM tblleavesapplications WHERE `ApplicationID`=? ORDER BY `Date` DESC";
                          $stmt = $conn->prepare($sql);
                          $stmt->bind_param("i",$appid);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $row = $result->fetch_array();
                          ?>
                               <form action="admin-reviewleave.php?appid=<?php echo $row['ApplicationID']; ?>" method="post">
                                         <div class="form-group">
                                          <label for="companyCode">Date Applied:</label>
                                          <input type="text" name="leave_date" class="form-control" id="" value="<?php echo $row['Date']; ?>"   autofocus="autofocus" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Employee Code:</label>
                                          <input type="text" name="employee_code" class="form-control" id="" value="<?php echo $row['Employee code']; ?>"   maxlength="100" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Subject:</label>
                                          <input type="text" name="leave_subject" class="form-control" id="" value="<?php echo $row['Subject']; ?>"   maxlength="100" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="body">Body:</label>
                                          <textarea class="form-control" name="leave_body" rows="20" id="comment"  disabled="disabled"><?php echo $row['Body']; ?> </textarea>
                                        </div>
                                       <div class="form-group">
                                          <label for="body">Remark:</label>
                                          <textarea class="form-control" name="loan_remark" rows="8" id="comment" required="required" > <?php echo $row['Remark']; ?> </textarea>
                                        </div>
                                        <input type="submit" name="approveLeave" value="Approve" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this leave?')" >
                                        <input type="submit" name="declineLeave" value="Decline" class="btn btn-danger" onclick="return confirm('Are you sure you want to decline this leave?')" style="float:right;">
                                        
                               </form>        
                          </div>
                     </div>
                
                
            </div>
            
           
       </div>
<?php include_once("includes/footer.php"); ?>