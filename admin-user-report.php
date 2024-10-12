<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['did']) && (!empty($_GET['did']))) {
  $id = intval($_GET['did']);
  $n = N_CONST;
  $sql = "UPDATE  tblaccess SET `Active`= ? WHERE `User ID` = ?";
  $stmt= $conn->prepare($sql);
  $stmt->bind_param("si",$n,$id);
  $result = $stmt->execute();
  if($result === TRUE){
    $message = "Deactivation successful";
  }else{
    $message = "Deactivation not successful";
  }
}
?>
<?php if(isset($_GET['report']) AND ($_GET['report'] == 1)){
   $message = "Admin created successfully";
  }
  if(isset($_GET['report']) AND ($_GET['report'] == 0)) {
    $message = "Admin creation not successful";
  }
  ?>
  <?php if(isset($_GET['report']) AND ($_GET['report'] == 2)){
   $message = "Admin creation failed";
  }
  ?>
  <?php if(isset($_GET['type']) AND ($_GET['type'] == 2)){
   $message = "Sorry! You are not allowed to create or edit an admin";
  }
    if(isset($_GET['type']) AND ($_GET['type'] == 3)){
   $message = "Ops! No permission. Kindly contact the super admin.";
  }
  ?>
  <?php
    //if(isset($_GET['report']) AND ($_GET['report'] == 1)){
      //if(isset($_GET['type']) && ($_GET['type'] ==1)){
     // $message = "Sorry! You cannot edit Super Admin";
     //   }
     //   } 
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
                          <div class="col-md-8 col-md-offset-1">
                             <div class="spacebar"></div> <div class="spacebar"></div>
                            <?php include("includes/message_alert.php"); ?>
                               
                          </div> 
                      </div>   
            </div> 
       </div>
  <?php include_once("includes/footer.php"); ?>
  