<?php
global $id;
$id = intval($_SESSION['user_id']);
$username = $_SESSION['fullname'];
?>
<div class="row" style="margin-top: 0; padding-top: 0;">
  <div class="col-md-3">
    <div class="leftcol">
      <?php
      $sql = "SELECT `Login name`, `Full name`, `Description Of User` FROM tblaccess WHERE `User ID`=? LIMIT 1";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_array();
      ?>
      <h4><strong class="txtshadow">ADMIN</strong></h4>
      <div class="basic-info">
        <p> Name: <?php echo $row['Full name']; ?></p>
        <p>Description: <?php echo $row['Description Of User']; ?></p>
        <!-- <p>Today: <?php $date = new datetime();
                        echo $date->format('M d, Y'); ?></p>  -->
      </div>
      <div class="cdash-menu">
        <ul class="mainmenu">
          <li><a href="/admin-dashboard.php">Dashboard</a></li>
          <li><a href="/check_admin.php?pca=<?php echo $id; ?>">Members Activations </a></li>
          <li><a href="/check_admin.php?pda=<?php echo $id; ?>">Deposits Approvals</a></li>
          <li><a href="/check_admin.php?pla=<?php echo $id; ?>">Loans Approvals</a></li>
          <li><a href="/admin-deposits-statement.php">Deposits Statement</a></li>
          <li><a href="/admin-loans-statement.php">Loans Statement</a></li>
          <li><a href="#">eVoting <strong style="float: right;"> + </strong></a>
            <ul class="submenu">
              <li><a href="/check_admin.php?sessions=<?php echo $id; ?>">Sessions</a></li>
              <li><a href="/check_admin.php?positions=<?php echo $id; ?>">Positions</a></li>
              <li><a href="/check_admin.php?candidates=<?php echo $id; ?>">Candidates</a></li>
              <!-- <li><a href="/check_admin.php?questions=<?php echo $id; ?>">Questions</a></li> -->
              <!-- <li><a href="/check_admin.php?check_type=<?php echo $id; ?>">Closing</a></li> -->
              <li><a href="/check_admin.php?voting=<?php echo $id; ?>">Voting Results</a></li>
            </ul>
          </li>
          <li><a href="#">Admin Users <strong style="float: right;"> + </strong></a>
            <ul class="submenu">
              <li><a href="/check_admin.php?id=<?php echo $id; ?>">Create Admin User</a></li>
              <li><a href="/check_admin.php?check_type=<?php echo $id; ?>">Admin Users Listing</a></li>
              <li><a href="/admin-profile.php?aid=<?php echo $id; ?>">Admin Profile</a></li>
            </ul>
          </li>
          <li><a href="/logout.php">Log out</a></li>
        </ul>
      </div>
    </div>
  </div>