<!DOCTYPE html>
<html lang="en">

<head>
    <title>online Music</title><meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo site_url();?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo site_url();?>assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo site_url();?>assets/css/matrix-login.css" />
    <link href="<?php echo site_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="loginbox">            
        <form id="loginform" class="form-vertical" method="post" action="">
           <div class="control-group normal_text"> <h3>Admin Demo Login</h3></div>
           <?php if(!empty($Error)) {?>
           <center><p class="text-center error btn btn-danger" id="errorMessage"><?php echo $Error; ?>               
           </p>
           </center>
           <?php } ?>  
           <?php if(!empty($Success)) {?>
           <center>
           <p class="login-box-msg success btn btn-success" id="verifyMessage"><?php echo $Success; ?></p></center>
           <?php } ?>  
           <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                    <input type="text" placeholder="Username" name="username"  required>
                    <?php echo form_error('username','<div class="error btn btn-danger">', '</div>');?>
                </div>
            </div>
           </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="password"  required>
                <?php echo form_error('password','<div class="error btn btn-danger">', '</div>'); ?>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
            <span class="pull-right">
                <button type="submit" class="btn btn-success"> Login</button>
            </span>
        </div>
       </form>
    <form id="recoverform" action="#" class="form-vertical">
        <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
        <div class="controls">
            <div class="main_input_box">
                <span class="add-on bg_lo"><i class="icon-envelope"></i>
                </span><input type="text" placeholder="E-mail address">
            </div>
        </div>

        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
            <span class="pull-right"><a class="btn btn-info">Reecover</a></span>
        </div>
    </form>
</div>
<script src="<?php echo site_url();?>assets/js/jquery.min.js"></script>  
<script src="<?php echo site_url();?>assets/js/matrix.login.js"></script> 
</body>
</html>