<?php
if (isset($_GET['positionid'])) {
    $sql = "SELECT positionid  FROM `tblvotingresult` WHERE positionid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['positionid']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        redirect_to("index.php?report=-1");
    } else { ?>
        <script>
            if (confirm('Are you sure you want to delete this position?')) {
                window.location.href = "delete.php?confirmed=1&positionid=<?php echo $_GET['positionid'] ?>";
            } else {
                window.location.href = "index.php";
            }
        </script>
<?php exit;
    }
}
//redirect_to("admin-user-report.php?report=2");
