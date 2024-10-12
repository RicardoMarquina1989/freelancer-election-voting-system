<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php //require_once("includes/functions.php");?>
<?php
$empl_email= trim($_POST['empl_email']);
      $empl_code= trim($_POST['empl_code']);
      $empl_pass1= trim($_POST['empl_pass1']);
      $empl_pass2 = trim($_POST['empl_pass2']);
      $active = "A";
      if($empl_pass1 != $empl_pass2){
        redirect_to("client-activate-request.php?mismatch=1");
    }else{
              //$hash_pass = md5(empl_pass1);
    }
$stmt1 = $conn->prepare("SELECT `First name`, `Surname`, `Activated` FROM tblemployees WHERE `EmailAddress` = ? AND `Employee code` = ? LIMIT 1");
$stmt1->bind_param('ss', $empl_email, $empl_code);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_object();
if($row->Activated == "A"){
  redirect_to("client-activate-success.php?activated=1");
}
if($result->num_rows > 0){
    $stmt = $conn->prepare("UPDATE tblemployees SET `Login password` = ?, `Activated` = ? WHERE `EmailAddress` = ? AND `Employee code` = ? LIMIT 1");
        $stmt->bind_param('ssss', $empl_pass1, $active, $empl_email, $empl_code);
        $stmt->execute();
        redirect_to("client-activate-success.php?employee=1");
}
        else{
            
          redirect_to("client-activate-success.php?employee=0");
        }

$stmt->close();
$conn->close();
?>