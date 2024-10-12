<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['client_id']) && (!empty($_GET['client_id']))){$client_id = intval($_GET['client_id']);}?>
<?php if(isset($_POST['declineclient']) && !empty($_POST['client_id'])){
  $client_id = intval(test_input($_POST['client_id']));
  $approved = ACT_D;
  $email_address = test_input($_POST['client_email']);
  $remark = $_POST['admin_remark'];
  $admin_id = trim($_POST['admin_id']);
  $date_reviewed = date('Y-m-d H:i:s');
  $sql = "UPDATE tbldepositsapplications SET `Date reviewed` = ?, `Reviewed by User ID` =?, `Remark` = ?, `Approved` = ? WHERE `ApplicationID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sissi",$date_reviewed,$admin_id,$remark,$approved,$client_id);
  $result = $stmt->execute();
  if($result === TRUE){
    //send out email
    $to = "$email_address";
               $subject = "GSCMS Portal-Deposit Application";
               //$mail_message = "<h2>Dear ({$surname}), {$firstname}  </h2>";
               $mail_message = "<p> An Admin has reviewed your deposit application and has declined your application with the following remark:</p>";
               $mail_message .= "<p> $remark </p>";         
               $header = "From:noreply@gscms.org \r\n";
               $header .= "MIME-Version: 1.0\r\n";
               $header .= "Content-type: text/html\r\n";
               $retval = mail ($to,$subject,$mail_message,$header);
    $message = "Deposit declined";
  }else{
    $message = "Not Successful";
  }
  }  ?>
<?php if(isset($_POST['approveclient']) && !empty($_POST['client_id'])){  
  $client_id = intval(test_input($_POST['client_id']));
  $approved = ACT_Y;
  $remark = $_POST['admin_remark'];
  $email_address = test_input($_POST['client_email']);
   $date_reviewed = date('Y-m-d H:i:s');
   $admin_id = $_POST['admin_id'];
 $sql = "UPDATE tbldepositsapplications SET `Date reviewed` = ?, `Reviewed by User ID` =?, `Remark` = ?, `Approved` = ? WHERE `ApplicationID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sissi",$date_reviewed,$admin_id,$remark,$approved,$client_id);
  $result = $stmt->execute();
  if($result === TRUE){
    //send out email;
    $to = "$email_address";
               $subject = "GSCMS Portal-Deposit Application";
               //$mail_message = "<h2>Dear ({$surname}), {$firstname}  </h2>";
               $mail_message = "<p> An Admin has reviewed your deposit application and has approved your application with the following remark:</p>";
               $mail_message .= "<p> $remark </p>";         
               $header = "From:noreply@gscms.org \r\n";
               $header .= "MIME-Version: 1.0\r\n";
               $header .= "Content-type: text/html\r\n";
               $retval = mail ($to,$subject,$mail_message,$header);
    $message = "Deposit approved";
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
                                  Deposit Approval Review
                              </div>
                          </div>
                          <div class="panel-body">
                          <?php include("includes/message_alert.php"); ?>
                          <?php
                           $sql = "SELECT `d`.`ApplicationID`, `d`.`ApplicationType`, `d`.`OldDeduction`, `d`.`NewDeduction`, `d`.`Withdrawal amount`, `d`.`StartDate`, `d`.`Date applied`, `d`.`Subject`, `d`.`Client code`,`d`.`Approved`, `d`.`Date reviewed`, `d`.`Reviewed by User ID`, `d`.`Remark`, `a`.`Full name`, `c`.`Surname`,`c`.`First name`,`c`.`Middle name`,`c`.`Email address` FROM tbldepositsapplications AS d LEFT JOIN tblaccess AS a ON `d`.`Reviewed by User ID`= `a`.`User ID` LEFT JOIN tblclientsregistrations AS c ON `d`.`Client code` = `c`.`Client code` WHERE `ApplicationID`=? AND `c`.`Client code`=`d`.`Client code`";
                          $stmt = $conn->prepare($sql);
                          $stmt->bind_param("i",$client_id);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $row = $result->fetch_array();
                          if($row['Approved'] == 'Y'){
                                                  $status = "Approved";
                                                }elseif ($row['Approved'] == 'N') {
                                                  # code...
                                                  $status = "Pending";
                                                }elseif($row['Approved'] == 'D'){
                                                  $status = "Declined";
                                                }else{
                                                    $status = "";
                                                }
                          ?>
                               <form action="admin-deposit-review.php" method="post">
                                         <div class="form-group">
                                          <label for="dateapplied">Date Applied:</label>
                                          <input type="text" name="date_applied" class="form-control" id="" value="<?php if(!empty($row['Date applied'])){echo format_date($row['Date applied']);}else{echo "";} ?>"   autofocus="autofocus" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Client Code:</label>
                                          <input type="text" name="client_code" class="form-control" id="" value="<?php echo $row['Client code']; ?>" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                        <label for="vacancyCategory">Client Name:</label>
                                          <input type="text" name="client_name" class="form-control" id="" value="<?php echo $row['Surname'] ." " . $row['First name'] ." ". $row['Middle name']; ?>"  disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                        <label for="vacancyCategory">Application Type:</label>
                                          <input type="text" name="client_name" class="form-control" id="" value="<?php echo $row['ApplicationType']; ?>"  disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                        <label for="vacancyCategory">Old Deduction:</label>
                                          <input type="text" name="client_name" class="form-control" id="" value="<?php echo $row['OldDeduction']; ?>"  disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                        <label for="vacancyCategory">New Deduction:</label>
                                          <input type="text" name="client_name" class="form-control" id="" value="<?php echo $row['NewDeduction']; ?>"  disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                        <label for="vacancyCategory">Withdrawal Amount(N):</label>
                                          <input type="text" name="client_name" class="form-control" id="" value="<?php echo $row['Withdrawal amount']; ?>"  disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                        <label for="vacancyCategory">Start Date:</label>
                                          <input type="text" name="client_name" class="form-control" id="" value="<?php if(!empty($row['StartDate'])){echo format_date($row['StartDate']);}else echo ""; ?>"  disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                        <label for="vacancyCategory">Purpose:</label>
                                          <input type="text" name="client_name" class="form-control" id="" value="<?php echo $row['Subject']; ?>"  disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Status:</label>
                                          <input type="text" name="status" class="form-control" id="" value="<?php echo $status; ?>"  disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Last Date Reviewed:</label>
                                          <input type="text" name="date_reviewed" class="form-control" id="" value="<?php if(!empty($row['Date reviewed'])){echo format_date($row['Date reviewed']);}else{echo "";} ?>" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Last Reviewed By:</label>
                                          <input type="text" name="reviewed_by" class="form-control" id="" value="<?php echo $row['Full name']; ?>" disabled="disabled">
                                        </div>            
                                       <div class="form-group">
                                          <label for="body">Remark:</label>
                                          <textarea class="form-control" name="admin_remark" rows="8" id="comment" required="required" > <?php echo $row['Remark']; ?> </textarea>
                                        </div>
                                        <input type="hidden"  name="admin_id" value="<?php echo $id; ?>">
                                        <input type="hidden"  name="client_id" value="<?php echo $row['ApplicationID']; ?>">
                                        <input type="text" hidden="hidden"  name="client_email" value="<?php echo $row['Email address']; ?>">

                                        <input type="submit" name="approveclient" value="Approve" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this Deposit?')" >
                                        <input type="submit" name="declineclient" value="Decline" class="btn btn-danger" onclick="return confirm('Are you sure you want to decline this Deposit?')" style="float:right;">
                                        
                               </form>        
                          </div>
                     </div>
                
                
            </div>
            
           
       </div>
<?php include_once("includes/footer.php"); ?>