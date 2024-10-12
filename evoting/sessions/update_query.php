<?php


if (isset($_POST['update_session'])) {
    $session_title = ucwords($_POST['title']);
    $votingdate = $_POST['votingdate'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    if ($starttime >= $endtime) {
        $message = "Please pick valid time.";
        return;
    } else {
        $sql = "UPDATE `tblsessions` SET `title`=?, `votingdate`=?, `starttime`=?, `endtime`=? WHERE sessionid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $session_title, $votingdate, $starttime, $endtime, $_POST['sessionid']);
        $result = $stmt->execute();
        if ($result === TRUE) {
            redirect_to("index.php?report=1&type=Updated");
        } else {
            redirect_to("index.php?report=0&type=Updated");
        }
    }
}
//redirect_to("admin-user-report.php?report=2");
