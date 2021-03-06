<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dashboard">
    <title>DebtManager | Add Debt Record</title>
    <link href="<?= base_url('assets/css/styles.css');?>" rel="stylesheet">

  
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
         <div class="login-page">
  <div class="form">
    <form class="login-form" action="<?php echo base_url ('index.php/agent/insert_debt'); ?>" method="POST">
      <h3> Add Debt Record </h3>
      <label for="customer_name" class="label">Customer Name:</label>
      <input type="text" placeholder="customer name" name="customer_name" />
      <label for="email" class="label">Email:</label>
      <input type="text" placeholder="email" name="email" />
      <label for="loan_amount" class="label">Loan Amount:</label>
      <input type="number" placeholder="loan amount"name ="loan_amount"/>
      <label for="roi" class="label">Rate of Interest:</label>
      <input type="text" placeholder="interestrate"name ="roi"/>
      <label for="years" class="label">Terms in month:</label>
      <input type="number" placeholder="no of months"name ="years"/>
      <label for="address" class="label">Address of Customer:</label>
      <textarea placeholder="address" class="text_area" name="address" ></textarea>
      <button>ADD</button>
      
    </form>
  </div>
</div>



  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="<?= base_url('assets/js/index.js');?>"></script>

</body>
</html>
