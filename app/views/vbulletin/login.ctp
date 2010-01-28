<div class="post">
	<div class="title">
		<h2>Welcome Guest</h2>
		<p><small>Posted on August 20th, 2007 by <a href="#">Free CSS Templates</a></small></p>
	</div>
	<div class="entry">
	
		<form action="<?= $furl ?>login.php?do=login" method="post" id="loginForm">
			<input type="hidden" name="do" value="login" />
			<input type="hidden" name="url" value="<?= $this->here ?>" />
			<input type="hidden" name="vb_login_md5password" />
			<input type="hidden" name="vb_login_md5password_utf" />
			<input type="hidden" name="s" value="<?= $sessionhash; ?>" />
			<input type="hidden" name="cookieuser" value="1" id="cb_cookieuser" />
			
			<input name="vb_login_username" value="Username" type="text" id="login" class="inptext" onfocus="this.value=''" /><br/>
			<input name="vb_login_password" value="" type="password" id="login_password" class="inptext" onfocus="this.value=''" /><br/>
			
			<p><input type="submit" value="LOGIN" class="inplogin" /></p>
			<div class="btn">
				<a href="<?=$furl?>login.php?do=lostpw">Lupa password?</a><br/>
				<a href="<?=$furl?>register.php?s=<?=$sessionhash?>">SIGN UP</a>
			</div>
		</form>
	</div>
</div>