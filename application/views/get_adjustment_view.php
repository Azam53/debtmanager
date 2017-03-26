<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dashboard">
    <title>DebtManager | Get Balance</title>
    <link href="<?= base_url('assets/css/styles.css');?>" rel="stylesheet">
    
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="<?= base_url('assets/js/index.js');?>"></script>
  
</head>

<body>
<?php
// Turn off all error reporting
error_reporting(0);
?>

 <?php $adjustment = json_decode($adjustment);?>
<div class="container">
      <div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	  <a href="<?php echo base_url ('index.php/agent/adddebts'); ?>">Add Debt Record</a>
	  <a href="<?php echo base_url ('index.php/agent/addpayment'); ?>">Add Payment</a>
	  <a href="<?php echo base_url ('index.php/agent/getbalance'); ?>">Get Debt Balance(date specific) </a>
	  <a href="<?php echo base_url ('index.php/agent/getadjustment'); ?>">Debt Row Adjustments</a>
          
     </div>
     <div class="header">
      <a href="<?php echo base_url();?>" class="logo"><h1>DebtManager</h1></a>
      <span class="logout"><a href="<?php echo base_url();?>index.php/agent/logout">Logout</a></span>
     <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;  Manage Debts </span>
     </div>
         <div class="statistics">
          <center> <table border="2">
             <h2>Debt Row Adjusted</h2><br>
                               
		    <tr>
		      <th>Transaction No</th>
		      <th>Customer No</th>
                      <th>Balance</th>
                      <th>Capital Paid</th>
                      <th>Interest Paid</th>
                      <th>Penalty</th>
                      <th>Payment Month</th>
		      
		    </tr>
		   <tbody id="balance_detail">
                    <?php
                       foreach($adjustment as $value){
                          echo "<tr>
                                     <td>".$value[0]->loan_transaction_no."</td>
                                     <td>".$value[0]->customer_id."</td>
                                     <td>".$value[0]->balance."</td>
                                     <td>".$value[0]->capital_paid."</td>
                                     <td>".$value[0]->interest_paid."</td>
                                     <td>".$value[0]->penalty."</td>
                                     <td>".$value[0]->payment_month."</td>
                                </tr>
                               ";
                        }
                    ?>
                   <tbody>
          </table>
         </center> 
     </div>
         
</div>
  
   

</body>
</html>
