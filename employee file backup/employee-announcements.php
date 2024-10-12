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
            <div class="col-md-9">
              <div class="spacebar"></div>
                           <div class="breadcrumb1">
                                <div class="bread-title">
                                    <h1>Announcements Listing</h1>
                                </div>
                            </div>
                    <div class="spacebar"></div>
                    <table class="table table-hover">
                              <tr class="thbg">
                              <th>Announcement Date</th>
                              <th>Announcement Title</th>
                              <th>Announcement Body</th>
                              <th>&nbsp;</th>
                             </tr>
                               <?php global $status;
                                $recipient = "E";
                              $sql = "SELECT `AnnouncementID`,`AnnouncementDate`,`AnnouncementTitle`, AnnouncementBody FROM tblannouncements WHERE  `Recipient` = ? ORDER BY `User datetime` DESC LIMIT 100";
                              $stmt = $conn->prepare($sql);
                              $stmt->bind_param("s",$recipient);
                              $stmt->execute();
                              $result = $stmt->get_result();
                             while($row = $result->fetch_array()){
                                ?>
                              <tr>
                               <td><?php format_date($row['AnnouncementDate']); ?></td>
                               <td><?php echo $row['AnnouncementTitle']; ?></td>
                               <td><?php custom_echo($row['AnnouncementBody'],80); ?></td>
                               <td><a href="employee-announcements-detail.php?annc_id=<?php echo $row['AnnouncementID']; ?>&preview=announcement details" class="btn btn-success">View</a></td>
                               </tr>
                               <?php
                           } ?>   
                    </table>  
            </div>  
       </div>
  <?php include_once("includes/footer.php"); ?>