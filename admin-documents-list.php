<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php
if(isset($_GET['del']) && (!empty($_GET['del']))){
  $delete = $_GET['del'];
  $sql = "DELETE FROM tbldocuments WHERE `Transaction number` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i',$delete);
  $result = $stmt->execute();
  if($result === TRUE){
    redirect_to("admin-documents-list.php?deletion=success");
  }
}
?>
<?php if(isset($_GET['insert']) && ($_GET['insert']) == "success"){
  $message = "Document uploaded successfully";
}?>
<?php if(isset($_GET['deletion']) && ($_GET['deletion']) == "success"){
  $message = "Document deleted successfully";
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
  // this is the left side
    include('includes/admin_dashboard_leftside.php');
   ?>
            <div class="col-md-9"><div class="spacebar"></div>

                                         <div class="breadcrumb1">
                                              <div class="bread-title">
                                                  <h1>Document Listing</h1>
                                              </div>
                                          </div>
                                        <div class="spacebar"></div>
                                        <?php include("includes/message_alert.php"); ?>
                                         <table class="table table-hover">
                                               <tr class="thbg">
                                                 <th>Document Date</th>
                                                 <th>Document Name</th>
                                                 <th>Document Type</th>
                                                 <th>&nbsp;</th>
                                                 <th>&nbsp;</th>
                                               </tr>
                                               <?php 
                                                $sql = "SELECT DocumentDate, DocumentName, DocumentType, `Transaction number` FROM tbldocuments ORDER BY `User datetime` DESC";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                               while($row = $result->fetch_array()){
                                                ?>
                                                <tr>
                                                 <td><?php echo $doc_date = date('d-M-Y',strtotime($row['DocumentDate'])); ?></td>
                                                 <td><?php echo $row['DocumentName']; ?></td>
                                                 <td><?php echo $row['DocumentType']; ?></td>
                                                  <td><a href="download.php?id=<?php echo $row['Transaction number']; ?>" class="btn btn-success">Download</a></td>
                                                 <td><a href="admin-documents-list.php?del=<?php echo $row['Transaction number']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you really want to delete this document');">Delete</a></td>
                                                 </tr>
                                                <?php 
                                               } ?>      
                                          </table> 
            </div>
       </div> 
<?php include_once("includes/footer.php"); ?>