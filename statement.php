<?php require_once("includes/constants.php");?>
<?php require_once("includes/functions.php");?>
<?php if(isset($_POST['update_statement']) && !empty($_POST['app_id'])){
  $app_id = test_input($_POST['app_id']);
  $state_result = "";
  $state_result .= $app_id;
  $sent= ACT_Y;
  $remark = test_input($_POST['remark']);
  $admin_id = test_input($_POST['admin_id']);
  $date_sent = date('Y-m-d H:i:s');
  $state_result .= $remark;
  $state_result .= $admin_id;


 // $sql = "UPDATE tbldepositsstatementsapply SET `Date sent` = ?, `Sent` = ?, `Remark` = ?, `Sent by User ID` =? WHERE `ApplicationID` = ? LIMIT 1";
 // $stmt = $conn->prepare($sql);
 // $stmt->bind_param("sssii",$date_sent,$sent,$remark,$admin_id,$app_id);
 // $result = $stmt->execute();
 // if($result === TRUE){
 //   $message = "Successful";
 // }else{
 //   $message = "Not Successful";
 // }
  }  if(!empty($state_result)){
    echo $state_result;
  }
   ?>