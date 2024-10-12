<?php
    $user_id = $_SESSION['user_id'];
    $news_date = $_POST['news_date'];
    $news_title = ucwords($_POST['news_title']);
    $news_body = $_POST['news_body'];
    $saved = Y_CONST;
    $closed = N_CONST;
    $date_time = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `tblnews` (`NewsID`, `NewsDate`, `NewsTitle`, `NewsBody`, `Saved`, `Closed`, `User ID`, `User datetime`, `upsize_ts`) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssdss",$news_id,$news_date,$news_title,$news_body,$saved,$closed,$user_id,$date_time,$empty);
    $result = $stmt->execute();
if ($result === TRUE) {
    //echo "New record created successfully";
    redirect_to("admin-news.php?insert=success");
} else {
    redirect_to("admin-news.php?insert=error");
}
?>
