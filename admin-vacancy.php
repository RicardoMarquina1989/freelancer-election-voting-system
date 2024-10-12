<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['del']) && (!empty($_GET['del']))) {
	$del = intval($_GET['del']);
	$sql = "DELETE FROM tblvacancies WHERE VacancyID = ?";
	$stmt= $conn->prepare($sql);
	$stmt->bind_param("i",$del);
	$result = $stmt->execute();
	if($result === TRUE){
		$message = "Deletion Successful";
	}else{
		$message = "Not Successful";
	}
}
?>
<?php if(isset($_GET['insert']) && ($_GET['insert']) == "success"){
	$message = "Successful";
}?>
<?php if(isset($_GET['insert']) && ($_GET['insert']) == "error"){
	$message = "Failed";
}?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/head.php"); ?>
 <body style="background-color:#f0f0f7; ">
<!-- Navigation -->
<?php include_once("includes/header_menu.php"); ?> 
	 <?php
	// admin dashboard left side here
	include('includes/admin_dashboard_leftside.php');
	 ?>
						<div class="col-md-9" id="right">
							<div class="spacebar"></div>
								<div class="breadcrumb1">
											<div class="bread-title">
															<h1>Vacancies Listing</h1>
											</div>
						</div>
						<div class="spacebar"></div>
 						<?php include("includes/message_alert.php"); ?>
							 <table class="table table-hover">
								 <tr class="thbg">
									<th>Company Code</th>
									<th>Vacancy Code</th>
									 <th>Title</th>
									 <th>Description</th>
									 <th>Announcement Date</th>
										<th >Closing Date</th>
										<th>Status</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
								 </tr>
									 <?php global $status;
									$sql = "SELECT * FROM tblvacancies ORDER BY `User datetime` DESC";
									$stmt = $conn->prepare($sql);
									$stmt->execute();
									$result = $stmt->get_result();
								 while($row = $result->fetch_array()){
										if($row['Saved'] == 'Y'){
											$status = "Saved";
										}
										if ($row['Saved'] == 'P') {
											# code...
											$status = "Published";
										}
										?>
									<tr>
									 <td><?php echo $row['Company code']; ?></td>
									 <td><?php echo $row['VacancyCategory code']; ?></td>
									 <td><?php echo $row['VacancyTitle']; ?></td>
									 <td><?php custom_echo($row['VacancyDescription'],30); ?></td>
									 <td><?php echo $date_announce=date('d-M-Y',strtotime($row['ExternalDateAnnounced'])); ?></td>
									 <td><?php echo $close_date=date('d-M-Y',strtotime($row['ExternalDateClosed'])); ?></td>
									 <td><?php echo $status; ?></td>
									 <td><a href="admin-updatevacancy.php?upv=<?php echo $row['VacancyID']; ?>" class="btn btn-success">Edit</a></td>
									 <td><a href="admin-vacancy.php?del=<?php echo $row['VacancyID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you really want to delete this vacancy');">Delete</a></td>
									</tr>
							<?php
							 } ?>								
							</table>		
						</div>	 
			 </div>
<?php include_once("includes/common_footer.php"); ?>