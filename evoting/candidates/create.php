<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_POST['create_candidate'])) {
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
        <h1>Create Candidate</h1>
      </div>
    </div>
    <div class="spacebar"></div>

    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="panel-title">
          Create Candidate
        </div>
      </div>
      <div class="panel-body">
        <form method="post" enctype="multipart/form-data" autocomplete="off">
          <?php if (!empty($message)) {
            echo "<p class=\"alert alert-danger\">";
            echo $message;
            echo "</p>";
          } ?>
          <div class="form-group">
            <label>First name: </label>
            <input type="text" name="firstname" value="<?php if (isset($_POST['create_candidate'])) {
                                                          echo htmlentities($firstname);
                                                        } ?>" required="required" maxlength="45" class="form-control" placeholder="Enter First name..." autofocus>
          </div>
          <div class="form-group">
            <label>Middle name: </label>
            <input type="text" name="middlename" value="<?php if (isset($_POST['create_candidate'])) {
                                                          echo htmlentities($middlename);
                                                        } ?>" maxlength="45" class="form-control" placeholder="Enter Middle name..." autofocus>
          </div>
          <div class="form-group">
            <label>Last name: </label>
            <input type="text" name="surname" value="<?php if (isset($_POST['create_candidate'])) {
                                                        echo htmlentities($surname);
                                                      } ?>" required="required" maxlength="45" class="form-control" placeholder="Enter Last name..." autofocus>
          </div>

          <div class="row">
            <div class="col-md-6">
              <label for="otherField2">Photo:<span class="error"><?php if (isset($_POST['create_candidate'])) {
                                                                    echo $photoErr;
                                                                  } ?></span></label>
              <input type="file" name="photo" id="otherField2" value="<?php if (isset($_POST['create_candidate'])) {
                                                                        echo htmlentities($photo_upload);
                                                                      } ?>" required="required">
            </div>
            <div class="col-md-6">
              <strong>
                <i>
                  <ul>
                    <li>Photograph must be uploaded in (jpeg|png|webp) format with max size of 75kb</li>
                  </ul>
                </i>
              </strong>
            </div>
          </div>
          <div class="form-group">
            <label>Position:</label>
            <select class="form-control" name="positionid" required="required">
              <option value="">--Please Select Position --</option>
              <?php
              $sql = "SELECT `positionid`, `position` FROM tblpositions ORDER BY `positionid` ASC";
              $stmt = $conn->prepare($sql);
              //$stmt->bind_param("s",$activated);
              $stmt->execute();
              $result = $stmt->get_result();
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
              ?>
                  <option value="<?php echo $row['positionid']; ?>"><?php echo $row['position'] ?> </option>
              <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Session:</label>
            <select class="form-control" name="sessionid" required="required">
              <option value="">--Please Select Session --</option>
              <?php
              $sql = "SELECT `sessionid`, `title`, DATE_FORMAT(`votingdate`, '%c/%e/%Y') as votingdate1, `status` FROM tblsessions WHERE `status`='open' ORDER BY `votingdate` DESC";
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
          </div>
          <div class="spacebar"></div>
          <input type="submit" value="Create" name="create_candidate" class="btn btn-success">
      </div>
      </form>
    </div>
  </div>
  </div>

  </div>
  <?php include_once("../../includes/footer.php"); ?>