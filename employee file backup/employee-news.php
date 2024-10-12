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
                                      <tr class="thbg">
                                      <th>News Date</th>
                                      <th>News Title</th>
                                      <th>News Body</th>
                                      <th>&nbsp;</th>
                                     </tr>
                                       <?php global $status;
                                      $sql = "SELECT `NewsID`,`NewsDate`,`NewsTitle`, `NewsBody` FROM tblnews ORDER BY `User datetime` DESC LIMIT 100";
                                      $stmt = $conn->prepare($sql);
                                      $stmt->execute();
                                      $result = $stmt->get_result();
                                     while($row = $result->fetch_array()){
                                        ?>
                                      <tr>
                                       <td><?php echo $annc_date = date('d-M-Y',strtotime($row['NewsDate'])); ?></td>
                                       <td><?php echo $row['NewsTitle']; ?></td>
                                       <td><?php custom_echo($row['NewsBody'],80); ?></td>
                                       <td><a href="employee-news-detail.php?id=<?php echo $row['NewsID']; ?>&preview=News details" class="btn btn-success">View</a></td>
                                       </tr>
                                       <?php
                                   } ?>   
                    </table>  
            </div>  
       </div>
  <?php include_once("includes/footer.php"); ?>