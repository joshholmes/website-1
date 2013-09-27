	<div class="wrapper mini" id="content">
		<h2>Login</h2>
		<form action="<?=base_url("authentication/login");?>" method="post" class="wrapper">
			<p>
				<a href="<?=$fb_url;?>" class="social-login-butt facebook"></a>
				<a href="<?=$fb_url;?>" class="social-login-butt twitter"></a>
			</p>
			<input type="email" id="signin_email" name="signin_email" value="" placeholder="email" />
			<input type="password" id="signin_password" name="signin_password" value="" placeholder="password" />
			<input type="submit" class="butt butt-blue" value="Log In" />
		</form>
	</div>