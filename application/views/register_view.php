<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Online Chatroom Login</title>

	<!-- Bootstrap -->
<!-- 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="<?=site_url('assets/css/bootstrap.min.css')?>">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->


    <style type="text/css">
    	.form-register {
    		max-width: 400px;
  			padding: 15px;
  			margin: 0 auto;	
    	}

      #captcha_img:hover{
        cursor: hand;
      }
    </style>
  </head>
  <body>


  	<!-- main body -->

  	<div class="container">  				  

  				<!-- validation error message -->
          <?php echo validation_errors(
              '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>ERROR! </strong>',
              '</div>'); ?>

  				<!-- <?php echo form_open('register/verify_register'); ?> -->
  				<form role="form" action="<?php echo site_url('register/verify_register');?>" method="post" class="form-register">

  				  <h2>Create account</h2>
  					
 					  <div class="form-group">
  						<input type="text" class="form-control" name="username" maxlength="20" placeholder="Username" value="<?php if(!form_error('username'))echo set_value('username'); ?>" required >
  					</div>

  					<div class="form-group">
  						<input type="email" class="form-control" name="email" maxlength="30" placeholder="Email" value="<?php if(!form_error('email'))echo set_value('email'); ?>" required>
  					</div>

  					<div class="form-group">
  						<input type="password" class="form-control" name="password" maxlength="20" placeholder="New Password (at least 6 characters)" required>
            </div>

            <div class="form-group">
              <input type="password" class="form-control" name="password-confirm" maxlength="20" placeholder="Confirm Password" required>
            </div>


            <div class="row">
              <div class="col-sm-8">
                <div class="form-group">
                  <input type="text" class="form-control" name="captcha" maxlength="10" placeholder="Type the code shown" required>
                 </div>
              </div>
              <div class="col-sm-4">
                <!-- captcha image -->
                <div id="captcha_img" data-toggle="tooltip" data-placement="bottom" title="Click to refresh">
                  <?php echo $cap; ?>
                </div>
                
              </div>
            </div>
            

            <hr>
		    		<div class="form-group">
    					<button type="submit" class="btn btn-primary btn-block">Register</button>
  					</div>

            <p><a href="<?php echo site_url('login');?>"> Already have an account? Click here to login!</a></p>


  				</form>


  	</div>

  	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<!-- Include all compiled plugins (below), or include individual files as needed -->
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $(function(){
          var base_url = '<?php echo base_url(); ?>';
          $('#captcha_img').click(function(event){
              event.preventDefault();
              $.ajax({
                 url:base_url+'register/reload_captcha',
                 success:function(data){
                    // $('#captcha_img').attr('src', data);
                    $('#captcha_img').html(data);
                    //console.log("captcha refreshed");
                 }
              });            
          });
      });
      // enable tooltip
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    </script>    
  </body>
  </html>