<?php
    if (isset($_POST['create_admin'])) 
    {
        $admin_fullname = ucwords($_POST['admin_fullname']);
        $admin_username = $_POST['admin_username'];
        $admin_description = ucwords($_POST['admin_description']);
        $admin_type = $_POST['admin_type'];
        $admin_password = $_POST['admin_password'];
       if(isset($_POST['adminclient_activation'])) {$adminclient_activation = $_POST['adminclient_activation'];}else{$adminclient_activation = 0;}
        if(isset($_POST['admindeposit_approval'])) {$admindeposit_approval = $_POST['admindeposit_approval'];}else{$admindeposit_approval = 0;}
        if(isset($_POST['adminloan_approval'])) {$adminloan_approval = $_POST['adminloan_approval'];}else{$adminloan_approval = 0;}
        //$adminclient_activation = $_POST['adminclient_activation'];
        //$adminclient_activation = $_POST['admindeposit_approval'];
        //$adminclient_activation = $_POST['adminloan_approval'];
        $uppercase = preg_match('@[A-Z]@', $admin_password);
        $lowercase = preg_match('@[a-z]@', $admin_password);
        $number = preg_match('@[0-9]@', $admin_password);
        $specialChars = preg_match('@[^\w]@', $admin_password);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($admin_password) < 8 ) {
            $message = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
            return;
        }
        else{
             $hash_password = md5($admin_password);
     $sql = "INSERT INTO `tblaccess` (`Login name`, `Login password`, `Full name`, `Description of user`, `Type`, `ClientsActivations`, `DepositsApprovals`, `LoansApprovals`) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiii",$admin_username,$hash_password,$admin_fullname,$admin_description,$admin_type,$adminclient_activation,$admindeposit_approval,$adminloan_approval);
        $result = $stmt->execute(); 
        if ($result === TRUE) 
        {
            redirect_to("admin-user-report.php?report=1");
        } else {
           redirect_to("admin-user-report.php?report=0");
        }  
    }
}
//redirect_to("admin-user-report.php?report=2");
?>
