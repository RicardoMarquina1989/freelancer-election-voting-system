<?php global $id;
$cand_id = intval($_SESSION['user_id']);
$username = $_SESSION['surname'];
?>
<div class="row" style="margin-top: 0; padding-top: 0;">
  <div class="col-md-3">
    <div class="leftcol">
      <?php
      $sql = "SELECT `Surname`, `First name`, `Active`, `EmailAddress` FROM tblcandidates WHERE `CandidateID`=? LIMIT 1";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $cand_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_array();
      ?>
      <h4>CANDIDATE</h4>
      <div class="basic-info">
        <p>Name: <?php echo $row['Surname'] . " " . $row['First name']; ?></p>
        <p> Email: <?php echo $row['EmailAddress']; ?></p>
        <p> Account Status: <?php if ($row['Active'] == "N") {
                              echo "Not Activated";
                            } else {
                              echo "Active";
                            }; ?></p>
      </div>
      <div class="cdash-menu">
        <ul class="mainmenu">
          <li><a href="cdashboard.php">Dashboard</a></li>
          <li><a href="candidate-announcements.php">Announcements</a></li>
          <li><a href="#">Vacacies<strong style="float: right;"> + </strong></a>
            <ul class="submenu">
              <li><a href="candidate-vacancy.php">Job Vacancies</a></li>
              <li><a href="candidate-jobapplication-history.php">Job Application History</a></li>
            </ul>
          </li>
          <li><a href="candidate-profile.php">Profile</a></li>
          <li><a href="/logout.php">Log out</a></li>
        </ul>
      </div>
    </div>
  </div>