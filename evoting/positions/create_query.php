<?php
if (isset($_POST['create_position'])) {
    $position = ucwords($_POST['position']);
    $question = ucwords($_POST['question']);
    // $sessionid = $_POST['sessionid'];

    $sql = "INSERT INTO `tblpositions` (`position`, `question`, `createdby`, `datecreated`) VALUES (?,?,?,?)";
    // $sql = "INSERT INTO `tblpositions` (`position`, `sessionid`, `createdby`, `datecreated`) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $today = date('Y-m-d h:i:s');
    $stmt->bind_param("ssis", $position, $question, $_SESSION['user_id'], $today);
    $result = $stmt->execute();
    if ($result === TRUE) {
        redirect_to("index.php?report=1&type=Created");
    } else {
        redirect_to("index.php?report=0&type=Created");
    }
}
//redirect_to("admin-user-report.php?report=2");
