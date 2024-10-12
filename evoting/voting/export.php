<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
if (empty($_GET['sessionid'])) {
  redirect_to('result.php?status=select_session');
}

require_once __DIR__ . '/../phpexcel8/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$filename = './template.xlsx';
$newfile = md5(time()) . '.xlsx';

if (!copy($filename, $newfile)) {
  exit('error');
}

$spreadsheet = IOFactory::load($newfile);

// Set document properties
$spreadsheet->getProperties()->setCreator('Daniel Isoje')
  ->setLastModifiedBy('Daniel Isoje')
  ->setTitle('Election Result')
  ->setSubject('Election Voting System Result')
  ->setDescription('Election voting detailed result.')
  ->setKeywords('election voting result office 2007 openxml php')
  ->setCategory('Election voting result');
// output data
$sql = "SELECT
v.id,
v.sessionid,
s.title,
v.voteddate,
v.clientid,
v.positionid,
p.position,
CONCAT(
  u.`First name`,
IF
  ( u.`Middle name`, CONCAT( ' ', u.`Middle name`), '' ),
CONCAT( ' ', u.Surname)) AS clientname,
v.candidateid,
CONCAT(
  c.firstname,
IF
  ( c.middlename, CONCAT( ' ', c.middlename ), '' ),
CONCAT( ' ', c.surname )) AS candidatename,
1 AS score 
FROM
tblvotingresult AS v
INNER JOIN tblsessions AS s ON v.sessionid = s.sessionid
INNER JOIN tblclientsregistrations AS u ON v.clientid = u.RegID
INNER JOIN tblcandidates AS c ON v.candidateid = c.candidateid
INNER JOIN tblpositions AS p ON v.positionid = p.positionid
WHERE v.sessionid=?
ORDER BY v.id;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['sessionid']);
$stmt->execute();
$result = $stmt->get_result();

$idx = 3;
$sheet = $spreadsheet->setActiveSheetIndex(0);
while ($row = $result->fetch_array()) {
  // Add some data
  $sheet
    ->setCellValue("A{$idx}", $row['id'])
    ->setCellValue("B{$idx}", $row['sessionid'])
    ->setCellValue("C{$idx}", $row['title'])
    ->setCellValue("D{$idx}", $row['voteddate'])
    ->setCellValue("E{$idx}", $row['clientid'])
    ->setCellValue("F{$idx}", $row['clientname'])
    ->setCellValue("G{$idx}", $row['positionid'])
    ->setCellValue("H{$idx}", $row['position'])
    ->setCellValue("I{$idx}", $row['candidateid'])
    ->setCellValue("J{$idx}", $row['candidatename'])
    ->setCellValue("K{$idx}", '1');
  $idx++;
}

// Miscellaneous glyphs, UTF-8

// Rename worksheet
// $spreadsheet->getActiveSheet()->setTitle('Simple');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
// $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="voting_result.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

@unlink($newfile);
exit;
