<div class="breadcrumb1">
  <div class="bread-title king-toolbar">
    <h1 class="float-left">Voting Results</h1>
    <div class="float-right">
      <a href="<?php echo 'export.php?sessionid=' . (isset($_GET['sessionid']) ? $_GET['sessionid'] : '#') ?>" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Export</a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-8 col-md-offset-2" style="max-width: 587px;">
    <form action="result.php" method="get">
      <div class="form-group">
        <!-- <div class="row"> -->

        <select class="form-control" name="sessionid" id="mySelect" required="required">
          <option value="">--Please Select Session --</option>
          <?php
          $sql = "SELECT `sessionid`, `title`, DATE_FORMAT(`votingdate`, '%c/%e/%Y') as votingdate1, `status` FROM tblsessions  ORDER BY `votingdate` DESC";
          $stmt = $conn->prepare($sql);
          //$stmt->bind_param("s",$activated);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
          ?>
              <option value="<?php echo $row['sessionid']; ?>" <?php echo (isset($_GET['sessionid']) && $row['sessionid'] == $_GET['sessionid']) ? 'selected' : '' ?>><?php echo $row['title'] . "-" . $row['votingdate1'] . "-" . $row['status']; ?> </option>
          <?php
            }
          }
          ?>
        </select>
      </div>
    </form>

    <?php include("../../includes/message_alert.php"); ?>
    <table class="table table-striped table-bordered">
      <tr class="thbg">
        <th>S/N</th>
        <th>Position</th>
        <th>Question</th>
        <th>Score</th>
      </tr>
      <?php
      if (isset($_GET['sessionid']) && $_GET['sessionid']) {
        $sql = "SELECT
        p.positionid,
        p.position,
        p.question,
        v.cnt AS total_vote 
      FROM
        (SELECT * FROM tblpositions WHERE positionid IN (SELECT positionid FROM tblcandidates WHERE sessionid=?) ) AS p
        LEFT JOIN ( SELECT positionid, COUNT( candidateid ) AS cnt FROM tblvotingresult WHERE sessionid = ? GROUP BY positionid ) AS v ON p.positionid = v.positionid;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $_GET['sessionid'], $_GET['sessionid']);
        $stmt->execute();
        $result = $stmt->get_result();
        $sn = 1;
        while ($row = $result->fetch_array()) {
          echo "<tr>
            <td>{$sn}</td>
            <td>{$row['position']}</td>
            <td>{$row['question']}</td>
            <td></td>
          </tr>";
          $csql = "SELECT
          CONCAT(
            firstname,
          IF
            ( middlename, CONCAT( ' ', middlename ), '' ),
          CONCAT( ' ', surname )) AS candidate,
          c.candidateid,
          sessionid,
          v.cnt AS total_vote 
        FROM
          (SELECT * FROM tblcandidates WHERE positionid=?) AS c
          LEFT JOIN ( SELECT COUNT( id ) AS cnt, candidateid FROM tblvotingresult WHERE positionid=? GROUP BY candidateid ) AS v ON c.candidateid = v.candidateid 
        WHERE
          c.sessionid = ? ORDER BY total_vote DESC;";

          $stmt = $conn->prepare($csql);
          $stmt->bind_param("iii", $row['positionid'], $row['positionid'], $_GET['sessionid']);
          $stmt->execute();
          $cand_result = $stmt->get_result();
          $index = 0;
          $rt = $row['total_vote'] ?? 0;
          while ($crow = $cand_result->fetch_array()) {
            $ct = $crow['total_vote'] ?? 0;
            echo "<tr>
            <td></td>
            <td></td>
            <td>{$crow['candidate']}</td>
            <td>{$ct}</td>
          </tr>";
          }
          echo "<tr>
            <td></td>
            <td></td>
            <td style='text-align:right'><strong><i>Total vote</i></strong></td>
            <td>{$rt}</td>
          </tr>";
          $sn++;
        }
      }
      ?>
    </table>
  </div>
</div>