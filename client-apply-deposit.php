<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<!DOCTYPE html>
<html lang="en">
 <?php include_once("includes/head.php"); ?>
 <body style="background-color:#f0f0f7; ">
<?php global $manager; ?>
    <!-- Navigation -->
       <?php include_once("includes/header_menu.php"); ?> 
 
  <?php
  // this is the left side
  include("client/client_dashboard_leftside.php");
   ?>
            <div class="col-md-8"><div class="spacebar"></div>
            <div class="breadcrumb1">
                              <div class="bread-title">
                                  <h1>Apply for Deposit</h1>
                              </div>
                        </div>
                        <div class="spacebar"></div>
                         <div class="panel panel-info">
                                      <div class="panel-heading">
                                          <div class="panel-title">
                                              Please fill all the fields below to apply for savings withdrawal or change in savings.
                                          </div>
                                      </div>

                                       <div class="panel-body">
                                        <?php if(isset($_GET['admin']) == "admin"){
                                        echo "<div class=\"alert alert-danger\">" . "Invalid Client Code. Application Failed." . "</div>";
                                      }
                                      ?>
                                              <form action="action_page.php" method="post">
                                                       <div class="form-group">
                                                        <label for="seeAnotherFieldGroup">Application Type:</label>
                                                       <select class="form-control" name="application_type" id="seeAnotherFieldGroup" required="required">
                                                          <option value="sw">Savings Withdrawal</option>
                                                          <option value="cs">Change in Savings</option>                             
                                                      </select>
                                                      </div>
                                                      <div class="form-group" id="otherFieldGroupDiv">
                                                            <div class="row">
                                                                   <div class="col-md-12">
                                                                    <label for="otherField1">Old Deduction:</label>
                                                                    <input type="number" class="form-control" name="old_deduction" id="otherField1" required="required" placeholder="Example:3000">
                                                                  </div>    
                                                                  <div class="col-md-12">
                                                                    <label for="otherField2">New Deduction:</label>
                                                                    <input type="number" class="form-control" name="new_deduction" id="otherField2" required="required" placeholder="Example: 5000">
                                                                  </div>
                                                            </div>
                                                    </div>
                                                    <div class="form-group" id="otherFieldGroupDivTwo">
                                                            <label for="otherField3">Withdrawal Amount:</label>
                                                            <input type="number" class="form-control" name="withdrawal_amount" id="otherField3" required="required" placeholder="Example: 20000">
                                                    </div>
                                                       <div class="form-group">
                                                        <label for="date">Date Applied:</label>
                                                        <input type="date" class="form-control" name="date_applied" id="subject" required="required" placeholder="Pick date">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="date">Start Date:</label>
                                                        <input type="date" class="form-control" name="start_date" id="subject" required="required" placeholder="Pick date">
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="subject">Subject:</label>
                                                        <input type="text" class="form-control" name="deposit_subject" id="subject" maxlength="100" required="required" placeholder="Enter Subject...">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="comment">Body:</label>
                                                        <textarea class="form-control" rows="5" name="deposit_body" id="comment" required="required"></textarea>
                                                      </div>
                                                       <div class="form-group">
                                                        <input type="text" name="client_code" value="<?php echo $ecode; ?>" hidden="hidden" >
                                                        <input type="text" name="client_email" value="<?php echo $client_email; ?>" hidden="hidden" >
                                                      </div>
                                                      <input type="submit" name="applydeposit" value="Apply" class="btn btn-success" onclick="return confirm('Are you sure you want to apply for this deposit?')">
                                            </form>        

                          
                                      </div>
                          </div>
            </div>    
       </div>
<?php include_once("includes/footer.php"); ?>
<script type="text/javascript">
  $("#seeAnotherFieldGroup").change(function() {
  if ($(this).val() == "cs") {
    $('#otherFieldGroupDiv').show();
    $('#otherField1').attr('required', '');
    $('#otherField1').attr('data-error', 'This field is required.');
    $('#otherField2').attr('required', '');
    $('#otherField2').attr('data-error', 'This field is required.');
    $('#otherFieldGroupDivTwo').hide();
    $('#otherField3').removeAttr('required');
    $('#otherField3').removeAttr('data-error');
  } else {
    $('#otherFieldGroupDiv').hide();
    $('#otherField1').removeAttr('required');
    $('#otherField1').removeAttr('data-error');
    $('#otherField2').removeAttr('required');
    $('#otherField2').removeAttr('data-error');
    $('#otherFieldGroupDivTwo').show();
    $('#otherField3').attr('required', '');
    $('#otherField3').attr('data-error', 'This field is required.');
  }
});
$("#seeAnotherFieldGroup").trigger("change");

</script>