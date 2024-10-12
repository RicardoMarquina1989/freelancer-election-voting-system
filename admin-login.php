<?php require_once("includes/session.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php require_once("includes/connections.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if (isset($_POST['login']) && ($_SERVER["REQUEST_METHOD"] == "POST")) {
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    if (($_POST['username'] == "") || ($_POST['password'] == "")) {
        $message = "Enter Your Username and Password";
    } else {
        $hash_password = md5($password);
        $sql = "SELECT `User ID`,`Full name`, `Active` FROM `tblaccess` WHERE `Login name` = '$username' AND `Login password` = '$hash_password'  LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $found_user = $result->fetch_assoc();
            $_SESSION['fullname'] = $found_user['Full name'];
            $_SESSION['user_id'] = $found_user['User ID'];
            $_SESSION['is_admin'] = '1';
            if ($found_user['Active'] == "Y") {
                redirect_to("/admin-dashboard.php");
                // exit('0dd');
            } else {
                $message = "Sorry! Your account is invalid or deactivated";
            }
        } else {
            $message = "Invalid Username or Password.";
        }
    }
} //end of if isset post submit
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/head.php"); ?>

<body style="background-color:#fff; ">


    <!-- Navigation -->
    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">
                        <img src="" alt="">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <div class="menu">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href=""></a>
                            </li>
                            <li>
                                <a href=""></a>
                            </li>
                            <li>
                                <a href=""></a>
                            </li>
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
    </header>
    <div class="spacebar"></div>
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="breadcrumb1">
            <div class="bread-title">
                <h1>Admin Login</h1>
            </div>
        </div>

    </div>
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Use the login details received by mail to sign in</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><!-- <a href="#">Forgot password?</a> --></div>
                </div>

                <div style="padding-top:30px" class="panel-body">

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                    <form id="loginform" class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <?php if (!empty($message)) {
                            echo "<p class=\"alert alert-danger\">" . $message . "</p>";
                        } ?>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="text" class="form-control" name="username" value="<?php if (isset($_POST['login'])) {
                                                                                                                    echo htmlentities($username);
                                                                                                                } ?>" placeholder="Enter username..." required="required">
                        </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" value="" placeholder="Enetr Password..." required="required">
                        </div>

                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls">
                                <!-- <a id="btn-login" href="" class="btn btn-success">Login  </a> -->
                                <input type="submit" name="login" class="btn btn-success" value="Login">


                            </div>
                        </div>
                    </form>



                </div>
            </div>
        </div>

    </div>
    <div class="spacebar"></div>
</body>

</html>
<?php require_once("includes/footer.php"); ?>