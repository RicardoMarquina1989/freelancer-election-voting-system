<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php
  if(isset($_POST['create_admin'])){
    require_once("admin/insert-admin.php");
  }
?>
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
            <div class="spacebar"></div>
            <div class="col-md-8">
              <div class="spacebar"></div>
                            <div class="breadcrumb1">
                                      <div class="bread-title">
                                              <h1>Create Admin User</h1>
                                      </div>
                            </div>
                                    <div class="spacebar"></div>

              <div class="panel panel-info">
                  <div class="panel-heading">
                      <div class="panel-title">
                          Create Admin User
                      </div>
                  </div>
                  <div class="panel-body">
                     <form method="post" autocomplete="off">
                      <?php if(!empty($message)){ 
                          echo "<p class=\"alert alert-danger\">"; 
                          echo $message; 
                          echo "</p>";
                         } ?>
           <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="admin_fullname" value="<?php if(isset($_POST['create_admin'])){ echo htmlentities($admin_fullname); }?>" required="required" maxlength="45" class="form-control" placeholder="Enter Fullname...">
          </div> 
           <div class="form-group">
            <label>Username</label>
            <input type="text" name="admin_username" value="<?php if(isset($_POST['create_admin'])){ echo htmlentities($admin_username); }?>" required="required" maxlength="15" class="form-control" placeholder="Enter Username...">
          </div> 
           <div class="form-group">
            <label>Description</label>
            <input type="text" name="admin_description" value="<?php if(isset($_POST['create_admin'])){ echo htmlentities($admin_description); }?>" required="required" maxlength="40" class="form-control" placeholder="Describe the Admin...">
          </div> 
           <div class="form-group">
            <label>Admin Type</label>
            <select name="admin_type" class="form-control">
                <option value="U">Standard Admin</option>
                <option value="M">Super Admin</option>
            </select>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="Password" name="admin_password" required="required" maxlength="32" class="form-control" placeholder="Enter Password...">
          </div> 
           <div class="spacebar"></div>
          <fieldset>
            <legend>Please Set the permissions for this admin below.</legend>
          
          <div class="spacebar"></div>
            <div class="row">
              <div class="col-sm-4 form-group">
                <label>
                    <input id="login-remember" type="checkbox" name="adminclient_activation" value="1"> Clients Activations
                </label>
              </div> 
               <div class="col-sm-4 form-group">
                 <label>
                    <input id="login-remember" type="checkbox" name="admindeposit_approval" value="1"> Deposists Approvals
              </div>   
              <div class="col-sm-4 form-group">
                 <label>
                    <input id="login-remember" type="checkbox" name="adminloan_approval" value="1"> Loans Approvals
                </label>
              </div>    
            </div> 
             </fieldset>    
          <div class="spacebar"></div>  
          <input type="submit" value="Create" name="create_admin" class="btn btn-success">       
          </div>
        </form> 

                    
                  </div>
                
              </div>

            </div>
            
           
       </div>
  <?php include_once("includes/footer.php"); ?>