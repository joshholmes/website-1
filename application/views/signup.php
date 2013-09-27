	<div class="wrapper mini" id="content">
		<h2>Sign Up</h2>
		<p>
			<?php if (!$fb_auth): ?>
				It's free and anyone can join.
			<?php else: ?>
				Just a few more steps to completing your registration through Facebook, <strong><?=$fb_user["name"]?></strong>.
			<?php endif; ?>
		</p>

		<?php echo validation_errors('<p class="error">'); ?>

		<form method="post" class="vertical-form">
<?php if (!$fb_auth): ?>
			<p>
				<a href="<?=$fb_url;?>" class="social-login-butt facebook"></a>
				<a href="<?=$fb_url;?>" class="social-login-butt twitter"></a>
			</p>

			<input type="text" id="firstname" name="firstname" value="<?=set_value('firstname'); ?>" placeholder="first name" />
			<input type="text" id="lastname" name="lastname" value="<?=set_value('lastname'); ?>" placeholder="last name" />
			<input type="email" id="email" name="email" value="<?=set_value('email'); ?>" placeholder="email" />
<?php else: ?>
			<input type="hidden" id="firstname" name="firstname" value="<?=$fb_user["first_name"];?>" />
			<input type="hidden" id="lastname" name="lastname" value="<?=$fb_user["last_name"];?>" />
			<input type="hidden" id="email" name="email" value="<?=$fb_user["email"];?>" />
			<input type="hidden" value="<?=$fb_user["id"];?>" name="fb_user" />
<?php endif; ?>

			<input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" autocomplete="off" placeholder="username" />

			<input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" autocomplete="off" placeholder="password" />
			<input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" autocomplete="off" placeholder="confirm password" />

			<input type="submit" class="butt butt-blue" value="Submit" />
		</form>
	</div>

<script type="text/javascript">
	$(document).ready(function()
	{
		$("#password").change(function()
		{
			$(this).removeClass();
			
			if ($(this).val().length >= 6)
				$(this).addClass("valid");
			else
				$(this).addClass("invalid");
		});
		
		$("#con_password").change(function()
		{
			var pass = $("#password").val();
			var con = $(this).val();
			
			$(this).removeClass();
			
			if (pass === con)
				$(this).addClass("valid");
			else
				$(this).addClass("invalid");
		});
		
		$("#username").change(function()
		{
			var $that = $(this);
			$that.removeClass();
			
			if($that.val().length >= 4)
			{
				$.ajax({
					type: "post",
					url: "validate_user",
					data: { username: $that.val() },
					success: function(msg)
					{
						if (msg)
							$that.addClass("valid");
						else
							$that.addClass("invalid");
					}
				});
			}
			else
				$that.addClass("invalid");
		});
		
		$("#email").change(function()
		{
			var $that = $(this);
			$that.removeClass();
			
			if($that.val().length >= 4)
			{
				$.ajax({
					type: "post",
					url: "validate_email",
					data: { email: $that.val() },
					success: function(msg)
					{
						if (msg)
							$that.addClass("valid");
						else
							$that.addClass("invalid");
					}
				});
			}
			else
				$that.addClass("invalid");
		});

	});
</script>