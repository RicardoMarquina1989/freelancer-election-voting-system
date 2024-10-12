<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php 
if(isset($_GET['id']) && (!empty($_GET['id']))) 
{
  				$check_id = intval($_GET['id']);
				 $sql = "SELECT `Type` FROM tblaccess WHERE `User ID` = ? LIMIT 1";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("i",$check_id);
					$stmt->execute();
					$result = $stmt->get_result();
					$row = $result->fetch_assoc();
					if($row['Type']=="M"){
				    redirect_to("admin-createadmin.php?type=1");
				}else{
					redirect_to("admin-user-report.php?type=2");
				}
}
?>