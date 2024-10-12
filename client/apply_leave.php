<?php
$leavemanager_code = $_POST['leaveadmin_id'];
$leave_subject = ucwords($_POST['leave_subject']);
$leave_body = $_POST['leave_body'];
$leaveemployee_code = $_SESSION['ecode'];
$leave_type = ucwords($_POST['leave_type']);
$leave_year = $_POST['leave_year'];
$leave_beginingdate = $_POST['leave_beginingdate'];
$leave_duration = $_POST['leave_duration'];
$date_time = date('Y-m-d H:i:s');
$n = ACT_N;
$y = ACT_Y;
$user_id = $_SESSION['user_id'];
	if(!empty($_POST['leaveadmin_id'])){
	$sql = "INSERT INTO `tblleavesapplications` (`ApplicationID`, `Employee code`, `Manager code`, `Date`, `Subject`, `Body`, `LeaveType`, `LeaveYear`, `BeginingDate`, `Duration`, `Approved`, `Remark`, `Saved`, `Saved2`, `Closed`, `User ID`, `User datetime`, `upsize_ts`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("issssssssssssssdss",$empty,$leaveemployee_code,$leavemanager_code,$date_time,$leave_subject,$leave_body,$leave_type,$leave_year,$leave_beginingdate,$leave_duration,$n,$remark,$y,$y,$n,$user_id,$date_time,$empty);
    $result = $stmt->execute();
    if ($result === TRUE) {
    redirect_to("employee-leave.php?leaveapply=success");
} else {
    redirect_to("employee-leave.php?leaveapply=error");
}
}else{
	redirect_to("employee-apply-leave.php?admin=admin");
}
?>