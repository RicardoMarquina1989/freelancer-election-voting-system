          <form method="post" action="admin-profile.php?edp=<?php echo $id; ?> ">
           <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="admin_fullname" value="<?php echo $row['Full name']; ?>" required="required" maxlength="45" class="form-control" placeholder="Enter Fullname...">
          </div> 
           <div class="form-group">
            <label>Username</label>
            <input type="text" name="admin_username" value="<?php echo $row['Login name']; ?>" required="required" maxlength="15" class="form-control" placeholder="Enter Username...">
          </div> 
          <div class="form-group">
            <label>Enter Password</label>
            <input type="Password" name="admin_password" required="required" maxlength="32" class="form-control" placeholder="Enter Password...">
          </div> 
           <div class="spacebar"></div>
          <div class="spacebar"></div>  
          <input type="submit" value="Submit" name="submit" class="btn btn-success">       
          </div>
        </form> 