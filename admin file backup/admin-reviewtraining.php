<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['appid']) && (!empty($_GET['appid']))){$appid = intval($_GET['appid']);}?>
<?php if(isset($_POST['declineTraining'])){
  $approved = ACT_D;
  $remark = $_POST['training_remark'];
  $sql = "UPDATE tbltrainingsapplications SET `Approved` = ?, `Remark` = ? WHERE `ApplicationID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi",$approved,$remark,$appid);
  $result = $stmt->execute();
  if($result === TRUE){
    redirect_to("admin-approve-training.php");
  }else{
    $message = "Not Successful";
  }
  }  ?>
<?php if(isset($_POST['approveTraining'])){  
  $approved = ACT_Y;
  $remark = $_POST['training_remark'];
  $sql = "UPDATE tbltrainingsapplications SET `Approved` = ?, `Remark` = ? WHERE `ApplicationID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi",$approved,$remark,$appid);
  $result = $stmt->execute();
  if($result === TRUE){
    redirect_to("admin-approve-training.php");
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
                                  Loan Review
                              </div>
                          </div>
                          <div class="panel-body">
                          <?php include("includes/message_alert.php"); ?>
                          <?php
                          $sql = "SELECT a.`ApplicationID`, a.`Date`, a.`Employee code`, a.`Subject`, a.`Body`,a.`Remark`,b.`TrainingsType code`,b.`TrainingsType name` FROM tbltrainingsapplications a JOIN tbltrainingstypes b ON a.`TrainingCode`=b.`TrainingsType code` WHERE a.`ApplicationID`=? ORDER BY a.`Date` DESC";
                          $stmt = $conn->prepare($sql);
                          $stmt->bind_param("i",$appid);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $row = $result->fetch_array();
                          ?>
                               <form action="admin-reviewtraining.php?appid=<?php echo $row['ApplicationID']; ?>" method="post">
                                         <div class="form-group">
                                          <label for="companyCode">Date Applied:</label>
                                          <input type="text" name="training_date" class="form-control" id="" value="<?php echo $row['Date']; ?>"   autofocus="autofocus" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Employee Code:</label>
                                          <input type="text" name="employee_code" class="form-control" id="" value="<?php echo $row['Employee code']; ?>"   maxlength="100" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Subject:</label>
                                          <input type="text" name="training_subject" class="form-control" id="" value="<?php echo $row['Subject']; ?>"   maxlength="100" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Training Name:</label>
                                          <input type="text" name="training_name" class="form-control" id="" value="<?php echo $row['TrainingsType name']; ?>"   maxlength="100" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Training Code:</label>
                                          <input type="text" name="training_code" class="form-control" id="" value="<?php echo $row['TrainingsType code']; ?>"   maxlength="100" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="body">Body:</label>
                                          <textarea class="form-control" name="training_body" rows="20" id="comment"  disabled="disabled"><?php echo $row['Body']; ?> </textarea>
                                        </div>
                                       <div class="form-group">
                                          <label for="body">Remark:</label>
                                          <textarea class="form-control" name="training_remark" rows="8" id="comment" required="required" > <?php echo $row['Remark']; ?> </textarea>
                                        </div>
                                        <input type="submit" name="approveTraining" value="Approve" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this training?')" >
                                        <input type="submit" name="declineTraining" value="Decline" class="btn btn-danger" onclick="return confirm('Are you sure you want to decline this training?')" style="float:right;">
                                        
                               </form>        
                          </div>
                     </div>
                
                
            </div>
            
           
       </div>
<?php include_once("includes/footer.php"); ?>