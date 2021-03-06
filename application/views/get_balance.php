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
         <div class="login-page" id="login">
		  <div class="form">
			    <form class="login-form" action="<?php echo base_url ('index.php/agent/get_balance'); ?>" method="POST">
			      <h3> Get Balance (date specific) </h3>
			       <label for="transaction_id" class="label">Transaction id:</label>
			      <select class="select" id="transaction_select" name="transaction_id" onchange="get_date()"></select>
			      <label for="date" class="label">Date:</label>
			      <select class="select" id="date_select" name="date"></select>
			      
			      <button>Done</button>
			      
			    </form>
		  </div>
         </div>
         <div id="balance_layout ">
         </div>
</div>
  
   

</body>
</html>
