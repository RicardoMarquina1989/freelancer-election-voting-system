<?php
if (isset($_GET['candidateid'])) {
    $sql = "SELECT candidateid  FROM `tblvotingresult` WHERE candidateid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['candidateid']);
    $stmt->execute();
    $result = $stmt->get_result();
    $request_url = $_SERVER['HTTP_REFERER'] ?? $_SERVER['HTTPS_REFERER'];

    // Use parse_url() function to parse the URL 
    // and return an associative array which
    // contains its various components
    $url_components = parse_url($request_url);

    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);

    if ($result->num_rows > 0) {
        redirect_to("index.php?candidateid={$params['candidateid']}&report=-1");
    } else { ?>
        <script>
            if (confirm('Are you sure you want to delete this candidate?')) {
                window.location.href = "delete.php?confirmed=1&candidateid=<?php echo $_GET['candidateid'] ?>";
            } else {
                window.location.href = "index.php";
            }
        </script>
<?php exit;
    }
}
//redirect_to("admin-user-report.php?report=2");
