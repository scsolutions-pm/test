<form method="post" name="changeform" class="form-login">
  <h2 class="form-login-heading">Change Password</h2>
  <div class="login-wrap">
  <?php echo form_error('password','<div class="error">', '</div>'); ?>
  <input type="password" value="<?php echo $this->input->post('password');?>" name="password" placeholder="Current Password" class="form-control">
  <br/>
    <?php echo form_error('newpassword1','<div class="error">', '</div>'); ?>
  <input type="password" value="<?php echo $this->input->post('newpassword1');?>" name="newpassword1" placeholder="New Password" class="form-control">
  <br/>
    <?php echo form_error('newpassword2','<div class="error">', '</div>'); ?>
  <input type="password" value="<?php echo $this->input->post('newpassword2');?>" name="newpassword2" placeholder="Confirm Password" class="form-control">
  <br/>
  <input type="submit" name="submit" value="Change Password" class="btn btn-theme btn-block">
</form>
