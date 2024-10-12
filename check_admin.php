<?php require_once("includes/session.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php require_once("includes/connections.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_GET['id']) && (!empty($_GET['id']))) {
	$check_id = intval($_GET['id']);
	$sql = "SELECT `Type` FROM tblaccess WHERE `User ID` = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $check_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($row['Type'] == "M") {
		redirect_to("admin-createadmin.php?type=1");
	} else {
		redirect_to("admin-user-report.php?type=2");
	}
}
if (isset($_GET['check_type']) && (!empty($_GET['check_type']))) {
	$check_id = intval($_GET['check_type']);
	$sql = "SELECT `Type` FROM tblaccess WHERE `User ID` = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $check_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($row['Type'] == "M") {
		redirect_to("admin-users.php?type=1");
	} else {
		redirect_to("admin-user-report.php?type=2");
	}
}

if (isset($_GET['pca']) && (!empty($_GET['pca']))) {
	$pca = intval($_GET['pca']);
	$sql = "SELECT `ClientsActivations` FROM tblaccess WHERE `User ID` = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $pca);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($row['ClientsActivations'] == 1) {
		redirect_to("admin-client-activate.php");
	} else {
		redirect_to("admin-user-report.php?type=3");
	}
}
if (isset($_GET['pda']) && (!empty($_GET['pda']))) {
	$pda = intval($_GET['pda']);
	$sql = "SELECT `DepositsApprovals` FROM tblaccess WHERE `User ID` = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $pda);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($row['DepositsApprovals'] == 1) {
		redirect_to("admin-approve-deposit.php");
	} else {
		redirect_to("admin-user-report.php?type=3");
	}
}
if (isset($_GET['pla']) && (!empty($_GET['pla']))) {
	$pla = intval($_GET['pla']);
	$sql = "SELECT `LoansApprovals` FROM tblaccess WHERE `User ID` = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $pla);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($row['LoansApprovals'] == 1) {
		redirect_to("admin-approve-loan.php");
	} else {
		redirect_to("admin-user-report.php?type=3");
	}
}
/**
 * Here's content needed to merge
 * By Freelancer devking
 * */
// sessions
if (isset($_GET['sessions']) && (!empty($_GET['sessions']))) {
	$check_id = intval($_GET['sessions']);
	$sql = "SELECT `Type` FROM tblaccess WHERE `User ID` = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $check_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($row['Type'] == "M") {
		redirect_to("evoting/sessions/index.php?type=1");
	} else {
		redirect_to("evoting/sessions/index.php?type=2");
	}
}

// positions
if (isset($_GET['positions']) && (!empty($_GET['positions']))) {
	$check_id = intval($_GET['positions']);
	$sql = "SELECT `Type` FROM tblaccess WHERE `User ID` = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $check_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($row['Type'] == "M") {
		redirect_to("evoting/positions/index.php?type=1");
	} else {
		redirect_to("evoting/positions/index.php?type=2");
	}
}

// candidates
if (isset($_GET['candidates']) && (!empty($_GET['candidates']))) {
	$check_id = intval($_GET['candidates']);
	$sql = "SELECT `Type` FROM tblaccess WHERE `User ID` = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $check_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($row['Type'] == "M") {
		redirect_to("evoting/candidates/index.php?type=1");
	} else {
		redirect_to("evoting/candidates/index.php?type=2");
	}
}

// questions
if (isset($_GET['questions']) && (!empty($_GET['questions']))) {
	$check_id = intval($_GET['questions']);
	$sql = "SELECT `Type` FROM tblaccess WHERE `User ID` = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $check_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($row['Type'] == "M") {
		redirect_to("evoting/questions/index.php?type=1");
	} else {
		redirect_to("evoting/questions/index.php?type=2");
	}
}

// voting-results
if (isset($_GET['voting']) && (!empty($_GET['voting']))) {
	$check_id = intval($_GET['voting']);
	$sql = "SELECT `Type` FROM tblaccess WHERE `User ID` = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $check_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	if ($row['Type'] == "M") {
		redirect_to("evoting/voting/result.php?type=1");
	} else {
		redirect_to("evoting/voting/result.php?type=2");
	}
}

?>