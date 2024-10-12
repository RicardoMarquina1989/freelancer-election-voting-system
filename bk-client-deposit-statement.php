<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<?php if(isset($_POST['statement_preview']) && !empty($_POST['account_number'])){
  $date_from = test_input($_POST['date_from']);
  $date_to = test_input($_POST['date_to']);
  $account_number = test_input($_POST['account_number']);
  }
  global $credit_balance;
  global $debit_balance;
  global $total_balance;
  ?>
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
            <div class="col-md-9">
                        <div class="">
                          <div class="spacebar"></div>
                              
                          </div>
                        <div class="breadcrumb1">
                              <div class="bread-title">
                                  <h1>Deposits Statements</h1>
                              </div>
                        </div>
                        <div class="spacebar"></div>
                        <form method="post">
                                   <table class="accttitle" width="80%" border="1">
                                         <tr class="thbg">
                                           <th>From:</th>
                                           <th> <input type="date" class="form-control" name="date_from" value="<?php if(isset($_POST['statement_preview']) && !empty($date_from)){echo $date_from;}?>" id="subject" required="required" placeholder="Pick date"></th>
                                           <td colspan="1" style="border-right: none;"><input type="submit" name="statement_preview" value="Preview" class="btn btn-success"></td>
                                           <td colspan="1" align="right" style="border-left: none;"><input type="submit" name="" value="Export to pdf" class="btn btn-success" ></td>
                                         </tr>
                                         <tr class="thbg">
                                           <th>To:</th><th><input type="date" class="form-control" name="date_to" value="<?php if(isset($_POST['statement_preview']) && !empty($date_to)){echo $date_to;}?>" id="subject" required="required" placeholder="Pick date"></th>
                                         </tr>
                                         <tr class="thbg">
                                           <th>Account Number:</th><th><select class="form-control" name="account_number" id="mySelect" required="required">
                                                          <option><?php if(isset($_POST['statement_preview']) && !empty($account_number)){echo $account_number;}else{echo "-- Select Account --";}?> </option>
                                                          <?php 
                                                              $sqlacc = "SELECT `Account number`, `Account name`, DATE(`Date opened`) AS date_opened FROM `tbldeposits` WHERE `client code` = ?";
                                                                 $stmt = $conn->prepare($sqlacc);
                                                                  $stmt->bind_param("s",$ecode);
                                                                  $stmt->execute();
                                                                      $resultacc = $stmt->get_result();
                                                                if($resultacc->num_rows > 0){
                                                                  while ($rowacc = $resultacc->fetch_assoc()) {
                                                                    ?>
                                                                    <option value="<?php echo $rowacc['Account number']; ?>"><?php echo $rowacc['Account name'] . " " .$rowacc['Account number'] ." ". $rowacc['date_opened'] ; ?></option>
                                                                    <?php
                                                                  }
                                                                }
                                                                 ?>                                       
                                                      </select> </th>
                                         </tr> 
                                                                
                                  </table>
                        </form>         
                                        <div class="spacebar"></div>

                                         <table class="table table-hover">
                                               <tr class="thbg">
                                                 <th>Date</th>
                                                 <th>Reference</th>
                                                 <th>Type</th>
                                                 <th>Tran. No</th>
                                                 <th>Details</th>
                                                 <th>Debit</th>
                                                 <th>Credit</th>
                                                 <th>Balance</th>
                                               </tr>
                                                <tr>
                                                 <td><strong>Opening Balance:</strong></td>
                                                 <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                 <td><strong><?php if(isset($_POST['statement_preview']) && !empty($debit_balance)){echo num_format($debit_balance);}?></strong></td>
                                                 <td><strong><?php if(isset($_POST['statement_preview']) && !empty($credit_balance)){echo num_format($credit_balance);}?></strong></td>
                                                 <td><strong><?php if(isset($_POST['statement_preview']) && !empty($total_balance)){echo num_format($total_balance);}?></strong></td>
                                                 </tr> 
                                              
                                               <?php 
                                               if(isset($_POST['statement_preview'])){
                                                $sql = "SELECT x.RowID ,x.`Account number`,x.`Client code`, `x`.`Reference date`, `x`.`Reference number`, `x`.`TransType`, `x`.`Transaction number`, `x`.`Details`, x.Debit , x.Credit, SUM(y.bal) Balance FROM ( SELECT *,Credit-Debit bal FROM tbldepositsactivities ) x JOIN ( SELECT *,Credit-Debit bal FROM tbldepositsactivities ) y ON y.RowID <= x.RowID WHERE `x`.`Account number` = ? AND `x`.`Client code` = ? AND x.`Reference date` BETWEEN ? AND ? GROUP BY x.`Reference date` ASC ";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("ssss",$account_number,$ecode,$date_from,$date_to);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                $credit_balance = 0;
                                                $debit_balance = 0;
                                               while($row = $result->fetch_array()){
                                                $credit_balance += $row['Credit'];
                                                $debit_balance += $row['Debit'];
                                                $total_balance = $credit_balance - $debit_balance;
                                                ?>
                                                <tr>
                                                 <td><?php echo format_date($row['Reference date']); ?></td>
                                                 <td><?php echo $row['Reference number']; ?></td>
                                                 <td><?php echo $row['TransType']; ?></td>
                                                 <td><?php echo $row['Transaction number']; ?></td>
                                                 <td><?php echo $row['Details']; ?></td>
                                                 <td><?php echo num_format($row['Debit']); ?></td>
                                                 <td><?php echo num_format($row['Credit']); ?></td>
                                                 <td><?php echo num_format($row['Balance']); ?></td>
                                                 </tr> 
                                                  <?php
                                               } 
                                             }?>
                                             <tr>
                                                 <td><strong>Overall Net Balance:</strong></td>
                                                 <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                 <td><strong><?php if(isset($_POST['statement_preview']) && !empty($debit_balance)){echo num_format($debit_balance);}?></strong></td>
                                                 <td><strong><?php if(isset($_POST['statement_preview']) && !empty($credit_balance)){echo num_format($credit_balance);}?></strong></td>
                                                 <td><strong><?php if(isset($_POST['statement_preview']) && !empty($total_balance)){echo num_format($total_balance);}?></strong></td>
                                                 </tr> 
                                              
                                          </table>
            </div> 
       </div>
<?php include_once("includes/footer.php"); ?>