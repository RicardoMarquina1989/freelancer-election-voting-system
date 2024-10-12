<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['aid']) && (!empty($_GET['aid']))){$admin_id = intval($_GET['aid']);}?>
<?php
if(isset($_POST['update_admin'])){
$message = 0;
$new_password = test_input($_POST['admin_password']);
$uppercase = preg_match('@[A-Z]@', $new_password);
$lowercase = preg_match('@[a-z]@', $new_password);
$number = preg_match('@[0-9]@', $new_password);
$specialChars = preg_match('@[^\w]@', $new_password);
if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_password) < 8 ) {
      $message = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    }
    elseif(empty($new_password)){
      $message = "Password cannot be empty";
      }else{
        $admin_password = md5($new_password);
  $sql = "UPDATE `tblaccess` SET `Login password` = ? WHERE `tblaccess`.`User ID` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si",$admin_password,$admin_id);
  $result = $stmt->execute();
   if($result===TRUE){
    $message = "Admin update successful";
  }else{
    $message = "Update Fail";
  }
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
   <div class="spacebar"></div>
            <div class="col-md-8">
              <div class="breadcrumb1">
                                      <div class="bread-title">
                                              <h1>Admin Profile</h1>
                                      </div>
                            </div>
                            <div class="spacebar"></div>
              <div class="panel panel-info">
                  <div class="panel-heading">
                      <div class="panel-title">
                          You can change your password by re-submitting it below.
                      </div>
                  </div>
                  <div class="panel-body">
                     <?php if(!empty($message)){
                                        echo "<div class=\"alert alert-info\">" . $message. "</div>";
                                      } ?>
                    <?php
                        if(isset($_GET['aid']) && (!empty($_GET['aid']))){
                          $id = $_GET['aid'];
                          $sql = "SELECT * FROM tblaccess WHERE `User ID` = ? LIMIT 1";
                          $stmt = $conn->prepare($sql);
                          $stmt->bind_param("i",$id);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $row = $result->fetch_assoc();
                          }
                     ?>
                     <form method="post" action="admin-profile.php?aid=<?php echo $id;  ?>">
           <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="admin_fullname" required="required" disabled="disabled" class="form-control" placeholder="Enter Fullname..." value="<?php echo $row['Full name'];?>">
          </div> 
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="admin_username" required="required" disabled="disabled" class="form-control" placeholder="Enter Username..." value="<?php echo $row['Login name'];?>">
          </div>
           <div class="form-group">
            <label>Description</label>
            <input type="text" name="admin_description" required="required" disabled="disabled" class="form-control" placeholder="Describe the Admin..." value="<?php echo $row['Description of user'];?>">
          </div>
           <div class="form-group">
            <label>Admin Type:</label>
            <input type="text" name="admin_type" required="required" disabled="disabled" class="form-control" value="<?php if($row['Type']=="M"){echo "Super Admin";}if($row['Type']=="U"){echo "Standard Admin";}  ?>">
          </div>  
           <div class="spacebar"></div>
          <fieldset>
             <legend>Permissions set for this admin </legend> 
          <div class="spacebar"></div>
            <div class="row">
              <div class="col-sm-4 form-group">
                <label>
                    <input id="" type="checkbox" disabled="disabled" name="admin_ca" value="1" <?php if($row['ClientsActivations']==1){echo 'checked="checked"';} ?> > Clients Activations
                </label>
              </div> 
               <div class="col-sm-4 form-group">
                 <label>
                    <input id="" type="checkbox" disabled="disabled" name="admin_da" value="1" <?php if($row['DepositsApprovals']==1){echo 'checked="checked"';} ?> > Deposists Approvals
                </label>
              </div>   
              <div class="col-sm-4 form-group">
                 <label>
                    <input id="" type="checkbox" disabled="disabled" name="admin_la" value="1" <?php if($row['LoansApprovals']==1){echo 'checked="checked"';} ?> > Loans Approvals
                </label>
              </div>    
            </div>
             </fieldset>    
          <div class="spacebar"></div> 
          <div class="form-group">
            <label>Change Password:</label>
            <input type="password" name="admin_password" required="required" maxlength="32" class="form-control" placeholder="Enter New Password to Change your password...">
          </div> 
          <input type="submit" value="Update" name="update_admin" class="btn btn-success" onclick="return confirm('Please write your new password in a secure place before proceeding');">       
          </div>
        </form>    
                  </div>
                
              </div>

            </div>    
       </div>
  <?php include_once("includes/footer.php"); ?>