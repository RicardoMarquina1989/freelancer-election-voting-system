<?php global $id;
$cand_id = intval($_SESSION['user_id']);
$username = $_SESSION['surname'];
?>
<div class="row" style="margin-top: 0; padding-top: 0;">
  <div class="col-md-3">
    <div class="leftcol">
      <?php
      $sql = "SELECT surname, firstname, usermail, reg_datetime FROM candidate_register WHERE id=? LIMIT 1";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $cand_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_array();
      $date = $row['reg_datetime'];
      ?>
      <h4>CANDIDATE BASIC INFO</h4>
      <div class="basic-info">
        <p>Name: <?php echo $row['surname'] . " " . $row['firstname']; ?></p>
        <p> Email: <?php echo $row['usermail']; ?></p>
        <p> Reg Date: <?php echo $row['reg_datetime']; ?></p>
      </div>
      <div class="cdash-menu">
        <ul class="mainmenu">
          <li><a href="cdashboard.php">Dashboard</a></li>
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