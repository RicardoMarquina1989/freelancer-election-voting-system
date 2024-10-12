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
                                                  <h1>Document Listing</h1>
                                              </div>
                                          </div>
                                        <div class="spacebar"></div>
                                         <table class="table table-hover">
                                               <tr class="">
                                                 <th>Document Date</th>
                                                 <th>Document Name</th>
                                                 <th>Document Type</th>
                                                 <th>&nbsp;</th>
                                               </tr>
                                               <?php 
                                                $sql = "SELECT DocumentDate, DocumentName, DocumentType, `Transaction number` FROM tbldocuments ORDER BY DocumentDate DESC";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                               while($row = $result->fetch_array()){
                                                ?>
                                                <tr>
                                                 <td><?php echo format_date($row['DocumentDate']); ?></td>
                                                 <td><?php echo $row['DocumentName']; ?></td>
                                                 <td><?php echo $row['DocumentType']; ?></td>
                                                 <td><a href=\"download.php?id=<?php echo $row['Transaction number']; ?>" class="btn btn-success">Download</a></td>
                                                 </tr>
                                                 <?php 
                                               } ?>
                                              
                                          </table> 

            </div>         
       </div>
  <?php include_once("includes/footer.php"); ?>