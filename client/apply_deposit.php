<?php
$application_type = "";
$client_code = test_input($_POST['client_code']);
$email_address = test_input($_POST['client_email']);
$old_deduction = test_input($_POST['old_deduction']);
$new_deduction = test_input($_POST['new_deduction']);
$withdrawal_amount = test_input($_POST['withdrawal_amount']);
$date_applied = $_POST['date_applied'];
$start_date = $_POST['start_date'];
$deposit_subject = ucwords(test_input($_POST['deposit_subject']));
$deposit_body = test_input($_POST['deposit_body']);
if($_POST['application_type'] == "cs")
{
$application_type = "Change in Savings";
}
if($_POST['application_type'] == "sw")
{
$application_type = "Savings Withdrawal";
}
	if(!empty($_POST['client_code'])){
		$stl = "SELECT `Approved` FROM tbldepositsapplications WHERE `Client code` = ? ORDER BY `ApplicationID` DESC LIMIT 1 ";
                             $stmt = $conn->prepare($stl);
                                $stmt->bind_param("s",$client_code);
                                  $stmt->execute();
                                    $result4 = $stmt->get_result();
                                      $row4 = $result4->fetch_array(); 
                                      if($row4['Approved']=="N"){
                                      	redirect_to("client-deposit.php?depositapply=applied");}
	$sql = "INSERT INTO `tbldepositsapplications` (`Client code`,`ApplicationType`, `OldDeduction`, `NewDeduction`,`StartDate`, `Withdrawal amount`, `Date applied`, `Subject`, `Body`) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ssddsdsss",$client_code,$application_type,$old_deduction,$new_deduction,$start_date,$withdrawal_amount,$date_applied,$deposit_subject,$deposit_body);
    $result = $stmt->execute();
    if ($result === TRUE) {
    				$to = "$email_address";
			         $subject = "GROOMING (STAFF) COOPERATIVE";
			         $mail_message = "<h2>Dear ({$surname}), {$firstname}  </h2>";
			         $mail_message .= "<b>Thanks for applying.</b>";
               $mail_message .= " ";
			         $mail_message .= "<p>An Admin will review your deposit application and send a formal email on the decision taken.</p>";          
			         $header = "From:noreply@gscms.org \r\n";
			         $header .= "MIME-Version: 1.0\r\n";
			         $header .= "Content-type: text/html\r\n";
			         $retval = mail ($to,$subject,$mail_message,$header);
			         $_SESSION['message'] = "Registration Successful. Please Check your email";
    redirect_to("client-deposit.php?depositapply=success");
} else {
    redirect_to("client-deposit.php?depositapply=error");
}
}else{
	redirect_to("client-apply-deposit.php?admin=admin");
}
?>