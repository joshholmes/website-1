<div id="content">
<div class="signup_wrap">
<div class="signin_form">
 <?php echo form_open("home/login"); ?>
  <label for="email">Email:</label>
  <input type="text" id="email" name="email" value="" />
  <label for="password">Password:</label>
  <input type="password" id="password" name="password" value="" />
  <input type="submit" class="" value="Sign in" />
 <?php echo form_close(); ?>
</div><!--<div class="signin_form">-->
</div><!--<div class="signup_wrap">-->
<div class="reg_form">
<div class="form_title">Sign Up</div>
<div class="form_sub_title">It's free and anyone can join</div>
 <?php echo validation_errors('<p class="error">'); ?>
 <?php echo form_open("home/registration"); ?>
  <p>
  <label for="firstname">First Name:</label>
  <input type="text" id="firstname" name="firstname" value="<?php echo set_value('firstname'); ?>" />
  </p>
  <p>
  <label for="lastname">Last Name:</label>
  <input type="text" id="lastname" name="lastname" value="<?php echo set_value('lastname'); ?>" />
  </p>
  <p>
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" />
  </p>
  <p>
  <label for="email">Email:</label>
  <input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" />
  </p>
  <p>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
  </p>
  <p>
  <label for="con_password">Confirm Password:</label>
  <input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" />
  </p>
  <p>
  <input type="submit" class="greenButton" value="Submit" />
  </p>
 <?php echo form_close(); ?>
</div>
</div>