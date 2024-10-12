<?php
$subject = ucwords(test_input($_POST['loan_subject']));
$email_address = test_input($_POST['client_email']);
$loan_type = test_input($_POST['loan_type']);
$loan_amount = test_input($_POST['loan_amount']);
$loan_startdate = $_POST['loan_startdate'];
$loan_monthlydeduction = test_input($_POST['loan_monthlydeduction']);
$body = test_input($_POST['loan_body']);
$date_applied = $_POST['loan_dateapplied'];
$client_code = test_input($_POST['client_code']);
	if(!empty($_POST['client_code'])){
			$stl = "SELECT `Approved` FROM tblloansapplications WHERE `Client code` = ? ORDER BY `ApplicationID` DESC LIMIT 1 ";
                             $stmt = $conn->prepare($stl);
                                $stmt->bind_param("s",$client_code);
                                  $stmt->execute();
                                    $result4 = $stmt->get_result();
                                      $row4 = $result4->fetch_array(); 
                                      if($row4['Approved']=="N"){
                                      	redirect_to("client-loan.php?loanapply=applied");}
	$sql = "INSERT INTO `tblloansapplications` (`Client code`, `LoanType`, `LoanAmount`, `StartDate`, `MonthlyDeduction`, `Date applied`, `Subject`, `Body`) VALUES (?,?,?,?,?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ssssssss",$client_code,$loan_type,$loan_amount,$loan_startdate,$loan_monthlydeduction,$date_applied,$subject,$body);
    $result = $stmt->execute();
    if ($result === TRUE) {
    	$to = "$email_address";
			         $subject = "GROOMING (STAFF) COOPERATIVE";
			         $mail_message = "<h2>Dear ({$surname}), {$firstname}  </h2>";
			         $mail_message .= "<b>Thanks for applying.</b>";
               $mail_message .= " ";
			         $mail_message .= "<p>An Admin will review your loan application and send a formal email on the decision taken.</p>";          
			         $header = "From:noreply@gscms.org \r\n";
			         $header .= "MIME-Version: 1.0\r\n";
			         $header .= "Content-type: text/html\r\n";
			         $retval = mail ($to,$subject,$mail_message,$header);
			         $_SESSION['message'] = "Registration Successful. Please Check your email";
    redirect_to("client-loan.php?loanapply=success");
} else {
    redirect_to("client-loan.php?loanapply=error");
}
}else{
	redirect_to("client-apply-loan.php?admin=admin");
}
?>