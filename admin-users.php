<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['did']) && (!empty($_GET['did']))) {
  $id = intval($_GET['did']);
  $active = ACT_N;
  $sql = "UPDATE  tblaccess SET `Active`= ? WHERE `User ID` = ?";
  $stmt= $conn->prepare($sql);
  $stmt->bind_param("si",$active,$id);
  $result = $stmt->execute();
  if($result === TRUE){
    $message = "Deactivation successful";
  }else{
    $message = "Deactivation not successful";
  }
}
?>
<?php if(isset($_GET['aid']) && (!empty($_GET['aid']))) {
  $id = intval($_GET['aid']);
  $active = ACT_Y;
  $sql = "UPDATE  tblaccess SET `Active`= ? WHERE `User ID` = ?";
  $stmt= $conn->prepare($sql);
  $stmt->bind_param("si",$active,$id);
  $result = $stmt->execute();
  if($result === TRUE){
    $message = "Activation successful";
  }else{
    $message = "Activation not successful";
  }
}
?>
<?php if(isset($_GET['insert']) AND ($_GET['insert'] == 1)){
   $message = "Admin created successfully";
  }
  if(isset($_GET['insert']) AND ($_GET['insert'] == 0)) {
    $message = "Admin creation not successful";
  }
  ?>
  <?php
    if(isset($_GET['report'])){
      if(isset($_GET['type']) && ($_GET['type'] ==1)){
      $message = "Sorry! You cannot edit Super Admin";
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
            <div class="col-md-9">
               <div class="spacebar"></div>

                      <div class="row">
                          <div class="col-md-11">
                            <div class="spacebar"></div>
                            <div class="breadcrumb1">
                                      <div class="bread-title">
                                              <h1>Admin Users Listing</h1>
                                      </div>
                            </div>
                            <?php include("includes/message_alert.php"); ?>
                               <table class="table table-striped table-bordered">
                                     <tr class="thbg">
                                       <th>Fullname</th>
                                       <th>Description</th>
                                       <th>Admin Type</th>
                                       <th>Status</th>
                                       <th colspan="3">&nbsp;</th>
                                     </tr>
                                     <?php 
                                      $sql = "SELECT `User ID`, `Login name`, `Full name`, `Description Of User`, `Type`, `Active` FROM tblaccess ORDER BY `User ID` DESC";
                                      $stmt = $conn->prepare($sql);
                                      $stmt->execute();
                                      $result = $stmt->get_result();
                                     while($row = $result->fetch_array()){
                                      ?>
                                        <tr>
                                         <td><?php echo $row['Full name']; ?></td>
                                         <td><?php echo $row['Description Of User']; ?></td>
                                         <td><?php if($row['Type']=="M"){echo "Super Admin";}if($row['Type']=="U"){echo "Standard Admin";}  ?></td>
                                         <td><?php if($row['Active']=="Y"){echo "Active";}if($row['Active']=="N"){echo "Deactivated";}  ?></td>
                                         <td><a href="admin-users.php?aid=<?php echo $row['User ID']; ?>&action=edit" class="btn btn-success" onclick="return confirm('Are you sure you want to activate this admin?');">Activate</a></td>
                                        <td><a href="admin-users.php?did=<?php echo $row['User ID']; ?>&action=deactivation" class="btn btn-danger" onclick="return confirm('Are you sure you really want to deactivate this admin');">Deactivate</a></td>
                                        <td><a href="admin-edit.php?eid=<?php echo $row['User ID']; ?>&action=edit" class="btn btn-success" >Review</a></td>
                                       </tr>
                                       <?php 
                                     } ?>  
                                </table>
                          </div> 
                      </div>   
            </div> 
       </div>
  <?php include_once("includes/footer.php"); ?>
  