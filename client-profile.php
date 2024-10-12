<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php
if(isset($_POST['update_profile']) && (!empty($_POST['client_id']))){
  $message = 0;
  $client_id = trim($_POST['client_id']);
  $new_password = test_input($_POST['client_password']);
  $client_phone = test_input($_POST['client_phone']);
$uppercase = preg_match('@[A-Z]@', $new_password);
$lowercase = preg_match('@[a-z]@', $new_password);
$number = preg_match('@[0-9]@', $new_password);
$specialChars = preg_match('@[^\w]@', $new_password);
if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_password) < 8 ) {
      $message = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    }
    elseif(empty($new_password)){
      $message = "Password cannot be empty";
      }
      elseif(empty($client_phone)){
        $message = "Phone number cannot be empty";}
        else{
          $client_password = md5($new_password);
  $sql = "UPDATE `tblclientsregistrations` SET `Phone number` = ?, `Password` = ? WHERE `tblclientsregistrations`.`RegID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi",$client_phone,$client_password,$client_id);
  $result = $stmt->execute();
   if($result===TRUE){
    $message = "Profile update successful";
  }else{
    $message = "Profile Update Fail";
  }
}
}
?>
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
            <div class="col-md-9"><div class="spacebar"></div>
           <div class="breadcrumb1">
                              <div class="bread-title">
                                  <h1>Member Profile</h1>
                              </div>
                        </div>
                        <div class="spacebar"></div>
                         <div class="panel panel-info">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              You can change your phone number or password by re-submitting them below.
                                          </div>
                                      </div>

                                       <div class="panel-body">
                                        <?php
                                                    $sql2 = "SELECT * FROM tblclientsregistrations WHERE `Client code` = ? LIMIT 1";
                                                      $stmt = $conn->prepare($sql2);
                                                        $stmt->bind_param("s",$ecode);
                                                          $stmt->execute();
                                                            $result2 = $stmt->get_result();
                                                              $row2 = $result2->fetch_assoc();
                                                    
                                       ?>
                                             <form role="form" method="post" enctype="multipart/form-data" autocomplete="off">
                            <?php if(!empty($message)){ 
                          echo "<p class=\"alert alert-danger\">"; 
                          echo $message; 
                          echo "</p>";
                         } ?>
                                                      <div class="form-group" id="" >
                                                               <div class="row">
                                                                          <div class="col-md-4">
                                                                                <label for="name">Surname:</label>
                                                                                <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Surname'];?>" disabled="disabled">
                                                                          </div>
                                                                          <div class="col-md-4">
                                                                                <label for="name">First name:</label>
                                                                                <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['First name'];?>" disabled="disabled">
                                                                          </div>
                                                                          <div class="col-md-4">
                                                                                <label for="name">Middle name:</label>
                                                                               <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Middle name'];?>" disabled="disabled">
                                                                          </div>
                                                                          
                                                              </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="address">Staff Number:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Staff Number'];?>" disabled="disabled">
                                                      </div>
                                                      
                                                       <div class="form-group">
                                                        <label for="address">Residential Address:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Residential address'];?>" disabled="disabled">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="address">Branch:</label>
                                                       <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Branch'];?>" disabled="disabled">
                                                      </div>
                                                       <div class="form-group" id="" >
                                                               <div class="row">
                                                                          <div class="col-md-6">
                                                                                <label for="email">Email Address:</label>
                                                                               <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Email address'];?>" disabled="disabled">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                                <label for="pass">Phone Number:</label>
                                                                                <input type="text" class="form-control" disabled="disabled" id="" value="<?php echo $row2['Phone number'];?>" >
                                                                          </div>
                                                                          
                                                              </div>
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="nok">Next Of Kin:</label>
                                                       <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Next of kin'];?>" disabled="disabled">
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="nok">Address of Next of Kin:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Next of kin address'];?>" disabled="disabled">
                                                      </div>
                                                      <div class="form-group" id="fieldGroupOneDiv" >
                                                               <div class="row">
                                                                          <div class="col-md-6">
                                                                                <label for="nok">Next of Kin Relationship:</label>
                                                                               <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Next of kin relationship'];?>" disabled="disabled">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                                <label for="nok">Next of Kin Phone Number:</label>
                                                                                <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Next of kin phone number'];?>" disabled="disabled">
                                                                          </div>
                                                                          
                                                              </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="savings">Monthly Savings:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Montly savings'];?>" disabled="disabled">
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="savings">Application Type:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Registration type'];?>" disabled="disabled">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="savings">Registration Fee Paid:</label>
                                                        <input type="text" class="form-control" name="surname" id="" value="<?php echo $row2['Registration fee paid'];?>" disabled="disabled">
                                                      </div>
                                                      <div class="form-group" id="" >
                                                               <div class="row">
                                                                          <div class="col-md-4">
                                                                        <label for="">Passport:</label>
                                                                         <img src="<?php echo $row2['Photograph']; ?>" class = "img-responsive">
                                                                          </div>
                                                                          <div class="col-md-8">
                                                                                
                                                                          </div>
                                                                          
                                                              </div>
                                                      </div>
                                                      
                                                      <div class="form-group" id="" >
                                                               <div class="row">
                                                                          <div class="col-md-6">
                                                                                <label for="otherField2"> &nbsp;Policy acceptance: &nbsp;<input type="checkbox" class="" name="" id="" checked="checked" disabled="disabled"></label>
                                                                                
                                                                          </div>         
                                                              </div>
                                                      </div>
                                                        <div class="form-group" id="" >
                                                               <div class="row">
                                                                          <div class="col-md-6">
                                                                                <label for="phone">Change Phone Number:</label>
                                                                                <input type="text" class="form-control" maxlength="15" required="required" name="client_phone" id="" value="<?php if(!empty($row2['Phone number'])){echo $row2['Phone number'];} ?>" placeholder = "Enter Your New Phone Number">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                                <label for="pass">Change Password:</label>
                                                                                <input type="password" class="form-control" name="client_password" id="" required="required" placeholder = "Enter Your New Password">
                                                                          </div>
                                                                          
                                                              </div>
                                                      </div>
                                                       <div class="form-group" id="" >
                                                               <div class="row">
                                                                          <div class="col-md-6">
                                                                                  <label for="pass">&nbsp;</label>
                                                                                 <input type="submit" name="update_profile" class="btn btn-success" value="Update" style="margin-top: 22px;">
                                                                          </div>
                                                              </div>
                                                      </div>
                                                    <input type="hidden" name="client_id" value="<?php echo $row2['RegID'];?>">
                                            </form>
                          
                                      </div>
                          </div>
            </div>    
       </div>
<?php include_once("includes/footer.php"); ?>