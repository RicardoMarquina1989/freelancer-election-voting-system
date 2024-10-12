<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("../../includes/head.php"); ?>

<body style="background-color:#f0f0f7; ">
  <!-- Navigation -->
  <?php include_once("../../includes/header_menu.php"); ?>

  <?php
  // admin dashboard left side here
  include('../../includes/admin_dashboard_leftside.php');
  ?>
  <div class="col-md-8">
    <div class="spacebar"></div>
    <?php if (isset($_GET['depositapply']) && !empty($_GET['depositapply'])) {
      if ($_GET['depositapply']  == "success") {
        $message = "New Application Successful";
      }
      if ($_GET['depositapply']  == "error") {
        $message = "Application Failed";
      }
      if ($_GET['depositapply']  == "applied") {
        $message = "Sorry you cannot apply at the moment. You have a pending application";
      }
    }
    ?><?php if (!empty($message)) {
        echo "<div class=\"alert alert-info\">" . $message . "</div>";
      } ?>
    <?php include_once('result_template.php'); ?>
  </div>

  </div>
  <?php include_once("../../includes/footer.php"); ?>