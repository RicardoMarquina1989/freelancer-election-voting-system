<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['upn']) && (!empty($_GET['upn']))){$news_id = intval($_GET['upn']);}?>
<?php if(isset($_POST['publishNews'])){
  $p = "P";
  $sql = "UPDATE `tblnews` SET `Saved` = ? WHERE `NewsID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si",$p,$news_id);
  $result = $stmt->execute();
  if($result===TRUE){redirect_to("admin-news.php");
   }
  } ?>
  <?php if(isset($_POST['updateNews'])){
  $news_date = $_POST['news_date'];
  $news_title = $_POST['news_title'];
  $news_body = $_POST['news_body'];
  $date_time = date('Y-m-d H:i:s');
  $sql = "UPDATE `tblnews` SET `NewsDate`=?, `NewsTitle` = ?, `NewsBody` = ?, `User datetime`=? WHERE `NewsID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssi",$news_date,$news_title,$news_body,$date_time,$news_id);
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
                                  Update News
                              </div>
                          </div>
                          <div class="panel-body">
                          <?php include("includes/message_alert.php"); ?>
                          <?php 
                          if(isset($_GET['upn']) && (!empty($_GET['upn']))){
                          $news_id = intval($_GET['upn']);
                          $sql = "SELECT * FROM tblnews WHERE NewsID = ? LIMIT 1";
                          $stmt =$conn->prepare($sql);
                          $stmt->bind_param("i",$news_id);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $row = $result->fetch_array();
                          if($row['Saved'] == "P"){
                          $read_only = "readonly";
                          $disable = "disabled";
                          }
                           }
                          ?>
                               <form action="admin-updatenews.php?upn=<?php echo $news_id; ?>" method="post">
                                                       <div class="form-group">
                                                        <label for="companyCode">Date:</label>
                                                        <input type="text" name="news_date" class="form-control" id="" value="<?php echo $row['NewsDate']; ?>" placeholder="Enter News Date..." required="required"  autofocus="autofocus" <?php if(!empty($read_only)){echo $read_only; }?>>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="vacancyCategory">Title:</label>
                                                        <input type="text" name="news_title" class="form-control" id="" value="<?php echo $row['NewsTitle']; ?>" placeholder="Enter News Title..." required="required" maxlength="100" <?php if(!empty($read_only)){echo $read_only; }?>>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="body">Body:</label>
                                                        <textarea class="form-control" name="news_body" rows="20" id="comment" required="required" <?php if(!empty($read_only)){echo $read_only; }?> ><?php echo $row['NewsBody']; ?> </textarea>
                                                      </div>
                                                      <input type="submit" name="updateNews" value="Save" class="btn btn-success" <?php if(!empty($disable)){echo $disable; }?> >
                                                      <input type="submit" name="publishNews" value="Publish" class="btn btn-info" onclick="return confirm('You wont be able to edit after you publish.')" style="float:right;" <?php if(!empty($disable)){echo $disable; }?> >
                                                      
                                             </form>        
                          </div>
                     </div>
            </div>
       </div>
<?php include_once("includes/footer.php"); ?>