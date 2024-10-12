<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_GET['upv']) && (!empty($_GET['upv']))){$vid = intval($_GET['upv']);}?>
<?php if(isset($_POST['publishVacancy'])){
  $p = "P";
  $sql = "UPDATE `tblvacancies` SET `Saved` = ? WHERE `VacancyID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si",$p,$vid);
  $result = $stmt->execute();
  if($result===TRUE){redirect_to("admin-vacancy.php");
   }
  } ?>
  <?php if(isset($_POST['updateVacancy'])){
  $company_code = $_POST['company_code'];
  $vacancy_code = $_POST['vacancy_code'];
  $vacancy_title = $_POST['vacancy_title'];
  $vacancy_description = $_POST['vacancy_description'];
  $announced_date = $_POST['announced_date'];
  $closing_date = $_POST['closing_date'];
  $min_salary = $_POST['min_salary'];
  $max_salary = $_POST['max_salary'];
  $saved = Y_CONST;
  $closed = N_CONST;
  $date_time = date('Y-m-d H:i:s');
  $sql = "UPDATE `tblvacancies` SET `VacancyCategory code`=?, `VacancyTitle` = ?, `VacancyDescription` = ?, `InternalDateAnnounced` = ?, `InternalDateClosed` = ?, `ExternalDateAnnounced` = ?, `ExternalDateClosed` =?, `SalaryRangeLow`=?, `SalaryRangeHigh` = ?, `Company code`=?, `User datetime`=? WHERE `VacancyID` = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssssssssi",$vacancy_code,$vacancy_title,$vacancy_description,$announced_date,$closing_date,$announced_date,$closing_date,$min_salary,$max_salary,$company_code,$date_time,$vid);
  $result = $stmt->execute();
  if($result===TRUE){
    $message = "Update Successful";
  }
  } ?>
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
            <div class="col-md-6"><div class="spacebar"></div>
                     <div class=" panel panel-info">
                          <div class="panel-heading">
                              <div class="panel-tilte">
                                  Update Vacancy
                              </div>
                          </div>
                          <div class="panel-body">
                          <?php if(!empty($message)){
                                        echo "<div class=\"alert alert-info\">" . $message. "</div>";
                                      } ?>
                          <?php 
                          if(isset($_GET['upv']) && (!empty($_GET['upv']))){
                          $vid = intval($_GET['upv']);
                           }
                          $sql = "SELECT * FROM tblvacancies WHERE VacancyID = ? LIMIT 1";
                          $stmt =$conn->prepare($sql);
                          $stmt->bind_param("i",$vid);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          $row = $result->fetch_array();
                          if($row['Saved'] == "P"){
                          $read_only = "readonly";
                          $disable = "disabled";
                          }
                          ?>
                               <form action="admin-updatevacancy.php?upv=<?php echo $vid; ?>" method="post">
                                                       <div class="form-group">
                                                        <label for="companyCode">Company Code:</label>
                                                        <input type="text" name="company_code" class="form-control" id="" value="<?php echo $row['Company code'];?>" placeholder="Enter Company Code..." required="required" maxlength="10"  autofocus="autofocus" <?php if(!empty($read_only)){echo $read_only; }?> >
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="vacancyCategory">Vacancy Category Code:</label>
                                                        <input type="text" name="vacancy_code" class="form-control" id="" value="<?php echo $row['VacancyCategory code'];?>" placeholder="Enter Vacancy Category Code..." required="required" maxlength="10" <?php if(!empty($read_only)){echo $read_only; }?> >
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="vacancyTitle">Vacancy Title:</label>
                                                        <input type="text" name="vacancy_title" class="form-control" id="" value="<?php echo $row['VacancyTitle'];?>" placeholder="Enter Vacancy Title..." required="required" maxlength="100" <?php if(!empty($read_only)){echo $read_only; }?> >
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="vacancyDescription">Vacancy Description:</label>
                                                        <textarea class="form-control" name="vacancy_description" rows="15" id="comment" required="required" <?php if(!empty($read_only)){echo $read_only; }?> ><?php echo $row['VacancyDescription'];?></textarea>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="dateAnnounced">Announcement Date:</label>
                                                        <input type="text" name="announced_date" class="form-control" id="" value="<?php echo $row['InternalDateAnnounced']; ?>" placeholder="Enter Announcement Date..." required="required" <?php if(!empty($read_only)){echo $read_only; }?>>
                                                      
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="dateClosed">Closing Date:</label>
                                                        <input type="text" name="closing_date" class="form-control" id="" value="<?php echo $row['InternalDateClosed']; ?>" placeholder="Enter Closing Date..." required="required" <?php if(!empty($read_only)){echo $read_only; }?> >
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="minSalary">Minimum Salary:</label>
                                                        <input type="text" name="min_salary" class="form-control" id="" value="<?php echo $row['SalaryRangeLow'];?>" placeholder="Enter Minimum Salary..." required="required" <?php if(!empty($read_only)){echo $read_only; }?> >
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="maxSalary">Maximum Salary:</label>
                                                        <input type="text" name="max_salary" class="form-control" id="" value="<?php echo $row['SalaryRangeHigh'];?>" placeholder="Enter Maximum Salary..." required="required" <?php if(!empty($read_only)){echo $read_only; }?> >
                                                      </div>
                                                      <div class="spacebar"></div>
                                                      <input type="submit" name="updateVacancy" value="Save" class="btn btn-success" <?php if(!empty($disable)){echo $disable; }?> >
                                                      <input type="submit" name="publishVacancy" value="Publish" class="btn btn-info" onclick="return confirm('You wont be able to edit after you publish.')" style="float:right;" <?php if(!empty($disable)){echo $disable; }?> >
                                             </form>        
                          </div>
                     </div>
                
                
            </div>
            
           
       </div>
  <?php include_once("includes/footer.php"); ?>