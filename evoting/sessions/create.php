<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_POST['create_session'])) {
  require_once("create_query.php");
}
?>
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
  <div class="spacebar"></div>
  <div class="col-md-8">
    <div class="spacebar"></div>
    <div class="breadcrumb1">
      <div class="bread-title">
        <h1>Create Session</h1>
      </div>
    </div>
    <div class="spacebar"></div>

    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="panel-title">
          Create Session
        </div>
      </div>
      <div class="panel-body">
        <form method="post" autocomplete="off">
          <?php if (!empty($message)) {
            echo "<p class=\"alert alert-danger\">";
            echo $message;
            echo "</p>";
          } ?>
          <div class="form-group">
            <label>Title: </label>
            <input type="text" name="session_title" value="<?php if (isset($_POST['create_session'])) {
                                                              echo htmlentities($session_title);
                                                            } ?>" required="required" maxlength="45" class="form-control" placeholder="Enter Session Title..." autofocus>
          </div>
          <div class="form-group">
            <label>Voting Date</label>
            <input type="date" name="votingdate" value="<?php if (isset($_POST['create_session'])) {
                                                          echo htmlentities($votingdate);
                                                        } ?>" required="required" maxlength="15" class="form-control" placeholder="Select voting date...">
          </div>
          <div class="form-group">
            <label>Start Time</label>
            <input type="time" name="starttime" value="<?php if (isset($_POST['create_session'])) {
                                                          echo htmlentities($starttime);
                                                        } ?>" required="required" maxlength="40" class="form-control" placeholder="Pick start time...">
          </div>
          <div class="form-group">
            <label>End Time</label>
            <input type="time" name="endtime" value="<?php if (isset($_POST['create_session'])) {
                                                        echo htmlentities($endtime);
                                                      } ?>" required="required" maxlength="40" class="form-control" placeholder="Pick end time...">
          </div>
          <div class="spacebar"></div>
          <input type="submit" value="Create" name="create_session" class="btn btn-success">
      </div>
      </form>
    </div>
  </div>
  </div>

  </div>
  <?php include_once("../../includes/footer.php"); ?>