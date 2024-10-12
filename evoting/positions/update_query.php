<?php


if (isset($_POST['update_position'])) {
    $position = ucwords($_POST['position']);
    $question = ucwords($_POST['question']);
    // $sessionid = $_POST['sessionid'];
    $sql = "UPDATE `tblpositions` SET `position`=?,`question`=? WHERE positionid=?";
    // $sql = "UPDATE `tblpositions` SET `position`=?,`sessionid`=? WHERE positionid=?";
    $stmt = $conn->prepare($sql);
    // $stmt->bind_param("sii", $position, $sessionid, $_POST['positionid']);
    $stmt->bind_param("ssi", $position, $question, $_POST['positionid']);
    $result = $stmt->execute();

    $redirect_url = 'index.php';
    if ($result === TRUE) {
        redirect_to($redirect_url . "?report=1&type=Updated");
    } else {
        redirect_to($redirect_url . "?report=0&type=Updated");
    }
}
//redirect_to("admin-user-report.php?report=2");
