<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['del']) && (!empty($_GET['del']))) {
  $del = intval($_GET['del']);
  $sql = "DELETE FROM tblannouncements WHERE AnnouncementID = ?";
  $stmt= $conn->prepare($sql);
  $stmt->bind_param("i",$del);
  $result = $stmt->execute();
  if($result === TRUE){
    $message = "Deletion Successful";
  }else{
    $message = "Not Successful";
  }
}
?>
<?php if(isset($_GET['insert']) && ($_GET['insert']) == "success"){
  $message = "Successful";
}?>
<?php if(isset($_GET['insert']) && ($_GET['insert']) == "error"){
  $message = "Failed";
}?>
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
            <div class="col-md-9" id="right">
              <div class="spacebar"></div>
                <div class="breadcrumb1">
                      <div class="bread-title">
                              <h1>Announcements History</h1>
                      </div>
            </div>
            <div class="spacebar"></div>
                  <?php include("includes/message_alert.php"); ?>
                     <table class="table table-hover">
                                     <tr class="thbg">
                                      <th>Announcement Date</th>
                                      <th>Announcement Title</th>
                                       <th>Announcement Body</th>
                                        <th>Status</th>
                                         <th>&nbsp;</th>
                                          <th>&nbsp;</th>
                                     </tr>
                                       <?php global $status;
                                      $sql = "SELECT * FROM tblannouncements ORDER BY `User datetime` DESC LIMIT 50";
                                      $stmt = $conn->prepare($sql);
                                      $stmt->execute();
                                      $result = $stmt->get_result();
                                     while($row = $result->fetch_array()){
                                        if($row['Saved'] == 'Y'){
                                          $status = "Saved";
                                        }elseif ($row['Saved'] == 'P') {
                                          # code...
                                          $status = "Published";
                                        }else{

                                        }
                                        ?>
                                      <tr>
                                       <td><?php #echo $annc_date = date('d-M-Y',strtotime($row['AnnouncementDate'])); 
                                       format_date($row['AnnouncementDate']);
                                       ?></td>
                                       <td><?php echo $row['AnnouncementTitle']; ?></td>
                                       <td><?php custom_echo($row['AnnouncementBody'],50); ?></td>
                                       <td><?php echo $status; ?></td>
                                       <td><a href="admin-updateannouncements.php?upa=<?php echo $row['AnnouncementID']; ?>" class="btn btn-success">Edit</a></td>
                                       <td><a href="admin-announcements.php?del=<?php echo $row['AnnouncementID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you really want to delete this announcement');">Delete</a></td>
                                       </tr>
                                       <?php
                                   } ?>   
                    </table>  
            </div>    
       </div>
  <?php include_once("includes/footer.php"); ?>