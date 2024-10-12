<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
		$email_address = $conn->escape_string($_GET['email']);
		$hash = $conn->escape_string($_GET['hash']);
		$active_y = ACT_Y;
		$active_n = ACT_N;
		$sql = "SELECT `First name` FROM tblcandidates WHERE `EmailAddress` =? AND `hash`=? AND `Active` =?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sss",$email_address,$hash,$active_n);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows == 0)
		{
			$_SESSION['message'] = "Account has already been activated or the url is invalid";
			redirect_to("error.php");
		}
		else
		{
			
			$sqlupdate = "UPDATE tblcandidates SET `Active` = ? WHERE `EmailAddress` = ? LIMIT 1";
			$stmt = $conn->prepare($sqlupdate);
			$stmt->bind_param("ss",$active_y,$email_address);
			$stmt->execute();
			$result2 = $stmt->get_result();
			$_SESSION['message'] = "Your account has been activated";
			redirect_to("candidate-register-success.php");
			if(empty($result2))
			{
				$_SESSION['message'] = "OPS! Verification not successful";
				redirect_to("error.php");
			}
		}
}
else
{
	$_SESSION['message'] = "Invalid parameters provided for account verification";
	redirect_to("error.php");
}
?>
<?php if(isset($stmt)){
	$stmt->close();}
 ?>
<?php $conn->close(); ?>