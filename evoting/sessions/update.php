<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_POST['update_session'])) {
  require_once("update_query.php");
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
        <h1>Update Session</h1>
      </div>
    </div>
    <div class="spacebar"></div>

    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="panel-title">
          Update Session
        </div>
      </div>
      <div class="panel-body">
        <form method="post" autocomplete="off">
          <?php if (!empty($message)) {
            echo "<p class=\"alert alert-danger\">";
            echo $message;
            echo "</p>";
          } ?>

          <?php
          $query = "SELECT * FROM tblsessions WHERE sessionid=?";
          $stmt = $conn->prepare($query);
          $stmt->bind_param("i", $_GET['sessionid']);
          $stmt->execute();
          $result = $stmt->get_result();
          $row = $result->fetch_assoc()
          ?>
          <input type="hidden" name="sessionid" value="<?php echo $_GET['sessionid'] ?>" />
          <div class="form-group">
            <label>Title: </label>
            <input type="text" name="title" value="<?php echo htmlentities($row['title']); ?>" required="required" maxlength="45" class="form-control" placeholder="Enter Session Title...">
          </div>
          <div class="form-group">
            <label>Voting Date</label>
            <input type="date" name="votingdate" value="<?php echo $row['votingdate'] ?>" required="required" maxlength="15" class="form-control" placeholder="Select voting date...">
          </div>
          <div class="form-group">
            <label>Start Time</label>
            <input type="time" name="starttime" value="<?php echo $row['starttime'] ?>" required="required" maxlength="40" class="form-control" placeholder="Pick start time...">
          </div>
          <div class="form-group">
            <label>End Time</label>
            <input type="time" name="endtime" value="<?php echo $row['endtime'] ?>" required="required" maxlength="40" class="form-control" placeholder="Pick end time...">
          </div>
          <div class="form-group">
            <label>Status: </label>
            <select name="status" disabled>
              <option value="open">Open</option>
              <option value="closed">Closed</option>
            </select>
          </div>
          <div class="spacebar"></div>
          <input type="submit" value="Update" name="update_session" class="btn btn-success">
      </div>
      </form>
    </div>
  </div>
  </div>

  </div>
  <?php include_once("../../includes/footer.php"); ?>