<?php require_once("includes/session.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php require_once("includes/connections.php"); ?>
<?php //require_once("includes/functions.php");
?>
<?php
$surname = trim($_POST['surname']);
$firstname = trim($_POST['firstname']);
$middlename = trim($_POST['middlename']);
$candidate_phone = trim($_POST['candidate_phone']);
$candidate_email = trim($_POST['candidate_email']);
$candidate_password = trim($_POST['candidate_password']);
$hash_password = sha1($candidate_password);

$sql = "INSERT INTO `candidate_register` (`id`, `surname`, `firstname`, `middlename`, `gender`, `marital_status`, `address1`, `country`, `state`, `city`, `lga`, `birthdate`, `candidate_phone`, `usermail`, `hash_password`, reg_datetime) VALUES (NULL, '$surname', '$firstname', '$middlename', '$gender', '$marital_status', '$address1', '$country', '$state', '$city', '$lga', '$birthdate', '$candidate_phone', '$candidate_email', '$hash_password', NOW())";
if ($conn->query($sql) === TRUE) {
    redirect_to("candidate-register-success.php");
} else {
    echo "New candidate register failed. kindly contact the admin";
}

$conn->close();
?>