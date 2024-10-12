<?php
if (isset($_POST['create_session'])) {
    $session_title = ucwords($_POST['session_title']);
    $votingdate = $_POST['votingdate'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    $status = 'open';
    if ($starttime >= $endtime) {
        $message = "Please pick valid time.";
        return;
    } else {
        $sql = "INSERT INTO `tblsessions` (`title`, `votingdate`, `starttime`, `endtime`, `createdby`, `datecreated`, `status`) VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiss", $session_title, $votingdate, $starttime, $endtime, $_SESSION['user_id'], date('Y-m-d h:i:s'), $status);
        $result = $stmt->execute();
        if ($result === TRUE) {
            redirect_to("index.php?report=1&type=Created");
        } else {
            redirect_to("index.php?report=0&type=Created");
        }
    }
}
//redirect_to("admin-user-report.php?report=2");
