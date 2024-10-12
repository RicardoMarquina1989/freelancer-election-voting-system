<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php
  if(isset($_POST['register'])){
    require_once("includes/register-process.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <?php include_once("includes/head.php"); ?>
 <body style="background-color:#fff; ">
  <!-- Navigation -->
    <?php include_once("includes/login_header_menu.php"); ?> 
 <div class="spacebar"></div>
<div class="col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2" >
  <div class="breadcrumb1">
      <div class="bread-title">
          <h1>Members Registration</h1>
      </div>
  </div>
  
</div>
     <div class="container"> 
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Please fill all the fields below to register as a new member. Double registration is not allowed.</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><!-- <a href="#">Forgot password?</a> --></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                         <form role="form" method="post" enctype="multipart/form-data" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <?php if(!empty($message)){ 
                          echo "<p class=\"alert alert-danger\">"; 
                          echo $message; 
                          echo "</p>";
                         } ?>
                                                      <div class="form-group" id="" >
                                                               <div class="row">
                                                                    <div class="col-md-4">
                                                                          <label for="name">Surname:<span class="error"><?php if(isset($_POST['register'])){echo $surnameErr;} ?></span></label>
                                                                          <input type="text" class="form-control" name="surname" id="" maxlength="20" value="<?php if(isset($_POST['register'])){ echo htmlentities($surname); }?>" required="required" placeholder="">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                          <label for="name">First name:<span class="error"><?php if(isset($_POST['register'])){ echo $firstnameErr;} ?></span></label>
                                                                          <input type="text" class="form-control" name="firstname" id="" maxlength="20" required="required" placeholder="" value="<?php if(isset($_POST['register'])){ echo htmlentities($firstname); }?>">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                          <label for="name">Middle name:<span class="error"><?php if(isset($_POST['register'])){ echo $middlenameErr;} ?></span></label>
                                                                          <input type="text" class="form-control" name="middlename" id="" maxlength="20" placeholder="" value="<?php if(isset($_POST['register'])){ echo htmlentities($middlename); }?>">
                                                                    </div>
                                                                    
                                                              </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="address">Staff Number:<span class="error"><?php if(isset($_POST['register'])){ echo $staff_numberErr;} ?></span></label>
                                                        <input type="text" class="form-control" name="staff_number" id="" required="required" value="<?php if(isset($_POST['register'])){ echo htmlentities($staff_number); }?>" placeholder="" maxlength="150">
                                                      </div>
                                                      
                                                       <div class="form-group">
                                                        <label for="address">Residential Adrress:<span class="error"><?php if(isset($_POST['register'])){ echo $residential_addressErr;} ?></span></label>
                                                        <input type="text" class="form-control" name="residential_address" id="" required="required" value="<?php if(isset($_POST['register'])){ echo htmlentities($residential_address); }?>" placeholder="" maxlength="150">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="address">Branch:<span class="error"><?php if(isset($_POST['register'])){ echo $branchErr;} ?></span></label>
                                                        <input type="text" class="form-control" name="branch" id="" required="required" value="<?php if(isset($_POST['register'])){ echo htmlentities($branch); }?>" placeholder="" maxlength="150">
                                                      </div>
                                                       <div class="form-group" id="" >
                                                               <div class="row">
                                                                          <div class="col-md-6">
                                                                                <label for="email">Email Address:<span class="error"><?php if(isset($_POST['register'])){ echo $email_addressErr;} ?></span></label>
                                                                                <input type="email" class="form-control" name="email_address" id="" maxlength="40" required="required" value="<?php if(isset($_POST['register'])){ echo htmlentities($email_address); }?>" placeholder="">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                                <label for="phone">Phone Number:<span class="error"><?php if(isset($_POST['register'])){ echo $mobile_phoneErr; }?></span></label>
                                                                                <input type="text" class="form-control" name="mobile_phone" value="<?php if(isset($_POST['register'])){ echo htmlentities($mobile_phone); }?>" id="" maxlength="15" required="required" placeholder="">
                                                                          </div>
                                                                          
                                                              </div>
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="nok">Next Of Kin:<span class="error"><?php if(isset($_POST['register'])){ echo $nokErr;} ?></span></label>
                                                        <input type="text" class="form-control" name="nok" value="<?php if(isset($_POST['register'])){ echo htmlentities($nok); }?>" id="" required="required" placeholder="" maxlength="45">
                                                      </div>
                                                       <div class="form-group">
                                                        <label for="nok">Address of Next of Kin:<span class="error"><?php if(isset($_POST['register'])){ echo $nok_addressErr;} ?></span></label>
                                                        <input type="text" class="form-control" name="nok_address" id="" required="required" value="<?php if(isset($_POST['register'])){ echo htmlentities($nok_address); }?>" placeholder="" maxlength="50">
                                                      </div>
                                                      <div class="form-group" id="fieldGroupOneDiv" >
                                                               <div class="row">
                                                                          <div class="col-md-6">
                                                                                <label for="nok">Next of Kin Relationship:<span class="error"><?php if(isset($_POST['register'])){echo $nok_relationshipErr;} ?></span></label>
                                                                                <input type="text" class="form-control" name="nok_relationship" value="<?php if(isset($_POST['register'])){ echo htmlentities($nok_relationship); }?>" id="" maxlength="30" required="required" placeholder="">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                                <label for="nok">Next of Kin Phone Number:<span class="error"><?php if(isset($_POST['register'])){echo $nok_phoneErr;} ?></span></label>
                                                                                <input type="text" class="form-control" name="nok_phone" id="" value="<?php if(isset($_POST['register'])){ echo htmlentities($nok_phone); }?>" maxlength="15" required="required" placeholder="">
                                                                          </div>
                                                                          
                                                              </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="savings">Monthly Savings:<span class="error"><?php if(isset($_POST['register'])){ echo $monthly_savingsErr;} ?></span></label>
                                                        <input type="number" class="form-control" name="monthly_savings" id="" required="required" placeholder="" value="<?php if(isset($_POST['register'])){ echo htmlentities($monthly_savings); }?>" maxlength="30">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="application">Application type:<span class="error"><?php if(isset($_POST['register'])){ echo $application_typeErr; }?></span></label>
                                                             <select class="form-control" name="application_type" id="seeAnotherFieldGroup" required="required">
                                                                <option value="<?php if(isset($_POST['register'])){ echo htmlentities($application_type); }?>"><?php if(isset($_POST['register'])){ echo htmlentities($application_type); } else{echo" -- Select Application Type -- ";}?></option>
                                                                <option value="New Registration">New Registration</option> 
                                                                <option value="Rejoining">Rejoining</option>
                                                                <option value="Data Update">Data Update</option>                                                       
                                                            </select>
                                                      </div>
                                                     
                                                      <div class="form-group" id="otherFieldGroupDiv">
                                                               <div class="row">
                                                                           <div class="col-md-12">
                                                                            <label for="otherField3">Registration Fee Paid:<span class="error"><?php if(isset($_POST['register'])){ echo $reg_paidErr; }?></span></label>
                                                                            <input type="number" class="form-control" name="reg_paid" id="otherField3" required="required" placeholder="" value="<?php if(isset($_POST['register'])){ echo htmlentities($reg_paid); }?>" maxlength="30">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                              <label for="otherField1">Upload Registration Fee Evidence: <span class="error"><?php if(isset($_POST['register'])){ echo $receiptErr;} ?></span></label>
                                                                              <input type="file" name="receipt" id="otherField1" value="<?php if(isset($_POST['register'])){ echo htmlentities($receipt_upload); }?>" required="required">
                                                                          </div>
                                                                          
                                                                          <div class="col-md-6">
                                                                                <strong>Note:</strong>
                                                                                  <i><ul>
                                                                                    <li>Registration fee evidence must be uploaded in PDF or jpeg format with max size of 250kb</li>
                                                                                  </ul></i>
                                                                          </div>
                                                                           <div class="col-md-6">
                                                                               <label for="otherField2">Upload Your Passport:<span class="error"><?php if(isset($_POST['register'])){echo $photoErr;} ?></span></label>
                                                                                <input type="file" name="photo" id="otherField2" value="<?php if(isset($_POST['register'])){ echo htmlentities($photo_upload); }?>" required="required">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                                <strong></strong>
                                                                                    <i><ul>
                                                                                      <li>Photograph must be uploaded in jpeg or png format with max size of 75kb</li>
                                                                                    </ul></i>
                                                                          </div>
                                                                          
                                                              </div>
                                                      </div>
                                                      <div class="form-group" id="" >
                                                               <div class="row">
                                                                          <div class="col-md-6">
                                                                                <label for="pass">Preferred Password:<span class="error"><?php if(isset($_POST['register'])){echo $pass1Err;} ?></span></label>
                                                                                <input type="password" class="form-control" name="pass1" id="" value="<?php if(isset($_POST['register'])){ echo $pass1; }?>" required="required">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                                <i><ul>
                                                                                      <li>Password must be at least 8 characters, including upper case letter, number, and special character.</li>
                                                                                    </ul></i>
                                                                          </div>
                                                              </div>

                                                      </div>
                                                      <div class="form-group" id="" >
                                                               <div class="row">
                                                                          
                                                                          <div class="col-md-6">
                                                                                <label for="pass">Confirm Password:<span class="error"><?php if(isset($_POST['register'])){ echo $pass2Err;} ?></span></label>
                                                                                <input type="password" class="form-control" name="pass2" id="" value="<?php if(isset($_POST['register'])){ echo $pass2; }?>" required="required">
                                                                          </div>
                                                                          <div class="col-md-6">
                                                                                
                                                                          </div>
                                                              </div>
                                                              
                                                      </div>
                                                      <div class="form-group" id="" >
                                                               <div class="row">
                                                                          <div class="col-md-6">
                                                                                <label for="otherField2"> &nbsp;Policy acceptance:</label>
                                                                                
                                                                          </div>         
                                                              </div>
                                                      </div>
                                                      <div class="form-group" id="" >
                                                        
<p>By submitting this form, I agree to obey all the rules and regulations guiding the membership of the Grooming (Staff) Cooperative Multipurpose Society as enshrined in their constitution. I mandate the Grooming (Staff) Cooperative Multipurpose Society to withdraw my monthly contributions from my salary.</p>
<p>I also authorise Grooming Centre to credit my Grooming (Staff) Cooperative Multipurpose Society savings monthly from my salary.</p>
<p>I also authorise the Grooming (Staff) Cooperative Multipurpose Society to indemnify Grooming Centre and its affiliates of any financial irregularities/indebtedness I have/indulged in from my Cooperative Savings. </p>
<p>The Cooperative reserves the right to terminate my membership for any reason deemed negative to the progress of Cooperative Society.</p>                                                
                                                        </div>
                                                        <div class="form-group">
                                                             
                                                              <span><strong> Please accept the above policy by checking this box </strong><input type="checkbox" class="" name="regfee" id="" required="required"></span>
                                                        </div>
                                                        <div class="spacebar"></div>
                                                       <div class="form-group">
                                                           <span class="error"><?php if(isset($_POST['register'])){echo $captchaErr;} ?></span>
                                                         <div class="g-recaptcha brochure__form__captcha" data-sitekey="6Lf-GPgdAAAAAEe1A66U-ZXydbVVRwZuByWOBOST" data-callback="enableBtn"></div>
                                                          <div class="spacebar"></div>
                                                        <input type="submit" name="register" class="btn btn-success" value="Submit" id="button1" disabled="disabled">
                                                        </div>                                             

                                    </form>
<script type="text/javascript">
 function enableBtn(){
   document.getElementById("button1").disabled = false;
 }
</script>
                        </div>                     
                    </div>  
        </div>    
    </div>
    <?php include_once("includes/footer.php"); ?>
    <script type="text/javascript">
  $("#seeAnotherFieldGroup").change(function() {
  if ($(this).val() == "Data Update") {
    $('#otherFieldGroupDiv').hide();
    $('#otherField1').removeAttr('required');
    $('#otherField1').removeAttr('data-error');
    $('#otherField2').removeAttr('required');
    $('#otherField2').removeAttr('data-error');
    $('#otherField3').removeAttr('required');
    $('#otherField3').removeAttr('data-error');
  } else {
    $('#otherFieldGroupDiv').show();
    $('#otherField1').attr('required', '');
    $('#otherField1').attr('data-error', 'This field is required.');
    $('#otherField2').attr('required', '');
    $('#otherField2').attr('data-error', 'This field is required.');
    $('#otherField3').attr('required', '');
    $('#otherField3').attr('data-error', 'This field is required.');
  }
});
$("#seeAnotherFieldGroup").trigger("change");
</script>