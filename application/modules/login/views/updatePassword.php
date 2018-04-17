<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Shailendra Rathore">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.png">

    <title><?php echo $title;?></title>
 

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url();?>assets/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">

      <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading">Change Your Password?</h2>
        <div class="login-wrap">
        <?php echo validation_errors('<div class="error btn btn-danger">', '</div>'); ?>
            <input type="password" class="form-control" name="password" placeholder="Password">
            <input type="password" class="form-control" name="cpassword" placeholder="Re-type Password" required="">
            <button class="btn btn-lg btn-login btn-block" type="submit">Submit</button>

        </div>

      </form>

    </div>
    <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
          $('.error').delay(7000).fadeOut('slow');
    </script>

  </body>
</html>
