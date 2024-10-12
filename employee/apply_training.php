<?php
$trainingmanager_code = $_POST['trainingadmin_id'];
$training_code = $_POST['training_code'];
$training_subject = ucwords($_POST['training_subject']);
$training_body = $_POST['training_body'];
$trainingemployee_code = $_SESSION['ecode'];
$date_time = date('Y-m-d H:i:s');
$n = ACT_N;
$y = ACT_Y;
$user_id = $_SESSION['user_id'];
	if(!empty($_POST['trainingadmin_id'])){
	$sql = "INSERT INTO `tbltrainingsapplications` (`ApplicationID`, `Employee code`, `Manager code`, `Date`, `TrainingCode`, `Subject`, `Body`, `Approved`, `Remark`, `Saved`, `Saved2`, `Closed`, `User ID`, `User datetime`, `upsize_ts`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("isssssssssssdss",$application_id,$trainingemployee_code,$trainingmanager_code,$date_time,$training_code,$training_subject,$training_body,$n,$remark,$y,$y,$n,$user_id,$date_time,$upsize_ts);
    $result = $stmt->execute();
    if ($result === TRUE) {
    redirect_to("employee-training.php?trainingapply=success");
} else {
    redirect_to("employee-training.php?trainingapply=error");
}
}else{
	redirect_to("employee-apply-training.php?admin=admin");
}
?>
