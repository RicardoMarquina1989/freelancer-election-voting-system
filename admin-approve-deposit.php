<?php require_once("includes/session.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php require_once("includes/connections.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $approved = ACT_N; ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/head.php"); ?>

<body style="background-color:#f0f0f7; ">
  <!-- Navigation -->
  <?php
  // heade navigation
  include("includes/header_menu.php");
  ?>
  <?php
  // admin dashboard left side here
  include('includes/admin_dashboard_leftside.php');
  ?>
  <div class="col-md-8">
    <div class="spacebar"></div>
    <div class="breadcrumb1">
      <div class="bread-title">
        <h1>Deposits Approvals</h1>
      </div>
    </div>
    <div class="spacebar"></div>
    <div class="row">
      <?php if (isset($_GET['dec_id']) && ($_GET['dec_id'] == "true")) {
        $message = "Client successfully declined";
      } ?>
      <?php if (isset($_GET['activation']) && ($_GET['activation'] == "true")) {
        $message = "Client successfully activated";
      } ?>
      <?php if (!empty($message)) {
        echo "<div class=\"alert alert-info\">" . $message . "</div>";
      }
      ?>

      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="panel-title">
            Only pending deposits approvals are displayed by default. You can review approved or declined deposits applications by using the dropdown or search field below.
          </div>
        </div>
        <div class="panel-body">
          <form action="admin-deposit-review.php" method="get">
            <div class="form-group">
              <div class="col-md-10">
                <label for="">Select Deposit Application:</label>
                <select class="form-control" name="client_id" id="mySelect" required="required">
                  <option value="">--Please Select --</option>
                  <?php
                  $sql = "SELECT `e`.`ApplicationID`,`e`.`Client code`, `f`.`Client name` FROM tbldepositsapplications AS e LEFT JOIN tblclients AS f ON `e`.`Client code`=`f`.`Client code` ORDER BY `f`.`Client name` ASC";
                  $stmt = $conn->prepare($sql);
                  //$stmt->bind_param("s",$activated);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      # code...
                      echo "<option value=\"{$row['ApplicationID']}\"> {$row['Client name']} - {$row['Client code']} </option>";
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-2">
                <input type="submit" name="Client_Review" value="Review" class="btn btn-success" style="margin-top: 30px;">
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <table class="table table-striped table-bordered">
        <tr class="thbg">
          <th>Date Applied</th>
          <th>Client Code</th>
          <th>Client Name</th>
          <th>Status</th>
          <th>&nbsp;</th>
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

        $pagination_result = "SELECT `d`.`ApplicationID`,`d`.`Client code`, `d`.`Date applied`, `d`.`Approved`, `c`.`Client name` FROM tbldepositsapplications AS d LEFT JOIN tblclients AS c ON `d`.`Client code`=`c`.`Client code` WHERE `Approved`=? ORDER BY `Date applied` DESC LIMIT $offset, $total_records_per_page";
        $stmt = $conn->prepare($pagination_result);
        $stmt->bind_param("s", $approved);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $date_applied = date('d-M-Y', strtotime($row['Date applied']));
            if ($row['Approved'] == 'Y') {
              $status = "Approved";
            } elseif ($row['Approved'] == 'N') {
              # code...
              $status = "Pending";
            } elseif ($row['Approved'] == 'D') {
              $status = "Declined";
            } else {
            }
            echo "<tr>
                  <td>{$date_applied}</td>
                  <td>{$row['Client code']}</td>
                  <td>{$row['Client name']}</td>
                  <td>{$status}</td>
                  <td><a href=\"admin-deposit-review.php?client_id={$row['ApplicationID']}&case=Client Review\" class=\"btn btn-success\">Review</a></td>
                  </tr>";
          }
        } ?>

      </table>
    </div>
    <div class="row col-md-10">
      <?php
      $result_count = "SELECT COUNT(ApplicationID) AS total_records FROM tbldepositsapplications WHERE `Approved`=?";
      $stmt = $conn->prepare($result_count);
      $stmt->bind_param("s", $approved);
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
  <?php include_once("includes/footer.php"); ?>