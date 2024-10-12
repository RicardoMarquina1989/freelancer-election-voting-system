<?php global $id;
$id = intval($_SESSION['user_id']);
$clientname = $_SESSION['clientname'];
?>
<div class="row" style="">
  <div class="col-md-3">
    <div class="leftcol">
      <?php
      $sql = "SELECT `Surname`, `First name`, `Client code`, `Email address`, `Photograph` FROM tblclientsregistrations WHERE RegID=? LIMIT 1";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_array();
      // $_SESSION['c_code'] = $row['Client code'];
      $ecode = $row['Client code'];
      $client_email = $row['Email address'];
      ?>
      <div class="dp-container"><img src="<?php echo $row['Photograph']; ?>" class="dp"><span class="mem">MEMBER</span></div>
      <div class="basic-info">
        <span> NAME: <?php echo strtoupper($row['First name'] . " " . $row['Surname']); ?><br></span>
        <span>CODE: <?php echo strtoupper($row['Client code']); ?> </span>
      </div>
      <div class="cdash-menu">
        <ul class="mainmenu">
          <li><a href="/client-dashboard.php">Dashboard</a></li>
          <li><a href="#" class="sub" tabindex="1">Deposits <strong style="float: right;"> + </strong></a>
            <ul class="submenu">
              <li><a href="/client-apply-deposit.php">Apply For Deposit</a></li>
              <li><a href="/client-deposit-statement.php">Deposits Statements</a></li>
              <li><a href="/client-deposit.php">Deposits Application History</a></li>
            </ul>
          </li>
          <li><a href="#" class="sub" tabindex="1">Loans <strong style="float: right;"> + </strong></a>
            <ul class="submenu">
              <li><a href="/client-apply-loan.php">Apply For Loan</a></li>
              <li><a href="/client-loan-statement.php">Loans Statements</a></li>
              <li><a href="/client-loan.php">Loans Application History</a></li>
            </ul>
          </li>
          <li><a href="/client-profile.php">Member's Profile</a></li>
          <li><a href="/client-send-message.php">Send Message to Admin</a></li>
          <li><a href="#" class="sub" tabindex="1">eVoting <strong style="float: right;"> + </strong></a>
            <ul class="submenu">
              <li><a href="/evoting/voting/index.php">Voting</a></li>
              <li><a href="/evoting/voting/result.php">Voting Results</a></li>
            </ul>
          </li>
          <li><a href="logout.php">Log out</a></li>
        </ul>
      </div>
    </div>
  </div>