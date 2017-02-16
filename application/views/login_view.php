<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Online Chatroom Login</title>

	<!-- Bootstrap -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="<?=site_url('assets/css/bootstrap.min.css')?>">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <style type="text/css">
      .form-login {
        /*border: 1px solid #B5B5B5;*/        
        max-width: 400px;
        padding: 15px;
        margin: 0 auto;
      }
      </style>
    </head>
    <body>


     <!-- main body -->

     <div class="container">  		

      
      <?php
        $msg_popup = $this->session->flashdata('msg_popup');
        if ($msg_popup) {
          echo '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
          echo $msg_popup;
          echo '</div>';
        }
      ?>
      
      
      <?php echo validation_errors(
      '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>ERROR! </strong>',
      '</div>'); ?>

      <!-- <?php echo form_open('verify_login'); ?> -->

      <form role="form" action="<?php echo site_url('login/verify_login');?>" method="post" class="form-login">
        

        <h2>Login</h2>
        
        <div class="form-group">
          <input type="text" class="form-control" name="username" id="username" maxlength="20" placeholder="Username" required>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="password" id="password" maxlength="20" placeholder="Password" required>
        </div>
        

        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </div>

        <p><a href="<?php echo site_url('register');?>"> Don't have an account? Click here to register!</a></p>
        
      </form>

    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
  </html>