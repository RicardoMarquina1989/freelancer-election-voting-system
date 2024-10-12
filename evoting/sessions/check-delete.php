<?php
if (isset($_GET['sessionid'])) {
    $sql = "SELECT sessionid  FROM `tblvotingresult` WHERE sessionid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['sessionid']);
    $stmt->execute();
    $result = $stmt->get_result();

    $sql = "SELECT candidateid FROM `tblcandidates` WHERE sessionid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['sessionid']);
    $stmt->execute();
    $cresult = $stmt->get_result();

    if ($result->num_rows > 0) {
        redirect_to("index.php?report=-1");
    } else if ($cresult->num_rows > 0) {
        redirect_to("index.php?report=-3");
    } else { ?>
        <script>
            if (confirm('Are you sure you want to delete this session?')) {
                window.location.href = "delete.php?confirmed=1&sessionid=<?php echo $_GET['sessionid'] ?>";
            } else {
                window.location.href = "index.php";
            }
        </script>
<?php exit;
    }
}
//redirect_to("admin-user-report.php?report=2");
