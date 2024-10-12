<?php require_once("includes/session.php");?>
<?php require_once("includes/constants.php");?>
<?php require_once("includes/connections.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in();?>
<!DOCTYPE html>
<html lang="en">
  <?php include_once("includes/head.php"); ?>
 <body style="">
            <div class="col-md-8 col-md-offset-2">
                  <div class="breadcrumb1">
                      <div class="bread-title">
                          <h1>Pay Slip</h1>
                      </div>
                  </div>
                  <div class="spacebar"> </div>
<?php 
if(isset($_GET['empid']) && (!empty($_GET['empid']))){$empid = intval($_GET['empid']);}
if(isset($_GET['dt']) && (!empty($_GET['dt']))){$dt = strval(urldecode($_GET['dt']));}
  $sql = "SELECT e.`EmployeeID`,e.`Employee code`,e.`Surname`,e.`First name`,e.`Middle name`,p.`EmployeeID`,p.`Department code`,p.`Location code`,p.`Run`,p.`Position code`,p.`Paymode code`,p.`Grade code` FROM tblpayroll p LEFT JOIN tblemployees e ON e.`EmployeeID`=p.`EmployeeID` WHERE p.`Date` = '$dt' AND p.`EmployeeID`=$empid";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
?>
<?php 
if(isset($_GET['empid']) && (!empty($_GET['empid']))){$empid = intval($_GET['empid']);}
if(isset($_GET['dt']) && (!empty($_GET['dt']))){$dt = strval(urldecode($_GET['dt']));}
  $sql2 = "SELECT pr.`Date`, pr.`EmployeeID`, pa.`Allowance amount`  FROM tblpayroll pr JOIN tblpayrollallowances pa ON pr.`EmployeeID`=pa.`EmployeeID` WHERE pr.`Date` = '$dt' AND pr.`EmployeeID`=$empid";
  $result2 = $conn->query($sql2);
  for ($set = array (); $row2 = $result2->fetch_assoc(); $set[] = $row2);
  #$row2 = $result2->fetch_assoc();
  #echo "<pre>";
  #print_r($set);
  #echo "</pre>";
?>
                   <div class="row" style="font-style: 10;">
                              <div class="col-sm-5">
                                <table border="" class="table table-bordered" style="font-size: 10px;">
                                  <tr class="">
                                   <th>EMP. CODE:</th>
                                   <td><?php echo $row['Employee code']; ?></td>
                                 </tr>
                                 <tr class="">
                                   <th>EMP. NAME:</th>
                                   <td><?php echo $row['First name'] ." ". $row['Middle name'] ." ". $row['Surname']; ?></td>
                                 </tr>
                                 <tr class="">
                                   <th>DEPARTMENT:</th>
                                   <td><?php echo $row['Department code']; ?></td>
                                 </tr>
                                 <tr class="">
                                   <th>LOCATION:</th>
                                   <td><?php echo $row['Location code']; ?></td>
                                 </tr>
                               </table>
                              </div>
                              <div class="col-sm-7 form-group">
                                <table border="" class="table table-bordered" style="font-size: 10px;">
                                  <tr class="">
                                   <th>PAYMODE:</th>
                                   <td colspan="3"><?php echo $row['Paymode code']; ?></td>
                                 </tr>
                                 <tr class="">
                                   <th>GRADE:</th>
                                   <td><?php echo $row['Grade code']; ?></td>
                                   <th>STEP:</th>
                                   <td><?php echo $row['Run']; ?></td>
                                 </tr>
                                 <tr class="">
                                   <th>CATEGORY:</th>
                                   <td colspan="3">&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <th>POSITION:</th>
                                   <td colspan="3"><?php echo $row['Position code']; ?></td>
                                 </tr>
                               </table>
                              </div>
                     </div>
                     <div class="row">
                              <div class="col-sm-5">
                                <table border="" class="table table-bordered" style="font-size: 10px;">
                                  <tr class="">
                                   <th>ALLOWANCES/EARNINGS:</th>
                                   <th>NGN</th>
                                 </tr>
                                 <tr class="">
                                   <td>Basic</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td>Housing</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td>Transport</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td>Telephone</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td style="border-right: none;">&nbsp;</td>
                                   <td style="border-left: none;">&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td style="border-right: none;">&nbsp;</td>
                                   <td style="border-left: none;">&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td style="border-right: none;">&nbsp;</td>
                                   <td style="border-left: none;">&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <th>GROSS SALARY</th>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <th>REMARK</th>
                                   <td>&nbsp;</td>
                                 </tr>
                               </table>
                              </div>
                              <div class="col-sm-5">
                                <table border="" class="table table-bordered" style="font-size: 10px;">
                                  <tr class="">
                                   <th>DEDUCTIONS:</th>
                                   <th>NGN</th>
                                 </tr>
                                 <tr class="">
                                   <td>PAYE</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td>Pension-employees</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td>NHF deduction</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td>NSITF provision</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td>ITF provision</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td>Group Life provision</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td>Medic provision</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                  <tr class="">
                                   <th>TOTAL DEDUCTIONS</th>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <th>NET SALARY</th>
                                   <td>&nbsp;</td>
                                 </tr>
                               </table>
                              </div>
                              <div class="col-sm-2">
                                <table border="" class="table table-bordered" style="font-size: 10px;">
                                  <tr class="">
                                   <th>YTD OR O/S BAL.</th>
                                 </tr>
                                 <tr class="">
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr class="">
                                   <td>&nbsp;</td>
                                 </tr>
                               </table>
                              </div>
                     </div>
          <button type="button" class="btn btn-success">PRINT</button> 
          <a href="employee-payslips.php" class="btn btn-success" style="float: right;">BACK</a>     

          </div>
  <?php include_once("includes/footer.php"); ?>