  <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Docket mates | Change Password Confirm</title>
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
    <!-- Tell the browser to be responsive to screen width -->
      <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
     <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    .modal-dialog{
      margin: 160px auto;
      }</style>
    </head> <body class="hold-transition login-page">  <div class="login-box"><?php if(!empty($Error)) { 
    $title = "Error";
    $message = $Error;
  }else{
    $title = "Success";
    $message = $Success;
    }?>
 <style type="text/css">
.confirm {
  max-width: 600px;
  margin: 0 auto;
  margin-top: 70px;
  margin-bottom: 70px;
}
.confirm .panel-default {
  border-color: #4FD5D6;
  border-radius: 0px;
  padding-bottom: 0px;
}

.confirm .panel-default > .panel-heading {
  color: #fff;
  background-color: #4FD5D6;
  border-color: #4FD5D6;
  border-radius: 0px;
  font-size: 22px;
}
.login-box{
    width:700px;
  
  }
  .login-box-body, .register-box-body{
      background: none;
  }
  </style>  
  <div class="register-page-main ms-forgot-password"> 
   <div class="login-box">
       <div class="login-box-body">
            <div class="confirm">
          <div class="panel panel-default">
            <div class="panel-heading"><?php echo $title;?></div>
            <div class="panel-body">
            <p class="message"><?php echo $message;?></p>
  
           </div>
          </div>

        </div>
            </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->


     

</div>      


<?php
echo script_tag('assets/plugins/jQuery/jQuery-2.1.4.min.js');
echo script_tag('assets/bootstrap/js/bootstrap.min.js');
echo script_tag('assets/plugins/iCheck/icheck.min.js');
echo script_tag('assets/dist/js/table-search.js');

?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>

