<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['client_id']) && (!empty($_GET['client_id']))){$client_id = intval($_GET['client_id']);}?>
<?php //if(isset($_GET['case_id']) && (!empty($_GET['case_id']))){$admin_id = intval($_GET['case_id']);}?>
<?php if(isset($_POST['declineclient']) && !empty($_POST['client_id'])){
  $client_id = intval(test_input($_POST['client_id']));
  $approved = ACT_D;
  $email_address = test_input($_POST['client_email']);
  $remark = $_POST['admin_remark'];
  $admin_id = trim($_POST['admin_id']);
  $date_reviewed = date('Y-m-d H:i:s');
  $sql = "UPDATE tblclientsregistrations SET `Date reviewed` = ?, `Reviewed by User ID` =?, `Remark` = ?, `Activated` = ? WHERE `RegID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sissi",$date_reviewed,$admin_id,$remark,$approved,$client_id);
  $result = $stmt->execute();
  if($result === TRUE){
    //redirect_to("admin-approve-loan.php");
     $to = "$email_address";
               $subject = "GSCMS Portal-Client Registration";
               //$mail_message = "<h2>Dear ({$surname}), {$firstname}  </h2>";
               $mail_message = "<p> An Admin has reviewed your registration application for GSCMS Portal and has declined your application with the following remark:</p>";
               $mail_message .= "<p> $remark </p>";         
               $header = "From:noreply@gscms.org \r\n";
               $header .= "MIME-Version: 1.0\r\n";
               $header .= "Content-type: text/html\r\n";
               $retval = mail ($to,$subject,$mail_message,$header);
    $message = "Member declined";
  }else{
    $message = "Not Successful";
  }
  }  ?>
<?php if(isset($_POST['approveclient']) && !empty($_POST['client_id'])){
$client_id = intval(test_input($_POST['client_id']));  
  $approved = ACT_Y;
  $email_address = test_input($_POST['client_email']);
  $client_code = $_POST['client_code'];
  $remark = $_POST['admin_remark'];
   $date_reviewed = date('Y-m-d H:i:s');
   $admin_id = $_POST['admin_id'];
 $sql = "UPDATE tblclientsregistrations SET `Client code` =?, `Date reviewed` = ?, `Reviewed by User ID` =?, `Remark` = ?, `Activated` = ? WHERE `RegID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssissi",$client_code,$date_reviewed,$admin_id,$remark,$approved,$client_id);
  $result = $stmt->execute();
  if($result === TRUE){
    //redirect_to("admin-approve-loan.php");
     $to = "$email_address";
               $subject = "GSCMS Portal-Client Registration";
               //$mail_message = "<h2>Dear ({$surname}), {$firstname}  </h2>";
               $mail_message = "<p> An Admin has reviewed your registration application for GSCMS Portal and has approved your application with the following remark:</p>";
               $mail_message .= "<p> $remark </p>";         
               $header = "From:noreply@gscms.org \r\n";
               $header .= "MIME-Version: 1.0\r\n";
               $header .= "Content-type: text/html\r\n";
               $retval = mail ($to,$subject,$mail_message,$header);
    $message = "Member approved";
  }else{
    $message = "Not Successful.";
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
            <div class="col-md-8"><div class="spacebar"></div>
                     <div class=" panel panel-info">
                          <div class="panel-heading">
                              <div class="panel-tilte">
                                  Member Activation Review
                              </div>
                          </div>
                          <div class="panel-body">
                          <?php include("includes/message_alert.php"); ?>
                          <?php
                          $sql = "SELECT `c`.`RegID`, `c`.`Date applied`,`c`.`Surname`, `c`.`First name`, `c`.`Middle name`, `c`.`Client code`,`c`.`Staff Number`,`c`.`Residential address`,`c`.`Branch`,`c`.`Email address`,`c`.`Phone number`,`c`.`Next of kin`,`c`.`Next of kin address`,`c`.`Next of kin relationship`,`c`.`Next of kin phone number`,`c`.`Montly savings`,`c`.`Registration type`,`c`.`Registration fee paid`,`c`.`Registration fee evidence`,`c`.`Photograph`,`c`.`Activated`, `c`.`Date reviewed`, `c`.`Reviewed by User ID`, `c`.`Remark`, `a`.`Full name` FROM tblclientsregistrations AS c LEFT JOIN tblaccess AS a ON `c`.`Reviewed by User ID`= `a`.`User ID` WHERE `RegID`=? LIMIT 1";
                          $stmt = $conn->prepare($sql);
                          $stmt->bind_param("i",$client_id);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $row = $result->fetch_array();
                          if($row['Activated'] == 'Y'){
                                                  $status = "Approved";
                                                }elseif ($row['Activated'] == 'N') {
                                                  # code...
                                                  $status = "Pending";
                                                }elseif($row['Activated'] == 'D'){
                                                  $status = "Declined";
                                                }else{

                                                }
                          ?>
                               <form action="admin-client-review.php" method="post">
                                 <div class="form-group" id="" >
                                                               <div class="row">
                                                                          <div class="col-md-4">
                                                                                <label for="name">Surname:</label>
                                                                                <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Surname'];?>" disabled="disabled">
                                                                          </div>
                                                                          <div class="col-md-4">
                                                                                <label for="name">First name:</label>
                                                                                <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['First name'];?>" disabled="disabled">
                                                                          </div>
                                                                          <div class="col-md-4">
                                                                                <label for="name">Middle name:</label>
                                                                               <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Middle name'];?>" disabled="disabled">
                                                                          </div>
                                                                          
                                                              </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="address">Staff Number:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Staff Number'];?>" disabled="disabled">
                                                      </div>
                                                      
                                                       <div class="form-group">
                                                        <label for="address">Residential Adrress:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Residential address'];?>" disabled="disabled">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="address">Branch:</label>
                                                       <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Branch'];?>" disabled="disabled">
                                                      </div>
                                                       <div class="form-group" id="" >
                                                               <div class="row">
                                                                          <div class="col-md-6">
                                                                                <label for="email">Email Address:</label>
                                                                               <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Email address'];?>" disabled="disabled">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                                <label for="pass">Phone Number:</label>
                                                                                <input type="text" class="form-control" disabled="disabled" id="" value="<?php echo $row['Phone number'];?>" >
                                                                          </div>
                                                                          
                                                              </div>
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="nok">Next Of Kin:</label>
                                                       <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Next of kin'];?>" disabled="disabled">
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="nok">Adrress of Next of Kin:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Next of kin address'];?>" disabled="disabled">
                                                      </div>
                                                      <div class="form-group" id="fieldGroupOneDiv" >
                                                               <div class="row">
                                                                          <div class="col-md-6">
                                                                                <label for="nok">Next of Kin Relationship:</label>
                                                                               <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Next of kin relationship'];?>" disabled="disabled">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                                <label for="nok">Next of Kin Phone Number:</label>
                                                                                <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Next of kin phone number'];?>" disabled="disabled">
                                                                          </div>
                                                                          
                                                              </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="savings">Monthly Savings:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Montly savings'];?>" disabled="disabled">
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="savings">Application Type:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Registration type'];?>" disabled="disabled">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="savings">Registration Fee Paid:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row['Registration fee paid'];?>" disabled="disabled">
                                                      </div>
                                                      <div class="form-group" id="" >
                                                               <div class="row">
                                                                    <div class="col-md-12">
                                                                         <label for="">Passport:</label>
                                                                         <img src="<?php echo $row['Photograph']; ?>" class = "img-responsive">
                                                                            
                                                                    </div>
                                                              </div>
                                                      </div>
                                                      <div class="form-group" id="" >
                                                               <div class="row">
                                                                    <div class="col-md-12">
                                                                          <label for="">Registration Fee Evidence:</label>
                                                                         <a target="_blank" rel="noreferrer" href="<?php if(!empty($row['Registration fee evidence'])){ echo $row['Registration fee evidence'];}else{echo "";} ?>"> <?php if(!empty($row['Registration fee evidence'])){ echo "View payment receipt";}else{echo "";} ?> </a>
                                                                    </div>
                                                                    
                                                              </div>
                                                      </div>
                                         <div class="form-group">
                                          <label for="dateapplied">Date Applied:</label>
                                          <input type="text" name="loan_date" class="form-control" id="" value="<?php echo date('d-M-Y',strtotime($row['Date applied'])); ?>"   autofocus="autofocus" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Status:</label>
                                          <input type="text" name="status" class="form-control" id="" value="<?php echo $status; ?>"  disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Last Date Reviewed:</label>
                                          <input type="text" name="date_reviewed" class="form-control" id="" value="<?php if(!empty($row['Date reviewed'])){ echo date('d-M-Y',strtotime($row['Date reviewed']));} ?>" disabled="disabled">
                                        </div>
                                        <div class="form-group">
                                          <label for="vacancyCategory">Last Reviewed By:</label>
                                          <input type="text" name="reviewed_by" class="form-control" id="" value="<?php echo $row['Full name']; ?>" disabled="disabled">
                                        </div> 
                                            <div class="form-group">
                                          <label for="vacancyCategory">Member Code:</label>
                                         <select class="form-control" name="client_code" id="mySelect" required="required"  oninvalid="this.setCustomValidity('Please select a member from the list')" oninput="setCustomValidity('')">
                                              <option value=""> -- Select Member Code -- </option>
                                                <option value="<?php if(!empty($row['Client code'])){echo $row['Client code'];}?>" ><?php if(!empty($row['Client code'])){echo $row['Client code'];}else{ echo "--Please Select --"; } ?></option>
                                                <?php 
                                                      $sql2 = "SELECT `Client code`, `Client name`, Date(`Date opened`) as `Dateopened` FROM tblclients ORDER BY `Client name` ASC";
                                                        $stmt= $conn->prepare($sql2);
                                                        //$stmt->bind_param("s",$activated);
                                                          $stmt->execute();
                                                            $result2 = $stmt->get_result();
                                                      if($result->num_rows > 0){
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                          # code...
                                                          echo "<option value=\"{$row2['Client code']}\">{$row2['Client name']}  -  {$row2['Client code']}</option>";
                                                        }
                                                      }
                                                       ?>      
                                        </select>
                                        </div>           
                                       <div class="form-group">
                                          <label for="body">Remark:</label>
                                          <textarea class="form-control" name="admin_remark" rows="8" id="comment" required="required" > <?php echo $row['Remark']; ?> </textarea>
                                        </div>
                                        <input type="text" hidden="hidden" name="admin_id" value="<?php echo $id; ?>">
                                        <input type="text" hidden="hidden"  name="client_id" value="<?php echo $row['RegID']; ?>">
                                        <input type="text" hidden="hidden"  name="client_email" value="<?php echo $row['Email address']; ?>">

                                        <input type="submit" name="approveclient" value="Approve" class="btn btn-success">
                                        <input type="submit" name="declineclient" value="Decline" class="btn btn-danger" style="float:right;">
                                        
                               </form>        
                          </div>
                     </div>
                
                
            </div>
            
           
       </div>
<?php include_once("includes/footer.php"); ?>