<?php
$manager_code = $_POST['admin_id'];
$subject = ucwords($_POST['loan_subject']);
$loan_type = ucwords($_POST['loan_type']);
$loan_amount = $_POST['loan_amount'];
$loan_startdate = $_POST['loan_startdate'];
$loan_monthlydeduction = $_POST['loan_monthlydeduction'];
$body = $_POST['loan_body'];
$date_time = date('Y-m-d H:i:s');
$n = ACT_N;
$y = ACT_Y;
$employee_code = $_SESSION['ecode'];
$user_id = $_SESSION['user_id'];
	if(!empty($_POST['admin_id'])){
	$sql = "INSERT INTO `tblloansapplications` (`ApplicationID`, `Employee code`, `Manager code`, `LoanType`, `LoanAmount`, `StartDate`, `MonthlyDeduction`, `Date`, `Subject`, `Body`, `Approved`, `Remark`, `Saved`, `Saved2`, `Closed`, `User ID`, `User datetime`, `upsize_ts`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("issssssssssssssdss",$empty,$employee_code,$manager_code,$loan_type,$loan_amount,$loan_startdate,$loan_monthlydeduction,$date_time,$subject,$body,$n,$remark,$y,$y,$n,$user_id,$date_time,$empty);
    $result = $stmt->execute();
    if ($result === TRUE) {
    redirect_to("employee-loan.php?loanapply=success");
} else {
    redirect_to("employee-loan.php?loanapply=error");
}
}else{
	redirect_to("employee-apply-loan.php?admin=admin");
}
?>