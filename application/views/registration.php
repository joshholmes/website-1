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
		</div>
	</div>
	<div class="reg_form">
		<div class="form_title">
			Sign Up
		</div>
		<div class="form_sub_title">
			It's free and anyone can join
		</div>
		<?php echo validation_errors('<p class="error">'); ?>
		<?php echo form_open("home/registration"); ?>
		<p>
			<label for="firstname">First Name:</label>
			<input type="text" id="firstname" name="firstname" value="<?php echo set_value('firstname'); ?>" />
			<span id="fn_validation" class="validate"></span>
		</p>
		<p>
			<label for="lastname">Last Name:</label>
			<input type="text" id="lastname" name="lastname" value="<?php echo set_value('lastname'); ?>" />
			<span id="ln_validation" class="validate"></span>
		</p>
		<p>
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" />
			<span id="un_validation" class="validate"></span>
		</p>
		<p>
			<label for="email">Email:</label>
			<input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" />
			<span id="e_validation" class="validate"></span>
		</p>
		<p>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
			<span id="p_validation" class="validate"></span>
		</p>
		<p>
			<label for="con_password">Confirm Password:</label>
			<input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" />
			<span id="cp_validation" class="validate"></span>
		</p>
		<p>
			<input type="submit" class="greenButton" value="Submit" />
		</p>
		<?php echo form_close();
		?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#username").keyup(function() {
			if($("#username").val().length >= 4)
			{
				$.ajax({
					type: "post",
					url: "<?php echo base_url('home/validate_user'); ?>",
					data: "usnermae=" + $("#username").val(),
					success: function(msg) {
						if(msg == "true")
						{
							$("#un_validation").css({"background-image": "url('<?php echo base_url('static/images/check_icon.png'); ?>')"});
						}
						else
						{
							$("#un_validation").css({"background-image": "url('<?php echo base_url('static/images/x_icon.png'); ?>')"});
						}
					}
				});
			}
			else
			{
				$("#un_validation").css({"background-image": "none"});
			}
		});
	})	;
</script>
