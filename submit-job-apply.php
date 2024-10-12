<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php
$vacancy_id = $_GET['vacancyid'];
$candidate_id = $_GET['candid'];
$user_id = $_GET['userid'];
$date_apply = date('Y-m-d H:i:s');
$n = ACT_N;
$y = ACT_Y;
$sql = "SELECT `ApplicationID` FROM tblvacanciesapplications WHERE `CandidateID` = ? AND `VacancyID` = ? LIMIT 1";
$stmt=$conn->prepare($sql);
$stmt->bind_param("ss", $candidate_id, $vacancy_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
while($row = $result->fetch_array()){
 redirect_to('candidate-vacancy.php?vacancy=applied');
}
}
$sql = "INSERT INTO `tblvacanciesapplications` (`ApplicationID`,`CandidateID`, `VacancyID`, `DateApplied`, `Saved`, `Closed`, `User ID`, `User datetime`, `upsize_ts`) VALUES (?,?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iissssdss",$empty,$candidate_id,$vacancy_id,$date_apply,$y,$n,$user_id,$date_apply,$empty);
$result = $stmt->execute();
if ($result === TRUE) {
    redirect_to('candidate-vacancy.php?vacancy=successful');
} else {
    redirect_to('candidate-vacancy.php?vacancy=failed');
}
//redirect_to('candidate-vacancy.php?vacancy=1');

$stmt->close();
$conn->close();
?>