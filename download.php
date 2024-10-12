<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php
// Make sure an ID was passed
if(isset($_GET['id'])) {
// Get the ID
    $id = intval($_GET['id']);
 
    // Make sure the ID is in fact a valid ID
    if($id <= 0) {
        die('The ID is invalid!');
    }
    else {
        // Connect to the database
        }
 
        // Fetch the file information
        $query = "
            SELECT `DocumentType`, `Document`, `DocumentName`, `DocumentDate`
            FROM `tbldocuments`
            WHERE `Transaction number` = {$id}";
        $result = $conn->query($query);
 
        if($result) {
            // Make sure the result is valid
            if($result->num_rows == 1) {
            // Get the row
                $row = mysqli_fetch_assoc($result);
 
                // Print headers
                header("Content-Type: ". $row['DocumentType']);
                //header("Content-Length: ". $row['size']);
                header("Content-Disposition: attachment; filename=". $row['DocumentName']);
 
                // Print data
                echo $row['Document'];
            }
            else {
                echo 'Error! No image exists with that ID.';
            }
 
            // Free the mysqli resources
            @mysqli_free_result($result);
        }
        else {
            echo "Error! Query failed: <pre>{$conn->error}</pre>";
        }
        
    }

else {
    echo 'Error! No ID was passed.';
}
?>
<?php $conn->close(); ?>

