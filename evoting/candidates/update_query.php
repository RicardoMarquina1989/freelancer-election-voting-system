<?php


if (isset($_POST['update_candidate'])) {
    $firstname = ucwords($_POST['firstname']);
    $middlename = ucwords($_POST['middlename']);
    $surname = ucwords($_POST['surname']);
    $sessionid = $_POST['sessionid'];
    $positionid = $_POST['positionid'];
    $relpath = null;

    /**
     * Hanlde uploaded photo
     */
    if (array_key_exists('photo', $_FILES) && !empty($_FILES['photo']['name'])) {
        $targetDir = "/img/candidates/";
        $fileName = $_FILES["photo"]["name"];
        $photo_upload = $fileName;  //to display in input tag
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $enc_file_name = md5($fileName) . '.' . $fileType;
        $targetFilePath = $_SERVER['DOCUMENT_ROOT'] . $targetDir . $enc_file_name;

        $allowTypes = array('jpg', 'jpeg', 'png', 'webp');
        $error = 0;
        if (empty($_FILES["photo"]["name"]) || ($_FILES['photo']['size'] < 1)) {
            //$message = "Please upload valid passport";
            $photoErr = "Upload valid photo";
            $error = 1;
        }

        if (!in_array($fileType, $allowTypes)) {
            //$message = "Wrong file extension for passport. Make sure the file you upload is jpeg or png";
            $photoErr = "Only jpeg or png is allowed";
            $error = 1;
        }

        if ($_FILES['photo']['size'] > 300 * 1024) {
            //$message = "File upload for pasport is too large";
            $photoErr = "File too large";
            $error = 1;
        }

        if ($error) {
            return;
        }
        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath);
        $relpath = $targetDir . $enc_file_name;
    }
    /////////////End handling photo ///////////////

    if (is_null($relpath)) {
        $sql = "UPDATE `tblcandidates` SET `firstname`=?,`middlename`=?,`surname`=?,`sessionid`=?,`positionid`=? WHERE candidateid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiii", $firstname, $middlename, $surname, $sessionid, $positionid, $_POST['candidateid']);
    } else {
        $sql = "UPDATE `tblcandidates` SET `firstname`=?,`middlename`=?,`surname`=?,`sessionid`=?,`positionid`=?,`picture`=? WHERE candidateid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiisi", $firstname, $middlename, $surname, $sessionid, $positionid, $relpath, $_POST['candidateid']);
    }
    $result = $stmt->execute();
    $redirect_url = 'index.php?sessionid=' . $sessionid;
    if ($result === TRUE) {
        redirect_to($redirect_url . "&report=1&type=Updated");
    } else {
        redirect_to($redirect_url . "&report=0&type=Updated");
    }
}
//redirect_to("admin-user-report.php?report=2");
