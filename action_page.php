<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php
if(isset($_POST['applyloan'])){
	include_once("client/apply_loan.php");
}
?>
<?php
if(isset($_POST['applydeposit'])){
	include_once("client/apply_deposit.php");
}
?>
<?php
if(isset($_POST['create_admin'])){
	include_once("admin/insert-admin.php");
}
?>
<?php 
$stmt->close();
$conn->close(); 
?>