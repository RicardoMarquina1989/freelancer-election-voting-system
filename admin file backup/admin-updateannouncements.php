<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['upa']) && (!empty($_GET['upa']))){$annc_id = intval($_GET['upa']);}?>
<?php if(isset($_POST['publishAnnc'])){
  $p = "P";
  $sql = "UPDATE `tblannouncements` SET `Saved` = ? WHERE `AnnouncementID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si",$p,$annc_id);
  $result = $stmt->execute();
  if($result===TRUE){redirect_to("admin-announcements.php");
   }
  } ?>
  <?php if(isset($_POST['updateAnnc'])){
  $annc_date = $_POST['annc_date'];
  $annc_title = $_POST['annc_title'];
  $annc_body = $_POST['annc_body'];
  $annc_recipient = ucfirst($_POST['annc_recipient']);
  $date_time = date('Y-m-d H:i:s');
  $sql = "UPDATE `tblannouncements` SET `AnnouncementDate`=?, `AnnouncementTitle` = ?, `AnnouncementBody` = ?, `Recipient` = ?, `User datetime`=? WHERE `AnnouncementID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssi",$annc_date,$annc_title,$annc_body,$annc_recipient,$date_time,$annc_id);
  $result = $stmt->execute();
  if($result===TRUE){
    $message = "Update Successful";
  }
  } ?>
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
                                  Update Announcement
                              </div>
                          </div>
                          <div class="panel-body">
                           <?php include("includes/message_alert.php"); ?>
                          <?php 
                          if(isset($_GET['upa']) && (!empty($_GET['upa']))){
                          $annc_id = intval($_GET['upa']);
                           }
                          $sql = "SELECT * FROM tblannouncements WHERE AnnouncementID = ? LIMIT 1";
                          $stmt =$conn->prepare($sql);
                          $stmt->bind_param("i",$annc_id);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $row = $result->fetch_array();
                          if($row['Saved'] == "P"){
                          $read_only = "readonly";
                          $disable = "disabled";
                          }
                          ?>
                               <form action="admin-updateannouncements.php?upa=<?php echo $annc_id; ?>" method="post">
                                     <div class="form-group">
                                      <label for="companyCode">Date:</label>
                                      <input type="text" name="annc_date" class="form-control" id="" value="<?php echo $row['AnnouncementDate']; ?>" placeholder="Enter Announcement Date..." required="required"  autofocus="autofocus" <?php if(!empty($read_only)){echo $read_only; }?>>
                                    </div>
                                    <div class="form-group">
                                      <label for="vacancyCategory">Title:</label>
                                      <input type="text" name="annc_title" maxlength="100" class="form-control" id="" value="<?php echo $row['AnnouncementTitle']; ?>" placeholder="Enter Announcement Title..." required="required" maxlength="100" <?php if(!empty($read_only)){echo $read_only; }?>>
                                    </div>
                                    <div class="form-group">
                                      <label for="vacancyCategory">Recipient:</label>
                                      <input type="text" name="annc_recipient" maxlength="1" class="form-control" id="" value="<?php echo $row['Recipient']; ?>" placeholder="Enter E for Employee or C for Candidate" required="required" maxlength="100" <?php if(!empty($read_only)){echo $read_only; }?>>
                                    </div>
                                    <div class="form-group">
                                      <label for="body">Body:</label>
                                      <textarea class="form-control" name="annc_body" rows="15" id="comment" <?php if(!empty($read_only)){echo $read_only; }?> > <?php echo $row['AnnouncementBody']; ?></textarea>
                                    </div>
                                    <input type="submit" name="updateAnnc" value="Save" class="btn btn-success" <?php if(!empty($disable)){echo $disable; }?> >
                                    <input type="submit" name="publishAnnc" value="Publish" class="btn btn-info" onclick="return confirm('You wont be able to edit after you publish.')" style="float:right;" <?php if(!empty($disable)){echo $disable; }?> >          
                           </form>        
                          </div>
                     </div>  
            </div>    
       </div>
<?php include_once("includes/footer.php"); ?>