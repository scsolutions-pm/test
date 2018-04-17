<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Good Music | Forgot Password</title>
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
    </head> <body class="hold-transition login-page">  <div class="login-box">
     <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">You can reset your password here</p>
        <form method="post" name="forgotform" class="form-login" id="forgotform">
   
          <div class="form-group has-feedback">
            <input type="email" name="email" id="email"  class="form-control" placeholder="Enter Your Email" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <?php echo form_error('email','<div class="error">', '</div>'); ?>
          </div>
    
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" id="forgetsubmit"  class="btn btn-primary btn-block btn-flat">Submit</button>
            </div><!-- /.col -->
          </div>
        </form>
          <button class="new-btn" id="my-btn" data-toggle="modal" data-target="#myModal" style="display:none;"></button>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->


  <div class="modal fade" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">We are sorry, we are not find this email in our system.</h4>
      </div>
        <div class="modal-footer">
        <div class="col-lg-3" style="margin-left:-14px">
        <button type="button" class="btn btn-primary btn-block btn-flat pull-right" data-dismiss="modal">Go Back</button>
        </div>
      </div>
    </div>
  </div>
</div>


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
          $(document).ready(function(e) {       
        $('#forgetsubmit').click( function(event) {
            event.preventDefault();
            var email = $("#email").val();
            var link_url='<?php echo site_url();?>home/CheckEmail';
            
            $.ajax({
                    url: link_url,
                    type:"POST",
                    data:({email:email}),
                    success: function(data){
                        
                        if(data == 3){
                            alert('Please enter a valid email id.');
                        }else if(data == 0){
                            $("#my-btn").trigger("click");  
                        }else{
                             window.location.href = '<?php echo site_url();?>admin';
                        }           
                }
            });
           
            return false;       
        }); 
    });
    </script>

