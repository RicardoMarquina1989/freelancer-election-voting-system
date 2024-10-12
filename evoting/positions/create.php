<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_POST['create_position'])) {
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
        <h1>Create Position</h1>
      </div>
    </div>
    <div class="spacebar"></div>

    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="panel-title">
          Create Position
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
            <label>Position: </label>
            <input type="text" name="position" value="<?php if (isset($_POST['create_position'])) {
                                                        echo htmlentities($position);
                                                      } ?>" required="required" maxlength="45" class="form-control" placeholder="Enter Position..." autofocus>
          </div>
          <div class="form-group">
            <label>Question: </label>
            <input type="text" name="question" value="<?php echo (isset($_POST['create_position']) ? htmlentities($question) : 'Vote One Of These Candidates For The Post Of:') ?>" required="required" maxlength="100" class="form-control" placeholder="Enter Question..." autofocus>
          </div>
          <!-- <div class="form-group">
            <label>Session:</label>
            <select class="form-control" name="sessionid" required="required">
              <option value="">--Please Select Session --</option>
              <?php
              $sql = "SELECT `sessionid`, `title`, DATE_FORMAT(`votingdate`, '%c/%e/%Y') as votingdate1, `status` FROM tblsessions  ORDER BY `votingdate` DESC";
              $stmt = $conn->prepare($sql);
              //$stmt->bind_param("s",$activated);
              $stmt->execute();
              $result = $stmt->get_result();
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
              ?>
                  <option value="<?php echo $row['sessionid']; ?>" <?php echo (isset($_GET['sessionid']) && $row['sessionid'] == $_GET['sessionid']) ? 'selected' : '' ?>><?php echo $row['title'] . "-" . $row['votingdate1'] . "-" . $row['status']; ?> </option>
              <?php
                }
              }
              ?>
            </select>
          </div> -->
          <div class="spacebar"></div>
          <input type="submit" value="Create" name="create_position" class="btn btn-success">
      </div>
      </form>
    </div>
  </div>
  </div>

  </div>
  <?php include_once("../../includes/footer.php"); ?>