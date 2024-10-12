<?php
$message = "";
$recaptcha = $surname = $firstname = $middlename = $mobile_phone = $email_address = $residential_address = $nok = $nok_address = $nok_relationship = $nok_phone = $monthly_savings = $application_type = $staff_number = $branch = $acceptance_policy = $reg_paid = $date_applied = $pass1 = $pass2 = $targetDir = $targetDir2 = $fileName = $fileName2 = $new_photoname = $new_receiptname = $targetFilePath = $targetFilePath2 = $fileType = $allowTypes = $fileType2 = $allowTypes2 = "";
$surnameErr = $firstnameErr = $middlenameErr = $staff_numberErr = $residential_addressErr = $branchErr = $mobile_phoneErr = $nokErr = $nok_addressErr = $nok_relationshipErr = $application_typeErr = $reg_paidErr = $receiptErr = $photoErr = $nok_phoneErr = $monthly_savingsErr = $pass1Err = $pass2Err = $email_addressErr = $captchaErr = "";
$error = "";
if (isset($_POST['register']) && ($_SERVER["REQUEST_METHOD"] == "POST")) {
	$recaptcha = $_POST['g-recaptcha-response'];
	$res = reCaptcha($recaptcha);
	$surname = ucfirst(strtolower(test_input($_POST['surname'])));
	$firstname = ucfirst(strtolower(test_input($_POST['firstname'])));
	$middlename = ucfirst(strtolower(test_input($_POST['middlename'])));
	$mobile_phone = test_input($_POST['mobile_phone']);
	$email_address = strtolower(test_input($_POST['email_address']));
	$residential_address = ucwords(strtolower(test_input($_POST['residential_address'])));
	$nok = ucwords(strtolower(test_input($_POST['nok'])));
	$nok_address = ucwords(strtolower(test_input($_POST['nok_address'])));
	$nok_relationship = ucwords(strtolower(test_input($_POST['nok_relationship'])));
	$nok_phone = test_input($_POST['nok_phone']);
	$monthly_savings = test_input($_POST['monthly_savings']);
	$application_type = ucwords(test_input($_POST['application_type']));
	$staff_number = strtoupper(test_input($_POST['staff_number']));
	$branch = ucwords(strtolower(test_input($_POST['branch'])));
	$acceptance_policy = 1;
	$reg_paid = test_input($_POST['reg_paid']);
	$date_applied = date('Y-m-d H:i:s');
	$pass1 = test_input($_POST['pass1']);
	$pass2 = test_input($_POST['pass2']);
	$uppercase = preg_match('@[A-Z]@', $pass1);
	$lowercase = preg_match('@[a-z]@', $pass1);
	$number = preg_match('@[0-9]@', $pass1);
	$specialChars = preg_match('@[^\w]@', $pass1);
	$hash = md5(rand(0, 1000));
	if ($_POST['application_type'] == "Data Update") {
		$targetDir = "";
		$targetDir2 = "";
		$new_photoname = "";
		$new_receiptname = "";
	}
	$sql1 = "SELECT `Email address` FROM tblclientsregistrations WHERE `Email address` = ?";
	$stmt = $conn->prepare($sql1);
	$stmt->bind_param("s", $email_address);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		//$message = "User with this email already exist";
		$email_addressErr = "User exist";
		$error = 1;
	}
	if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass1) < 8) {
		//$message = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
		$pass1Err = "Enter strong password";
		$error = 1;
		//return;
	}
	if (($pass1) != ($pass2)) {
		//$message = "Password mismatch. Please enter your password correctly to match each other";
		$pass1Err = "Password mismatch";
		$error = 1;
	}
	if (!$res['success']) {
		$captchaErr = "Google reCAPTCHA verification failed, please Check reCAPTCHA.";
		$error = 1;
	}
	if (empty($nok)) {
		$nokErr = "Required";
		$error = 1;
	}
	if (empty($nok_phone)) {
		$nok_phoneErr = "Required";
		$error = 1;
	}
	if (empty($mobile_phone)) {
		$mobile_phoneErr = "Required";
		$error = 1;
	}
	if (empty($surname)) {
		$surnameErr = "Required";
		$error = 1;
	}
	if (!preg_match("/^[a-zA-Z-' ]*$/", $surname)) {
		$surnameErr = "Letters only";
		$error = 1;
	}
	if (empty($firstname)) {
		$firstnameErr = "Required";
		$error = 1;
	}
	if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
		$firstnameErr = "Letters only";
		$error = 1;
	}
	if (empty($email_address)) {
		$email_addressErr = "Required";
		$error = 1;
	}
	if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
		//$message = "Invalid email address. Please type in a valid email address";
		$email_addressErr = "Invalid email";
		$error = 1;
	}
	if (($_POST['application_type'] == "New Registration") || ($_POST['application_type'] == "Rejoining")) {
		$targetDir = "img/clients/";
		$targetDir2 = "img/payments/";
		$fileName = $_FILES["photo"]["name"];
		$fileName2 = $_FILES["receipt"]["name"];
		$new_photoname = file_newname($targetDir, $fileName);
		$new_receiptname = file_newname($targetDir2, $fileName2);
		$targetFilePath = $targetDir . $new_photoname;
		$targetFilePath2 = $targetDir2 . $new_receiptname;
		$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
		$allowTypes = array('jpg', 'jpeg', 'png');
		$fileType2 = pathinfo($targetFilePath2, PATHINFO_EXTENSION);
		$allowTypes2 = array('jpg', 'jpeg', 'pdf');
		if (empty($_FILES["photo"]["name"]) || ($_FILES['photo']['size'] < 1)) {
			//$message = "Please upload valid passport";
			$photoErr = "Upload valid passport";
			$error = 1;
		}
		if (empty($_FILES["receipt"]["name"]) || ($_FILES['receipt']['size'] < 1)) {
			//$message = "Please upload valid receipt";
			$receiptErr = "Upload valid receipt";
			$error = 1;
		}
		if (!in_array($fileType, $allowTypes)) {
			//$message = "Wrong file extension for passport. Make sure the file you upload is jpeg or png";
			$photoErr = "Only jpeg or png is allowed";
			$error = 1;
		}
		if (!in_array($fileType2, $allowTypes2)) {
			//$message = "Wrong file extension for payment evidence. Make sure the file you upload is jpeg or pdf";
			$receiptErr = "Only jpeg or pdf is allowed";
			$error = 1;
		}
		if ($_FILES['photo']['size'] > 75000) {
			//$message = "File upload for pasport is too large";
			$photoErr = "File too large";
			$error = 1;
		}
		if ($_FILES['receipt']['size'] > 250000) {
			//$message = "File upload payment evidence is too large";
			$receiptErr = "File too large";
			$error = 1;
		}
	}
	if ($error == 1) {
		$message = "Sorry, some of your inputs need attention.";
	} else {
		$login_password = md5($pass1);
		move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath);
		$photograph = ("$targetDir" . $new_photoname);
		move_uploaded_file($_FILES["receipt"]["tmp_name"], $targetFilePath2);
		$regfee_evidence = ("$targetDir2" . $new_receiptname);
		$sql = "INSERT INTO `tblclientsregistrations` (`First name`, `Middle name`, `Surname`,`Staff Number`, `Date applied`, `Email address`, `Phone number`, `Residential address`, `Branch`, `Photograph`, `Next of kin`, `Next of kin relationship`, `Next of kin address`, `Next of kin phone number`, `Montly savings`, `Registration type`, `Registration fee paid`, `Registration fee evidence`, `Policy acceptance`, `Password`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ssssssssssssssdsdsis", $firstname, $middlename, $surname, $staff_number, $date_applied, $email_address, $mobile_phone, $residential_address, $branch, $photograph, $nok, $nok_relationship, $nok_address, $nok_phone, $monthly_savings, $application_type, $reg_paid, $regfee_evidence, $acceptance_policy, $login_password);
		$result = $stmt->execute();
		if ($result === TRUE) {
			$to = "$email_address";
			$subject = "GROOMING (STAFF) COOPERATIVE";
			$mail_message = "<h2>Dear {$firstname}  </h2>";
			$mail_message .= "<b>Thanks for registering.</b>";
			$mail_message .= "<p> An Admin will review your registration details and send a formal email upon activation of your profile.</p>";
			$header = "From:noreply@gscms.org \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";
			$retval = mail($to, $subject, $mail_message, $header);
			redirect_to("client-register-success.php?success=ok");
		} else {
			if (!empty($photograph)) {
				unlink($photograph);
			}
			if (!empty($regfee_evidence)) {
				unlink($regfee_evidence);
			}
			//$message = "Sorry, submission failed! Please, make sure your inputs are correct. If error persists, clear your browsing data and try again or use another browser.";
			redirect_to("error.php?success=no");
		}
	}
}
