<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<!DOCTYPE html>
<html lang="en">
  <?php include_once("includes/head.php"); ?>
 <body style="background-color:#f0f0f7; ">
    <!-- Navigation -->
   <?php include_once("includes/header_menu.php"); ?> 
 
   <?php
  // this is the left side
  include("client/client_dashboard_leftside.php");
   ?>
            <div class="col-md-8"><div class="spacebar"></div>
             <?php if(isset($_GET['depositapply']) && !empty($_GET['depositapply'])){
              if ($_GET['depositapply']  == "success"){
                $message = "New Application Successful";
              }
               if ($_GET['depositapply']  == "error"){
                $message = "Application Failed";
              }
               if ($_GET['depositapply']  == "applied"){
                $message = "Sorry you cannot apply at the moment. You have a pending application";
              }
            }
              ?><?php if(!empty($message)){
                                        echo "<div class=\"alert alert-info\">" . $message. "</div>";
                                      } ?>
                  <div class="breadcrumb1">
                        <div class="bread-title">
                            <h1>Deposits Application History</h1>
                        </div>
                  </div>
                  <div class="spacebar"></div>
                                <div class="row">
                                         <table class="table table-striped table-bordered">
                                               <tr class="thbg">
                                                 <th>Date Applied</th>
                                                 <th>Start Date</th>
                                                 <th>Date Reviewed</th>
                                                 <th>Subject</th>
                                                 <th>Status</th>
                                                 <th>Manager's Remark</th>
                                               </tr>
                                               <?php 
                                                 
                                           $total_records_per_page = 10;
                                        if (isset($_GET['page_no']) && $_GET['page_no']!="") 
                                        {
                                          $page_no = $_GET['page_no'];
                                        } 
                                        else 
                                        {
                                          $page_no = 1;
                                        }
                                        $offset = ($page_no-1) * $total_records_per_page;
                                        $previous_page = $page_no - 1;
                                        $next_page = $page_no + 1;
                                        $adjacents = "2";

                                                $pagination_result = "SELECT `Date applied`,`StartDate`, `Date reviewed`, `Subject`, `Approved`, `Remark` FROM tbldepositsapplications WHERE `Client code` = ? ORDER BY `ApplicationID` DESC LIMIT $offset, $total_records_per_page";
                                                $stmt = $conn->prepare($pagination_result);
                                                $stmt->bind_param("s",$ecode);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                               while($row = $result->fetch_array()){
                                                if($row['Approved'] == 'Y'){
                                                  $status = "Approved";
                                                }elseif ($row['Approved'] == 'N') {
                                                  $status = "Pending";
                                                }elseif($row['Approved'] == 'D'){
                                                  $status = "Not Approved";
                                                }else{

                                                }
                                                ?>
                                                <tr>
                                                 <td><?php echo format_date($row['Date applied']); ?></td>
                                                 <td><?php echo format_date($row['StartDate']); ?></td>
                                                 <td><?php if(!empty($row['Date reviewed'])){echo format_date($row['Date reviewed']);} ?></td>
                                                 <td><?php echo $row['Subject']; ?></td>
                                                 <td><?php echo $status; ?></td>
                                                 <td><?php echo custom_echo($row['Remark'], 150); ?></td>
                                                 </tr> 
                                                  <?php
                                               } ?>
                                              
                                          </table> 
                                    </div>
                                    <div class="row col-md-10">
                          <?php 
                                      $result_count = "SELECT COUNT(ApplicationID) AS total_records FROM tbldepositsapplications WHERE `Client code` = ?";
                                         $stmt = $conn->prepare($result_count);
                                            $stmt->bind_param("s",$ecode);
                                              $stmt->execute();
                                                $result = $stmt->get_result();
                                                  $row = $result->fetch_assoc();
                                        ##calculate total pages with results
                                        $total_no_of_pages = ceil($row['total_records'] / $total_records_per_page);
                                        $second_last = $total_no_of_pages - 1; // total pages minus 1

                                          
                          ?>
                                
                                  <ul class="pagination">
                                    <?php if($page_no > 1){
                                    echo "<li><a href='?page_no=1'>First Page</a></li>";
                                    } ?> 
                                    <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
                                    <a <?php if($page_no > 1){
                                    echo "href='?page_no=$previous_page'";
                                    } ?> >Previous </a>
                                    </li>

                                    <?php
                                     if ($total_no_of_pages <= 10)
                                     {     
                                            for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                                            if ($counter == $page_no) {
                                            echo "<li class='active'><a>$counter</a></li>"; 
                                                    }else{
                                                  echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                          }
                                                  }
                                      }
                                     elseif ($total_no_of_pages > 10)
                                     {
                                             if($page_no <= 4) 
                                             {     
                                             for ($counter = 1; $counter < 8; $counter++){     
                                              if ($counter == $page_no) {
                                                 echo "<li class='active'><a>$counter</a></li>";  
                                                }else{
                                                       echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                            }
                                            }
                                            echo "<li><a>...</a></li>";
                                            echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                            echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                            }
                                            elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) 
                                            {    
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
                                                    }else{
                                                          echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                            }                  
                                                         }
                                                  echo "<li><a>...</a></li>";
                                                  echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                                  echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                            }
                                            else {
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
                                                    }else{
                                                          echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                    }                   
                                                       }
                                                  }
                                            
                                     }                                     
                                     
                                    ?>

                                        
                                    <li <?php if($page_no >= $total_no_of_pages){
                                    echo "class='disabled'";
                                    } ?>>
                                    <a <?php if($page_no < $total_no_of_pages) {
                                    echo "href='?page_no=$next_page'";
                                    } ?>>Next</a>
                                    </li>
                                    <?php if($page_no < $total_no_of_pages){
                                    echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                                    } ?>
                                    </ul>

                        </div>
            </div> 
                     
       </div>
<?php include_once("includes/footer.php"); ?>