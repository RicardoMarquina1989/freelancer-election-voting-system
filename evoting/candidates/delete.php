<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php if (empty($_GET['confirmed']) || !$_GET['confirmed']) {
    include('./check.php');
} ?>
<?php
if (isset($_GET['candidateid'])) {

    try {
        $sql = "DELETE FROM `tblcandidates` WHERE `candidateid`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_GET['candidateid']);
        $result = $stmt->execute();

        $redirect_url = 'index.php?type=Deleted&report=' . ($result === TRUE ? '1' : '0');
        $redirect_url .= isset($_GET['sessionid']) ? '&sessionid=' . $_GET['sessionid'] : '';

        redirect_to($redirect_url);
    } catch (\Throwable $th) {
        $redirect_url = 'index.php?report=-1&type=Deleted';
    }
}

redirect_to("index.php?report=2&type=Deleted");
