<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['eid']) && (!empty($_GET['eid']))){$admin_id = intval($_GET['eid']);}?>

<?php
if(isset($_POST['update_admin'])){
  $admin_fullname = ucwords($_POST['admin_fullname']);
  $admin_username = ucwords($_POST['admin_username']);
  $admin_description = ucwords($_POST['admin_description']);
  $admin_type = ucwords($_POST['admin_type']);
   if(!empty($_POST['admin_ca'])){
                $admin_ca = $_POST['admin_ca'];
            }else{
                $admin_ca = ZER_CONST;
            };
            if(!empty($_POST['admin_la'])){
                $admin_la = $_POST['admin_la'];
            }else{
                $admin_la = ZER_CONST;
            };
            if(!empty($_POST['admin_da'])){
                $admin_da = $_POST['admin_da'];
            }else{
                $admin_da = ZER_CONST;
            };
  $sql = "UPDATE `tblaccess` SET `Login name` = ?, `Full name` = ?, `Description of user` = ?, `Type` = ?, `ClientsActivations` = ?, `DepositsApprovals` = ?, `LoansApprovals` = ? WHERE `tblaccess`.`User ID` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssiiii",$admin_username,$admin_fullname,$admin_description,$admin_type,$admin_ca,$admin_da,$admin_la,$admin_id);
  $result = $stmt->execute();
   if($result===TRUE){
    $message = "Admin update successful";
  }else{
    $message = "Update Fail";
  }
}else
{
}
?>
<?php
if(isset($_POST['reset_adminpassword'])){
  if(empty($_POST['admin_password'])){
    $message = "You must enter new password to reset admin password";
  }else{
    $admin_password = md5(test_input($_POST['admin_password']));
      $sql = "UPDATE `tblaccess` SET `Login password` = ? WHERE `tblaccess`.`User ID` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si",$admin_password,$admin_id);
  $result = $stmt->execute();
   if($result===TRUE){
    $message = "Password reset successful";
    unset($_POST['reset_adminpassword']);
  }
  else
  {
    $message = "Failed!";
   unset($_POST['reset_adminpassword']);
  }
  }

}
else
{
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
                                                    <h1>Admin Users Review</h1>
                                            </div>
                    </div>
                            <div class="spacebar"></div>
              <div class="panel panel-info">
                  <div class="panel-heading">
                      <div class="panel-title">
                          You can edit admin details including permission below. 
                      </div>
                  </div>
                  <div class="panel-body">
                     <?php if(!empty($message)){
                                        echo "<div class=\"alert alert-info\">" . $message. "</div>";
                                      } ?>
                    <?php
                        if(isset($_GET['eid']) && (!empty($_GET['eid']))){
                          $id = $_GET['eid'];
                          $sql = "SELECT * FROM tblaccess WHERE `User ID` = ? LIMIT 1";
                          $stmt = $conn->prepare($sql);
                          $stmt->bind_param("i",$id);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $row = $result->fetch_assoc();
                          }
                     ?>
          <form method="post" action="admin-edit.php?eid=<?php echo $id;  ?>">
            <div class="row" style="background: #FFFFBF;">
                  <div class="col-sm-6 form-group">
                    <label>Reset Password For - <?php echo ucwords($row['Full name']);?></label>
                <input type="password" name="admin_password"  maxlength="20" class="form-control" placeholder="Enter New Password ..." value="">
                  </div> 
                   <div class="col-sm-6 form-group">
                    <label style="font-weight: normal;">Kindly remind (<?php echo ucwords($row['Full name']);?>) to change this password after login.</label>
                      <input type="submit" value="Reset" name="reset_adminpassword" class="btn btn-success">     
                  </div>   
          </div> <div class="spacebar"></div>
           <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="admin_fullname" required="required" maxlength="45" class="form-control" placeholder="Enter Fullname..." value="<?php echo $row['Full name'];?>">
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="admin_username" required="required" maxlength="15" class="form-control" placeholder="Enter Username..." value="<?php echo $row['Login name'];?>">
          </div>
           <div class="form-group">
            <label>Description</label>
            <input type="text" name="admin_description" required="required" maxlength="40" class="form-control" placeholder="Describe the Admin..." value="<?php echo $row['Description of user'];?>">
          </div>
           <div class="form-group">
            <label>Admin Type</label>
            <select name="admin_type" class="form-control" required="required">
              <option value="<?php if(!empty($row['Type'])){echo $row['Type'];}?>" ><?php if(!empty($row['Type']) && ($row['Type']=="U")){echo "Standard Admin";}elseif(!empty($row['Type']) && ($row['Type']=="M")){echo "Super Admin";}else{ echo "--Please Select --"; } ?></option>
                <option value="U">Standard Admin</option>
                <option value="M">Super Admin</option>
            </select>
          </div>
          
           <div class="spacebar"></div>
          <fieldset>
           <legend>Please Set the permissions for this admin below.</legend>          
          <div class="spacebar"></div>
            <div class="row">
              <div class="col-sm-4 form-group">
                <label>
                    <input id="" type="checkbox" name="admin_ca" value="1" <?php if($row['ClientsActivations']==1){echo 'checked="checked"';} ?> > Clients Activations
                </label>
              </div> 
               <div class="col-sm-4 form-group">
                 <label>
                    <input id="" type="checkbox" name="admin_da" value="1" <?php if($row['DepositsApprovals']==1){echo 'checked="checked"';} ?> > Deposists Approvals
                </label>
              </div>   
              <div class="col-sm-4 form-group">
                 <label>
                    <input id="" type="checkbox" name="admin_la" value="1" <?php if($row['LoansApprovals']==1){echo 'checked="checked"';} ?> > Loans Approvals
                </label>
              </div>    
            </div>
             </fieldset>    
          <div class="spacebar"></div>  
          <input type="submit" value="Update" name="update_admin" class="btn btn-success">     
          </div>
        </form>    
                  </div>
                
              </div>

            </div>
            
           
       </div>
  <?php include_once("includes/footer.php"); ?>