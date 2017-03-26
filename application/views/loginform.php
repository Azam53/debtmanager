<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>DebtManager | Login</title>
  
  
  
      <link href="<?= base_url('assets/css/styles.css');?>" rel="stylesheet">

  
</head>

<body>
  <div class="login-page">
  <div class="form">
    <form class="login-form" action="<?php echo base_url ('index.php/agent/logincheck'); ?>" method="POST">
      <input type="text" placeholder="username" name="user_name" />
      <input type="password" placeholder="password"name ="password"/>
      <button>login</button>
      
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="<?= base_url('assets/js/index.js');?>"></script>

</body>
</html>
