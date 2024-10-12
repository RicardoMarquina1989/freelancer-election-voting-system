<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php $act_y = ACT_Y; $act_d = ACT_D; ?>
<?php if(isset($_GET['reactivate']) && (!empty($_GET['reactivate']))) {
  $reactivate = $_GET['reactivate'];
  $stmt = $conn->prepare("UPDATE tblclients SET `Activated` = ? WHERE `ClientID` = ? LIMIT 1");
  $stmt->bind_param("ss",$act_y,$reactivate);
  $result = $stmt->execute();
  if($result === TRUE){
    #$message = "Reactivation Successful";
    redirect_to("admin-client-list.php?reactivation=true");
  }else{
    $message = "Activation Not Successful";
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
                <div class="breadcrumb1">
                      <div class="bread-title">
                              <h1>Deactivated Clients Listing </h1>
                      </div>
            </div>
               <div class="spacebar"></div>

                      <div class="">
                                    <div class="">
                                       <?php 
                                       if(isset($_GET['deactivation'])){
                                        if($_GET['deactivation']=="true"){
                                          $message = "De-activation successful";
                                        }
                                       }
                                       if(!empty($message)){
                                        echo "<div class=\"alert alert-info\">" . $message. "</div>";
                                      }
                                      ?>
                                         <table class="table table-hover">
                                               <tr class="thbg">
                                                 <th>Client Name</th>
                                                 <th>Client Code</th>
                                                 <th>&nbsp;</th>
                                                 <th>&nbsp;</th> 
                                                 <th>&nbsp;</th>                                               
                                               </tr>
                                              <?php 
                                                $stmt = $conn->prepare("SELECT `Client name`, `Client code`, `ClientID` FROM tblclients WHERE `Activated`=? ORDER BY ClientID DESC");
                                                $stmt->bind_param("s",$act_d);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if($result->num_rows > 0){
                                               while($row = $result->fetch_array()){
                                                  echo "<tr>
                                                 <td>{$row['Client name']}</td>
                                                 <td>{$row['Client code']}</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td><a href=\"admin-client-deactivatedlist.php?reactivate={$row['ClientID']}\" class=\"btn btn-success\" onclick=\"return confirm('Are you sure you really want to reactivate this client');\">Reactivate</a></td>
                                                 </tr>"; 

                                               } 
                                             }?>
                                              
                                          </table>
                                  </div>
                      </div>

                
            </div>
            
           
       </div>
<?php include_once("includes/footer.php"); ?>