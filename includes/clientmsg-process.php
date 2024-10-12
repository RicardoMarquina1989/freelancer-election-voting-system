<?php
$msg_subject = $msg_body = $targetDir = $fileName  = $new_attachmentname = $targetFilePath = $fileType = $allowTypes = $attachment = $message = "";
$msg_subjectErr = $msg_bodyErr = $error = $attachmentErr = "";
if(isset($_POST['client_submit_msg'])){
$client_code = test_input($_POST['client_code']);
$client_email = test_input($_POST['client_email']);
$msg_subject = ucwords(strtolower(test_input($_POST['msg_subject'])));
$msg_body = test_input($_POST['msg_body']);
$date_sent = date('Y-m-d H:i:s');
 		if(empty($msg_subject))
      		{
      			$msg_subjectErr = "Required";
      			$error = 1;
      		}
      	if(empty($msg_body))
      		{
      			$msg_bodyErr = "Required";
      			$error = 1;
      		}
		if(empty($_FILES["attachment"]["name"]) || ($_FILES['attachment']['size'] < 1))
			{
					//$message = "Please upload valid passport";
					//$attachmentErr = "Please attach a valid file.";
					//$error = 1;
				$msg_attachment = "";
			}
		if(!empty($_FILES["attachment"]["name"]) || ($_FILES['attachment']['size'] > 1))
		{
			$targetDir = "img/attachments/";
			$fileName = $_FILES["attachment"]["name"];
			$new_attachmentname = file_newname($targetDir, $fileName);
			$targetFilePath = $targetDir . $new_attachmentname;
			$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
			$allowTypes = array('jpg','jpeg','pdf');
			if(!in_array($fileType, $allowTypes))
			{
					//$message = "Wrong file extension for passport. Make sure the file you upload is jpeg or png";
					$attachmentErr = "Only jpeg or pdf is allowed";
					$error = 1;
			}
		if($_FILES['attachment']['size'] > 250000)
			{
					//$message = "File upload for pasport is too large";
					$attachmentErr = "Attached file too large";
					$error = 1;
			}
		}
		if($error == 1)
		{
			$message = "Message not sent. See error(s) below.";
		}
		else
		{
			 move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFilePath);
			 	$msg_attachment =("$targetDir" . $new_attachmentname);
								$sql = "INSERT INTO `tblclientsmessages` (`Client code`, `MessageSubject`, `MessageBody`, `Attachment`, `Date sent`) VALUES (?,?,?,?,?)";
								$stmt = $conn->prepare($sql);
									$stmt->bind_param("sssss",$client_code,$msg_subject,$msg_body,$msg_attachment,$date_sent);
											$result = $stmt->execute();
			if($result===TRUE)
				{
				$to = "$client_email";
			         $subject = "GROOMING (STAFF) COOPERATIVE";
			         $mail_message = "<b> Your submission with the following message was successful: </b><br><br>";
			         $mail_message .= "<b>Subject: </b><br>" . $msg_subject . "<br><br>";
			         $mail_message .= "<b>Message: </b><br>" . $msg_body . "<br><br>";			                  
			         $header = "From:noreply@gscms.org \r\n";
			         $header .= "MIME-Version: 1.0\r\n";
			         $header .= "Content-type: text/html\r\n";
			         $retval = mail ($to,$subject,$mail_message,$header);
				redirect_to("client-send-message.php?msg=ok");
				}
				else
				{
					if(!empty($msg_attachment)){unlink($msg_attachment);}
					$message = "Message not sent. Please try again later.";
					//redirect_to("error.php?success=no");
				}
		}
}
?>