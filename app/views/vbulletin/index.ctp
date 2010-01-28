<div class="post">
	<div class="title">
		<h2>Welcome <?=$username?></h2>
		<p><small>Posted on August 20th, 2007 by <a href="#">Free CSS Templates</a></small></p>
	</div>
	<div class="entry">

		<div><a class="avatar" href="<?=@$profileurl?>"><img src="<?=@$avatarimg?>" width="100" title="Ieu fotona <?=$username?>" /></a></div>
		<div style="clear: both;"></div>
		<div class="anu">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr><td><a href="<?=@$furl?>private.php"><?=$pmunread?></a></td></tr>
				<tr><td><a href="<?=@$furl?>profile.php?do=editprofile">Edit Profile</a></td></tr>
				<tr><td><a href="<?=@$furl?>search.php?do=getdaily">Today's Posts</a></td></tr>
			</table>
		</div>
		<div align="right" style="margin-top:-5px; padding-right: 15px;"><a href="<?= $furl.'login.php?do=logout&logouthash='.$logouthash ?>">Logout</a></div>
	</div>
</div>
