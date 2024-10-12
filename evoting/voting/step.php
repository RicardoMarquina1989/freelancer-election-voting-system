<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$sql = "SELECT title FROM tblsessions WHERE `status` = 'open' AND votingdate=? AND sessionid=?";
$stmt = $conn->prepare($sql);
$today = date('Y-m-d');
$stmt->bind_param("si", $today, $_GET['sessionid']);
$stmt->execute();
$result = $stmt->get_result();
$voting_session = $result->fetch_assoc();

$sql = "SELECT COUNT(positionid) AS cnt FROM tblpositions WHERE positionid IN (SELECT positionid FROM tblcandidates WHERE `sessionid`=?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['sessionid']);
$stmt->execute();
$result = $stmt->get_result();
$temp_row = $result->fetch_assoc();
$voting_session['cnt'] = $temp_row['cnt'];

if (isset($_GET['positionid']) && isset($_GET['selected_candidate'])) {
  $step = $_GET['step'] - 1;
  $_SESSION['voting'][$step] = $_GET['positionid'] . '_' . $_GET['selected_candidate'];
  if ($voting_session['cnt'] < $_GET['step']) {  //insert voting result
    $clientid = $_SESSION['user_id'];
    $votingdate = date('Y-m-d h:i:s');
    $sessionid = $_GET['sessionid'];
    $hasError = 0;
    try {
      //code...
      foreach ($_SESSION['voting'] as $value) {
        $mixed = explode('_', $value);
        $positionid = $mixed[0];
        $candidateid = $mixed[1];

        $sql = "INSERT INTO `tblvotingresult` (`clientid`, `positionid`, `candidateid`, `voteddate`, `sessionid`) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiisi", $clientid, $positionid, $candidateid, $votingdate, $sessionid);
        $result = $stmt->execute();
      }
    } catch (\Throwable $th) {
      //throw $th;
      $hasError = 1;
    }
    if ($hasError) {
      redirect_to("index.php?report=0");
    } else {
      redirect_to("index.php?report=1");
    }
  }
}

$position = [];
if ($_GET['step'] > 0) {
  // $sql = "SELECT positionid,position FROM tblpositions WHERE sessionid=? LIMIT ?,1";
  $sql = "SELECT positionid,position,question FROM tblpositions WHERE positionid IN (SELECT positionid FROM tblcandidates WHERE sessionid=?) LIMIT ?,1";
  $stmt = $conn->prepare($sql);
  $offset = $_GET['step'] - 1;
  $stmt->bind_param("ii", $_GET['sessionid'], $offset);
  $stmt->execute();
  $result = $stmt->get_result();
  $position = $result->fetch_assoc();
}

$sql = "SELECT candidateid,firstname,middlename,surname,picture FROM tblcandidates WHERE sessionid=? AND positionid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $_GET['sessionid'], $position['positionid']);
$stmt->execute();
$result = $stmt->get_result();
$candidates = [];

while ($row = $result->fetch_assoc()) {
  $candidates[] = $row;
}
// $_SESSION['position_'.$position]
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("../../includes/head.php"); ?>

<body style="background-color:#f0f0f7; ">
  <!-- Navigation -->
  <?php include_once("../../includes/header_menu.php"); ?>

  <?php
  // this is the left side
  include("../../client/client_dashboard_leftside.php");
  ?>

  <div class="col-md-8">
    <div class="spacebar"></div>
    <?php if (!empty($message)) {
      echo "<div class=\"alert alert-info\">" . $message . "</div>";
    } ?>

    <div class="breadcrumb1">
      <div class="bread-title king-toolbar">
        <h1 class="float-left"><?php echo $voting_session['title'] ?></h1>
        <div class="float-right">
          <a href="index.php" class="btn btn-primary">Cancel</a>
        </div>
      </div>

    </div>
    <div class="spacebar"></div>
    <form method="get" action="step.php">
      <input type="hidden" name="sessionid" value="<?php echo $_GET['sessionid'] ?>" />
      <input type="hidden" name="step" value="<?php echo $_GET['step'] + 1 ?>" />
      <input type="hidden" name="positionid" value="<?php echo $position ? $position['positionid'] : '' ?>" />
      <div class="row">
        <div class="col-md-12 king-voting-content">
          <?php
          if ($_REQUEST['step'] > 0) {
          ?>
            <h1 class="king-voting-position"><?php echo $position['question'] ?? "" ?><?php echo $position['position'] ?></h1>
            <ul class="king-voting-list">
              <?php
              if (count($candidates)) {
                foreach ($candidates as $key => $candidate) {
              ?>
                  <li>
                    <input type="radio" name="selected_candidate" id="<?php echo 'cand' . $key ?>" value="<?php echo $candidate['candidateid']; ?>" required="required" />
                    <img src="<?php echo $candidate['picture'] ?>" width="100" height="100" alt="candidate photo" />
                    <label for="<?php echo 'cand' . $key ?>">
                      <h1><?php echo $candidate['firstname'] . ($candidate['middlename'] ? (' ' . $candidate['middlename']) : '') . ' ' . $candidate['surname']; ?>
                      </h1>
                    </label>
                  </li>
              <?php
                }
              } else {
                echo "<h3>Server Error<br/><br/>None of candidates weren't set for this positon. You can't move forward any more. Please contact with adminitrator and cancel button to return homepage. </h3>";
              }
              ?>
            </ul>
          <?php
          } else { ?>
            <p>Note that you can only vote <strong>once</strong> Therefore, kindly ensure that you have voted the right candidates as the process is irreversible once submitted.</p>
            <p>There are <strong><?php echo $voting_session['cnt'] ?></strong> questions in this voting session.</p>
          <?php } ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 king-toolbar">
          <?php if ($_GET['step'] > 0) : ?><a href="step.php?sessionid=<?php echo $_GET['sessionid'] ?>&step=<?php echo $_GET['step'] - 1 ?>" class="btn btn-primary">Prev</a>
          <?php else : ?>
            <span></span>
          <?php endif; ?>
          <?php
          if ($_GET['step'] == 0 || count($candidates) > 0) { ?><button class="btn btn-success"><?php echo $_GET['step'] == $voting_session['cnt'] ? 'Submit' : 'Next' ?></button>
          <?php }
          ?>

        </div>
    </form>
  </div>
  </div>

  </div>
  <?php include_once("../../includes/footer.php"); ?>