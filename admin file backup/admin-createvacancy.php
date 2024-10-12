<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
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
            <div class="col-md-7"><div class="spacebar"></div>
                     <div class=" panel panel-info">
                          <div class="panel-heading">
                              <div class="panel-tilte">
                                  Create Vacancy
                              </div>
                          </div>
                          <div class="panel-body">
                               <form action="action_page.php" method="post">
                                                       <div class="form-group">
                                                        <label for="companyCode">Company Code:</label>
                                                        <input type="text" name="company_code" class="form-control" id="" placeholder="Enter Company Code..." required="required" maxlength="10"  autofocus="autofocus">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="vacancyCategory">Vacancy Category Code:</label>
                                                        <input type="text" name="vacancy_code" class="form-control" id="" placeholder="Enter Vacancy Category Code..." required="required" maxlength="10">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="vacancyTitle">Vacancy Title:</label>
                                                        <input type="text" name="vacancy_title" class="form-control" id="" placeholder="Enter Vacancy Title..." required="required" maxlength="100">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="vacancyDescription">Vacancy Description:</label>
                                                        <textarea class="form-control" name="vacancy_description" rows="15" id="comment" required="required"></textarea>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="dateAnnounced">Announcement Date:</label>
                                                        <input type="date" name="announced_date" class="form-control" id="" placeholder="Enter Announcement Date..." required="required">
                                                      
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="dateClosed">Closing Date:</label>
                                                        <input type="date" name="closing_date" class="form-control" id="" placeholder="Enter Closing Date..." required="required">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="minSalary">Minimum Salary:</label>
                                                        <input type="text" name="min_salary" class="form-control" id="" placeholder="Enter Minimum Salary..." required="required">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="maxSalary">Maximum Salary:</label>
                                                        <input type="text" name="max_salary" class="form-control" id="" placeholder="Enter Maximum Salary..." required="required">
                                                      </div>
                                                      <strong>Check requirements below</strong>
                                                      <div class="form-group">
                                                        <div class="checkbox">
                                                          <label for="Application">
                                                            <input id="" type="checkbox" name="application" value="Y"> Applications
                                                          </label>
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <div class="checkbox">
                                                          <label for="referee">
                                                            <input id="" type="checkbox" name="referee" value="Y"> Referees
                                                          </label>
                                                        </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <div class="checkbox">
                                                          <label for="guarantor">
                                                            <input id="" type="checkbox" name="guarantor" value="Y"> Guarantors
                                                          </label>
                                                        </div>
                                                      </div>
                                                      <input type="submit" name="saveVacancy" value="Save" class="btn btn-success" onclick="return confirm('Please ensure the requirements are appropriately checked before you save.');" >
                                             </form>        
                          </div>
                     </div>
                
                
            </div>
            
           
       </div>
<?php include_once("includes/footer.php"); ?>