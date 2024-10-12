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
  // admin dashboard left side here
  include('includes/admin_dashboard_leftside.php');
   ?>
            <div class="col-md-9"><div class="spacebar"></div>
                <h1>Dashboard, Welcome <?php echo ucfirst($row['Login name']) . " "; ?></h1>
                <div class="row">
                        <div class="col-md-3 colbg">
                              <?php
                                $std = "SELECT `Surname`, `First name` FROM tblclientsregistrations WHERE Activated = 'N' ";
                                $query = $conn->query($std);
                               $total_activation = $query->num_rows;                  
                                ?>
                                    <p><strong>Members Activations Pending</strong></p>
                                         <h2><strong style="color: #FFFF00;"><?php  echo $total_activation; ?></strong></h2>
                        </div>
                        <div class="col-md-3 colbg">
                                 <?php
                                  $std = "SELECT `ApplicationID`, `Client code` FROM tbldepositsapplications WHERE Approved = 'N' ";
                                  $query = $conn->query($std);
                                 $total_leave = $query->num_rows;                  
                                  ?>
                                      <p><strong>Deposits Approvals Pending </strong></p>
                                            <h2><strong style="color: #FFFF00;"><?php  echo $total_leave; ?> </strong></h2>
                        </div>
                        <div class="col-md-3 colbg">
                                  <?php
                                  $std = "SELECT `ApplicationID`, `Client code` FROM `tblloansapplications` WHERE Approved = 'N' ";
                                  $query = $conn->query($std);
                                 $total_loan = $query->num_rows;                  
                                  ?>
                                        <p><strong>Loans Approvals Pending</strong></p>
                                            <h2><strong style="color: #FFFF00;"><?php echo $total_loan; ?></strong></h2>
                        </div>        
              </div>

        <div class="row">
                        <div class="col-md-3 colbg">
                              <?php
                                $dreq = "SELECT `ApplicationID` FROM tbldepositsstatementsapply WHERE Sent = 'N' ";
                                $query = $conn->query($dreq);
                               $total_request = $query->num_rows;                  
                                ?>
                                    <p><strong>Deposits Statement Pending</strong></p>
                                         <h2><strong style="color: #FFFF00;"><?php  echo $total_request; ?></strong></h2>
                        </div>
                        <div class="col-md-3 colbg">
                                 <?php
                                  $lreq = "SELECT `ApplicationID` FROM tblloansstatementsapply WHERE Sent = 'N' ";
                                  $query = $conn->query($lreq);
                                 $total_loan_req = $query->num_rows;                  
                                  ?>
                                      <p><strong>Loans Statement Pending </strong></p>
                                            <h2><strong style="color: #FFFF00;"><?php  echo $total_loan_req; ?> </strong></h2>
                        </div>
                        <div class="col-md-3 colbg">
                                  <?php
                                  $adm = "SELECT `Full name` FROM `tblaccess` WHERE Active = 'Y' ";
                                  $query = $conn->query($adm);
                                 $total_admin = $query->num_rows;                  
                                  ?>
                                        <p><strong>Active Admin</strong></p>
                                            <h2><strong style="color: #FFFF00;"><?php echo $total_admin; ?></strong></h2>
                        </div>        
        </div><!-- end of second row -->


            </div>         
       </div>
  <?php include_once("includes/footer.php"); ?>