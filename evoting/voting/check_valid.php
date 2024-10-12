<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php
$sessionid = $_GET['sessionid'];
$clientid = $_SESSION['user_id'];
$today = date('Y-m-d');
$sql = "SELECT
votingdate,
starttime,
endtime,
`status`,
s.sessionid,
v.cnt 
FROM
tblsessions AS s
LEFT JOIN (
SELECT
    COUNT( id ) AS cnt,
    c.sessionid 
FROM
    tblvotingresult AS v
    INNER JOIN tblcandidates AS c ON v.candidateid = c.candidateid 
WHERE
    v.sessionid = ? 
    AND clientid = ? 
) AS v ON s.sessionid = v.sessionid 
WHERE
s.sessionid = ? 
AND `status` = 'open' 
AND votingdate = ?;";

$stmt = $conn->prepare($sql);
$today = date('Y-m-d');
$stmt->bind_param('iiis', $sessionid, $clientid, $sessionid, $today);
$stmt->execute();
$result = $stmt->get_result();
if (!$result->num_rows) {
    redirect_to('index.php?status=no');
}

$row = $result->fetch_assoc();
if ($row['cnt'] > 0) {
    redirect_to('index.php?status=already');
}
$curtime = date('H:i:s');
if ($row['starttime'] > $curtime || $row['endtime'] < $curtime) {
    redirect_to('index.php?status=time');
}

redirect_to("step.php?sessionid={$sessionid}&step=0");
