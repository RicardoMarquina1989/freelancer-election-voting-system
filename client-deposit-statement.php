<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php $message = "";
 if(isset($_POST['request']) && !empty($_POST['client_code'])){
  $date_from = test_input($_POST['date_from']);
    $date_to = test_input($_POST['date_to']);
      $date_applied = test_input($_POST['date_applied']);
      $client_code = test_input($_POST['client_code']);
            $sql = "INSERT INTO `tbldepositsstatementsapply` (`Client code`,`Date applied`, `FromDate`, `ToDate`) VALUES (?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ssss",$client_code,$date_applied,$date_from,$date_to);
    $result = $stmt->execute();
    if ($result === TRUE) {
     redirect_to("client-deposit-statement.php?request=1");
} else {
     redirect_to("client-deposit-statement.php?request=0");
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
  // this is the left side
  include("client/client_dashboard_leftside.php");
   ?>
            <div class="col-md-9">
                        <div class="spacebar"></div>
                            <div class="breadcrumb1">
                                  <div class="bread-title">
                                      <h1>Deposits Statements</h1>
                                  </div>
                            </div>
                        
                      <div class="spacebar"></div>
                       <div class="row"> <?php 
                        $message = ""; 
                        if(isset($_GET['request'])&& ($_GET['request']=="1")){ $message ="Request submitted successfully. Statement will be sent to your email.";} elseif(isset($_GET['request'])&& ($_GET['request']=="0")){$message ="Failed! Try later.";}else{}?>
                                              <?php if(!empty($message)){
                                                echo "<div class=\"alert alert-info\">" . $message. "</div>";
                                              }
                                              ?> 
                                                
                      </div>  
                        <form method="post">
                                   <table class="accttitle" width="80%" border="1">
                                         <tr class="thbg">
                                           <th>&nbsp;From:</th>
                                           <th> <input type="date" class="form-control" name="date_from" value="" id="subject" required="required" placeholder="Pick date"></th>
                                           <td colspan="1" align="center" style="border-right: none;"><input type="submit" name="request" value="Request" class="btn btn-success"></td>
                                         </tr>
                                         <tr class="thbg">
                                           <th>&nbsp;To:</th><th><input type="date" class="form-control" name="date_to" value="" id="subject" required="required" placeholder="Pick date"></th>
                                         </tr> 
                                          <tr class="thbg">
                                           <th>&nbsp;Date Applied:</th><th><input type="date" class="form-control" name="date_applied" required="required" placeholder="Pick date"></th>
                                         </tr>                                                               
                                  </table>
                                  <input type="hidden" name="client_code" value="<?php echo $ecode; ?>">
                        </form>         
                                        <div class="spacebar"></div>
            </div> 
       </div>
<?php include_once("includes/footer.php"); ?>