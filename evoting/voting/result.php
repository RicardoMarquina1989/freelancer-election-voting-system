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
  if (array_key_exists('is_admin', $_SESSION) && $_SESSION['is_admin']) {
    // admin dashboard left side here
    include('../../includes/admin_dashboard_leftside.php');
  } else {
    // this is the left side
    include("../../client/client_dashboard_leftside.php");
  }
  ?>
  <?php
  $alert = '';
  if (isset($_GET['status']) && $_GET['status'] == 'select_session') {
    $message = "Select the session to export.";
  }
  ?>
  <div class="col-md-8">
    <div class="spacebar"></div>
    <?php include_once('result_template.php'); ?>
  </div>

  </div>
  <?php include_once("../../includes/footer.php"); ?>