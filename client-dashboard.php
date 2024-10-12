<?php require_once("includes/session.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php require_once("includes/connections.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_POST['client_submit_msg'])) {
  require_once("includes/clientmsg-process.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/head.php"); ?>

<body style="background-color:#f0f0f7; ">
  <!-- Navigation -->
  <?php include_once("includes/header_menu.php"); ?>
  <?php
  // this is the left side
  include("client/client_dashboard_leftside.php");
  ?>
  <div class="col-md-9">
    <div class="spacebar"></div>
    <?php $sqll = "SELECT FORMAT((SUM(Debit)-SUM(Credit)), 2) AS LoanBalance  FROM tblloansactivities WHERE `client code` = ?";
    $stmt = $conn->prepare($sqll);
    $stmt->bind_param("s", $ecode);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $row1 = $result1->fetch_array();
    ?>
    <?php $sqld = "SELECT FORMAT((SUM(Credit)-SUM(Debit)), 2) AS DepositBalance FROM tbldepositsactivities WHERE `client code` = ?";
    $stmt = $conn->prepare($sqld);
    $stmt->bind_param("s", $ecode);
    $stmt->execute();
    $result2 = $stmt->get_result();
    $row2 = $result2->fetch_array();
    ?>

    <div class="row">
      <div class="col-md-5 welcomebg">
        <?php if (!empty($message)) {
          echo "<p class=\"alert alert-danger\">";
          echo $message;
          echo "</p>";
        }
        ?>
        <?php
        if (isset($_GET['msg'])) {
          if ($_GET['msg'] = "ok") {
            echo "<p class=\"alert alert-info\">";
            echo "Message sent";
            echo "</p>";
          }
        }
        ?>
        <h4>Dashboard,<br> Welcome <?php echo ucfirst($clientname) . " "; ?></h4>
      </div>
      <div class="col-md-5 acctbg"><strong>Grooming Staff Cooperative Bank Details:<br></strong>
        <span>Grooming Staff Coop. Society: Zenith Bank 1011882652<br></span>
        <span>Grooming Staff Welfare: Access Bank 0697476034</span>
      </div>
    </div><!-- row 1 end -->
    <div class="row">

      <div class="col-md-5 colbg">
        <h4 class="whitecolor">Deposits Balance</h4>
        <h4 class="yellowcolor"> N<?php if (!empty($row2['DepositBalance'])) {
                                    echo $row2['DepositBalance'];
                                  } else {
                                    echo "0.00";
                                  } ?></h4>
      </div>
      <div class="col-md-5 colbg">

        <h4 class="whitecolor">Loans Balance</h4>
        <h4 class="yellowcolor"> N<?php if (!empty($row1['LoanBalance'])) {
                                    echo $row1['LoanBalance'];
                                  } else {
                                    echo "0.00";
                                  } ?> </h4>
      </div>
      <div class="col-md-5 colbg">
        <?php
        $std = "SELECT `Approved` FROM tbldepositsapplications WHERE `Client code` = ? ORDER BY `ApplicationID` DESC LIMIT 1 ";
        $stmt = $conn->prepare($std);
        $stmt->bind_param("s", $ecode);
        $stmt->execute();
        $result3 = $stmt->get_result();
        $row3 = $result3->fetch_array();
        ?>
        <h4 class="whitecolor">New Deposit Request</h4>
        <h4 class="yellowcolor"><?php if ($row3 && $row3['Approved'] == "Y") {
                                  echo "Approved";
                                } elseif ($row3 && $row3['Approved'] == "D") {
                                  echo "Not Approved";
                                } else {
                                  echo "Pending";
                                } ?></h4>
      </div>
      <div class="col-md-5 colbg">
        <?php
        $stl = "SELECT `Approved` FROM tblloansapplications WHERE `Client code` = ? ORDER BY `ApplicationID` DESC LIMIT 1 ";
        $stmt = $conn->prepare($stl);
        $stmt->bind_param("s", $ecode);
        $stmt->execute();
        $result4 = $stmt->get_result();
        $row4 = $result4->fetch_array();
        ?>
        <h4 class="whitecolor">New Loan Request</h4>
        <h4 class="yellowcolor"> <?php if ($row4 && $row4['Approved'] == "Y") {
                                    echo "Approved";
                                  } elseif ($row4 && $row4['Approved'] == "D") {
                                    echo "Not Approved";
                                  } else {
                                    echo "Pending";
                                  } ?></h4>
      </div>
    </div><!-- row 2 end -->
  </div>
  </div>
  <?php include_once("includes/footer.php"); ?>