<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<!DOCTYPE html>
<html lang="en">
  <?php include_once("includes/head.php"); ?>
 <body style="background-color:#f0f0f7; ">
    <!-- Navigation -->
    <?php include_once("includes/header_menu.php"); ?> 
 
   <?php
  // this is the left side
  include("employee/employee_dashboard_leftside.php");
   ?>
            <div class="col-md-9"><div class="spacebar"></div>
                                         <div class="breadcrumb1">
                                              <div class="bread-title">
                                                  <h1>Announcements Listing</h1>
                                              </div>
                                          </div>
                                        <div class="spacebar"></div>
                                           <table class="table table-hover">
                            <?php if(isset($_GET['annc_id']) && (!empty($_GET['annc_id']))){$annc_id = intval($_GET['annc_id']);}?>
                            <?php
                            $recipient = "E";
                                $sql = "SELECT `AnnouncementDate`,`AnnouncementTitle`,`AnnouncementBody` FROM tblannouncements WHERE `AnnouncementID` = ? AND `Recipient` = ? LIMIT 1";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("is",$annc_id,$recipient);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result){
                                  $row = $result->fetch_array();
                                  $ad = strtotime($row['AnnouncementDate']);
                                }
                                
                            ?>
                                <tr align="left">
                                    <th>Announcement Date:</th>
                                    <td align="left"><?php echo date('d-M-Y',$ad);?></td>
                                </tr>
                                <tr>
                                    <th>Announcement Title:</th>
                                    <td align="left"><?php echo $row['AnnouncementTitle'];?></td>
                                </tr>
                                <tr>
                                    <th>Announcement Body:</th>
                                    <td align="left"><?php echo nl2br($row['AnnouncementBody']);?></td>
                                </tr>
                    </table>
            </div>  
       </div>
  <?php include_once("includes/footer.php"); ?>