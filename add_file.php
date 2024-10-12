<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php
// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        // Connect to the database
       
        }
 
        // Gather all required data
        $document_date = $conn->real_escape_string($_POST['document_date']);
        $doc_name = $conn->real_escape_string($_FILES['uploaded_file']['name']);
        //$fileName = basename($document_namepath);
       // $document_name = preg_replace("/\.[^.]+$/", "", $fileName);
        $document_type = $conn->real_escape_string($_FILES['uploaded_file']['type']);
        $document_ext = substr(strrchr($document_type, "/"), 1);
        $document = $conn->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
        $date_time = date('Y-m-d H:i:s');
        $user_id = $_SESSION['user_id'];
        $document_name = $_POST['document_name'];
        $y = Y_CONST;
 
        // Create the SQL query
    //$sql = "INSERT INTO tbldocuments (DocumentDate, Active, DocumentName, Document, Saved, `User ID`, upsize_ts) VALUES("sssssis", ???????)";
//$sql = "INSERT INTO tbldocuments (`Transaction number`, DocumentDate, Active, DocumentName, Document, DocumentType, Saved, `User ID`, `User datetime`, upsize_ts) VALUES(NULL, '$document_date', 'Y', '$name', '$data', '$document_type', 'Y', '$user_id', '$date_time', NULL)";
$sql = "INSERT INTO `tbldocuments` (`Transaction number`, `DocumentDate`, `Active`, `DocumentName`, `Document`, `DocumentType`, `Saved`, `User ID`, `User datetime`, `upsize_ts`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        // Execute the query
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssdss",$transaction_number, $document_date, $y, $document_name, $document, $document_ext, $y, $user_id, $date_time, $upsize_ts);
$result = $stmt->execute();
        // Check if it was successfull
        if($result) {
            redirect_to("admin-documents-list.php?insert=success");
        }
        else {
            redirect_to("admin-documents-list.php?insert=error");
          
        }
    }
    else {
       redirect_to("admin-documents.php");
        
    }

$conn->close();
?>

