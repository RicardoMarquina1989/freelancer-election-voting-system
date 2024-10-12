<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php if (empty($_GET['confirmed']) || !$_GET['confirmed']) {
    include('./check-delete.php');
} ?>
<?php
if (isset($_GET['positionid'])) {

    try {
        $sql = "DELETE FROM `tblpositions` WHERE `positionid`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_GET['positionid']);
        $result = $stmt->execute();

        $redirect_url = 'index.php?type=Deleted&report=' . ($result === TRUE ? '1' : '0');
        $redirect_url .= isset($_GET['sessionid']) ? '&sessionid=' . $_GET['sessionid'] : '';

        redirect_to($redirect_url);
    } catch (\Throwable $th) {
        redirect_to('index.php?type=Deleted&report=-1');
    }
}

redirect_to("index.php?type=Deleted&report=2");
