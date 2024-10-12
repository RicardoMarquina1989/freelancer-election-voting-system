<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php if (empty($_GET['confirmed']) || !$_GET['confirmed']) {
    include('./check.php');
} ?>

<?php
if (isset($_GET['sessionid'])) {
    $sql = "UPDATE `tblsessions` SET `closedby`=?, `dateclosed`=?, `status`='closed' WHERE sessionid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $_SESSION['user_id'], date('Y-m-d h:i:s'), $_GET['sessionid']);
    $result = $stmt->execute();

    if ($result === TRUE) {
        redirect_to("index.php?report=1&type=Closed");
    } else {
        redirect_to("index.php?report=0&type=Closed");
    }
}
//redirect_to("admin-user-report.php?report=2");
