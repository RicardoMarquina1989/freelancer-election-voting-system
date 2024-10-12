<?php global $id;
$id = intval($_SESSION['user_id']);
$username = $_SESSION['surname'];
?>
<div class="row" style="">
  <div class="col-md-3">
    <div class="leftcol">
      <?php
      $sql = "SELECT Surname, `First name`, `Employee code`, EmailAddress  FROM tblemployees WHERE EmployeeID=? LIMIT 1";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_array();
      $_SESSION['ecode'] = $row['Employee code'];
      $ecode = $row['Employee code'];
      ?>
      <h4><strong class="txtshadow">EMPLOYEE</strong></h4>
      <div class="basic-info">

        <p> Name: <?php echo $row['Surname'] . " " . $row['First name']; ?></p>
        <p>Email: <?php echo $row['EmailAddress']; ?></p>
        <p>Employee Code: <?php echo $row['Employee code']; ?> </p>

      </div>
      <div class="cdash-menu">
        <ul class="mainmenu">
          <li><a href="edashboard.php">Dashboard</a></li>
          <li><a href="employee-announcements.php">Announcements</a></li>
          <li><a href="employee-news.php">News</a></li>
          <li><a href="#" class="sub" tabindex="1">Loans <strong style="float: right;"> + </strong></a>
            <ul class="submenu">
              <li><a href="employee-apply-loan.php">Apply For Loan</a></li>
              <li><a href="employee-loan.php">Loan Application History</a></li>
            </ul>
          </li>
          <li><a href="#">Leaves <strong style="float: right;"> + </strong></a>
            <ul class="submenu">
              <li><a href="employee-apply-leave.php">Apply For Leave</a></li>
              <li><a href="employee-leave.php">Leave Application History</a></li>
            </ul>
          </li>
          <li><a href="#">Trainings <strong style="float: right;"> + </strong></a>
            <ul class="submenu">
              <li><a href="employee-apply-training.php">Apply For Training</a></li>
              <li><a href="employee-training.php">Training Application History</a></li>
            </ul>
          </li>
          <li><a href="#appraisals.php">Appraisals</a></li>
          <li><a href="#queries.php">Queries</a></li>
          <li><a href="employee-payslips.php">Pay Slips</a></li>
          <li><a href="employee-documents.php">Documents Listing</a></li>
          <li><a href="#candidate-profile.php">Profile</a></li>
          <li><a href="/logout.php">Log out</a></li>
        </ul>
      </div>
    </div>
  </div>