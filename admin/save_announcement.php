<?php
	$user_id = $_SESSION['user_id'];
	$annc_date = $_POST['annc_date'];
	$annc_title = ucwords($_POST['annc_title']);
	$annc_body = $_POST['annc_body'];
	$annc_recipient = $_POST['annc_recipient'];
	$saved = Y_CONST;
	$closed = N_CONST;
	$date_time = date('Y-m-d H:i:s');
	$sql = "INSERT INTO `tblannouncements` (`AnnouncementID`, `AnnouncementDate`, `AnnouncementTitle`, `AnnouncementBody`, `Recipient`, `Saved`, `Closed`, `User ID`, `User datetime`, `upsize_ts`) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssdss",$annc_id,$annc_date,$annc_title,$annc_body,$annc_recipient,$saved,$closed,$user_id,$date_time,$empty);
    $result = $stmt->execute();
if ($result === TRUE) {
    //echo "New record created successfully";
    redirect_to("admin-announcements.php?insert=success&announcement=created");
} else {
    redirect_to("admin-announcements.php?insert=error");
}
?>