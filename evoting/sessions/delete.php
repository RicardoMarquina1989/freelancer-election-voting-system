<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php if (empty($_GET['confirmed']) || !$_GET['confirmed']) {
    include('./check-delete.php');
} ?>

<?php
if (isset($_GET['sessionid'])) {

    try {
        $sql = "DELETE FROM `tblsessions` WHERE `sessionid`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_GET['sessionid']);
        $result = $stmt->execute();

        if ($result === TRUE) {
            redirect_to("index.php?report=1&type=Deleted");
        } else {
            redirect_to("index.php?report=0&type=Deleted");
        }
    } catch (\Throwable $th) {
        redirect_to("index.php?report=-1&type=Deleted");
    }
}
//redirect_to("admin-user-report.php?report=2");
