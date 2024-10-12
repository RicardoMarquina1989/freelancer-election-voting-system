<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/constants.php"); ?>
<?php require_once("../../includes/connections.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("../../includes/head.php"); ?>

<body style="background-color:#f0f0f7; ">
  <!-- Navigation -->
  <?php include_once("../../includes/header_menu.php"); ?>

  <?php
  // this is the left side
  include("../../client/client_dashboard_leftside.php");
  ?>
  <div class="col-md-8">
    <div class="spacebar"></div>
    <?php
    $alert = '';
    if (isset($_GET['status'])) {
      switch ($_GET['status']) {
        case 'no':
          $alert = "There are no opened voting session.";
          break;
        case 'already':
          $alert = "You have already voted in this session.";
          break;
        case 'time':
          $alert = "You can't take part in at this time. Please confirm the start and end time.";
          break;
        default:
          $alert = null;
          break;
      }
    }
    ?>
    <?php if (!empty($alert)) {
      echo "<div class=\"alert alert-danger\">" . $alert . "</div>";
    } ?>
    <?php if (!empty($message)) {
      echo "<div class=\"alert alert-info\">" . $message . "</div>";
    } ?>
    <div class="breadcrumb1">
      <div class="bread-title">
        <h1>Open Voting Sessions</h1>
      </div>
    </div>
    <div class="spacebar"></div>
    <div class="row">
      <table class="table table-striped table-bordered">
        <tr class="thbg">
          <th>No</th>
          <th>Title</th>
          <th>Voting Date</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Created By</th>
          <th>Date Created</th>
          <th>Action</th>
        </tr>
        <?php
        $total_records_per_page = 10;
        if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
          $page_no = $_GET['page_no'];
        } else {
          $page_no = 1;
        }
        $offset = ($page_no - 1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";

        $pagination_result = "SELECT s.*, a.`Full name` AS creator, b.`Full name` AS closer FROM (SELECT * from tblsessions WHERE status='open' AND votingdate=?) AS s LEFT JOIN tblaccess AS a ON s.createdby=a.`USER ID` LEFT JOIN tblaccess AS b ON s.closedby=b.`USER ID` ORDER BY `datecreated` DESC LIMIT $offset, $total_records_per_page";
        $stmt = $conn->prepare($pagination_result);
        $today = date('Y-m-d');
        $stmt->bind_param('s', $today);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          $index = 1;
          while ($row = $result->fetch_assoc()) {
            $num = ($page_no - 1) * $total_records_per_page + $index;
            $voting_date = date('m/d/Y', strtotime($row['votingdate']));
            $datecreated = date('m/d/Y', strtotime($row['datecreated']));
            echo "<tr>
                    <td>{$index}</td>
                    <td>{$row['title']}</td>
                    <td>{$voting_date}</td>
                    <td>{$row['starttime']}</td>
                    <td>{$row['endtime']}</td>
                    <td>{$row['creator']}</td>
                    <td>{$datecreated}</td>
                    <td><a href=\"check_valid.php?sessionid={$row['sessionid']}\" class=\"btn btn-danger\">Vote</a></td>
                  </tr>";
            $index++;
          }
        } ?>
      </table>
    </div>
    <div class="row col-md-10">
      <?php
      $result_count = "SELECT COUNT(sessionid) AS total_records FROM tblsessions WHERE `status` = 'open' AND votingdate=?";
      $stmt = $conn->prepare($result_count);
      $today = date('Y-m-d');
      $stmt->bind_param("s", $today);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      ##calculate total pages with results
      $total_no_of_pages = ceil($row['total_records'] / $total_records_per_page);
      $second_last = $total_no_of_pages - 1; // total pages minus 1

      ?>

      <ul class="pagination">
        <?php if ($page_no > 1) {
          echo "<li><a href='?page_no=1'>First Page</a></li>";
        } ?>
        <li <?php if ($page_no <= 1) {
              echo "class='disabled'";
            } ?>>
          <a <?php if ($page_no > 1) {
                echo "href='?page_no=$previous_page'";
              } ?>>Previous </a>
        </li>

        <?php
        if ($total_no_of_pages <= 10) {
          for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
            if ($counter == $page_no) {
              echo "<li class='active'><a>$counter</a></li>";
            } else {
              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
            }
          }
        } elseif ($total_no_of_pages > 10) {
          if ($page_no <= 4) {
            for ($counter = 1; $counter < 8; $counter++) {
              if ($counter == $page_no) {
                echo "<li class='active'><a>$counter</a></li>";
              } else {
                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
              }
            }
            echo "<li><a>...</a></li>";
            echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
            echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
          } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
            echo "<li><a href='?page_no=1'>1</a></li>";
            echo "<li><a href='?page_no=2'>2</a></li>";
            echo "<li><a>...</a></li>";
            for (
              $counter = $page_no - $adjacents;
              $counter <= $page_no + $adjacents;
              $counter++
            ) {
              if ($counter == $page_no) {
                echo "<li class='active'><a>$counter</a></li>";
              } else {
                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
              }
            }
            echo "<li><a>...</a></li>";
            echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
            echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
          } else {
            echo "<li><a href='?page_no=1'>1</a></li>";
            echo "<li><a href='?page_no=2'>2</a></li>";
            echo "<li><a>...</a></li>";
            for (
              $counter = $total_no_of_pages - 6;
              $counter <= $total_no_of_pages;
              $counter++
            ) {
              if ($counter == $page_no) {
                echo "<li class='active'><a>$counter</a></li>";
              } else {
                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
              }
            }
          }
        }

        ?>


        <li <?php if ($page_no >= $total_no_of_pages) {
              echo "class='disabled'";
            } ?>>
          <a <?php if ($page_no < $total_no_of_pages) {
                echo "href='?page_no=$next_page'";
              } ?>>Next</a>
        </li>
        <?php if ($page_no < $total_no_of_pages) {
          echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
        } ?>
      </ul>

    </div>
  </div>

  </div>
  <?php include_once("../../includes/footer.php"); ?>