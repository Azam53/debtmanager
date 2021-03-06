<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dashboard">
    <title>DebtManager | Balance</title>
    <link href="<?= base_url('assets/css/styles.css');?>" rel="stylesheet">
    <script   src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
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
     <div class="header_main">
     <a href="<?php echo base_url();?>" class="logo"><h1>DebtManager</h1></a>
     <span class="logout"><a href="<?php echo base_url();?>index.php/agent/logout">Logout</a></span>
     <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;  Manage Debts </span>
     </div>
     <?php $balance = json_decode($balance);?>
     <div class="statistics">
          <center> <table border="2">
             <h2>Balance (date specific)</h2><br>
              <h3>For transaction id:<?php echo $transaction_id;?>  And  Date:<?php echo $date;?></h3>
                 
		    <tr>
		      <th>Balance</th>
		      <th>Interest Paid</th>
                      <th>Capital Paid</th>
		      
		    </tr>
		   <tbody id="balance_detail">
                    <?php
                       foreach($balance as $value){
                          echo "<tr>
                                     <td>".$value->balance."</td>
                                     <td>".$value->interest_paid."</td>
                                     <td>".$value->capital_paid."</td>
                                </tr>
                               ";
                        }
                    ?>
                   <tbody>
          </table>
         </center> 
     </div>



  </div>
<script src="<?= base_url('assets/js/index.js');?>"></script>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
</body>
</html>
