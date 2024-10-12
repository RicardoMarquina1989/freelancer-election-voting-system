<?php
	$user_id = $_SESSION['user_id'];
	$company_code = $_POST['company_code'];
	$vacancy_code = $_POST['vacancy_code'];
	$vacancy_title = ucwords($_POST['vacancy_title']);
	$vacancy_description = $_POST['vacancy_description'];
	$announced_date = $_POST['announced_date'];
	$closing_date = $_POST['closing_date'];
	$min_salary = $_POST['min_salary'];
	$max_salary = $_POST['max_salary'];
	$vacancy_title = $_POST['vacancy_title'];
	$saved = Y_CONST;
	$closed = N_CONST;
	$date_time = date('Y-m-d H:i:s');
	if(!empty($_POST['referee'])){
		$referee = $_POST['referee'];
	}else{
		$referee = N_CONST;
	}
	if(!empty($_POST['guarantor'])){
		$guarantor = $_POST['guarantor'];
	}else{
		$guarantor = N_CONST;
	}
	if(!empty($_POST['application'])){
		$application = $_POST['application'];
	}else{
		$application = N_CONST;
	}
	$sql = "INSERT INTO `tblvacancies` (`VacancyID`, `VacancyCategory code`, `VacancyTitle`, `VacancyDescription`, `InternalDateAnnounced`, `InternalDateClosed`, `ExternalDateAnnounced`, `ExternalDateClosed`, `SalaryRangeLow`, `SalaryRangeHigh`, `ApplicationRequired`, `RefereesRequired`, `QuarantorsRequired`, `Company code`, `Saved`, `Closed`, `User ID`, `User datetime`, `upsize_ts`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("isssssssddssssssdss",$vacancy_id,$vacancy_code,$vacancy_title,$vacancy_description,$announced_date,$closing_date,$announced_date,$closing_date,$min_salary,$max_salary,$application,$referee,$guarantor,$company_code,$saved,$closed,$user_id,$date_time,$empty);
	$result = $stmt->execute();
if ($result === TRUE) {
    //echo "New record created successfully";
    redirect_to("admin-vacancy.php?insert=success");
} else {
    redirect_to("admin-vacancy.php?insert=error");
}
?>
