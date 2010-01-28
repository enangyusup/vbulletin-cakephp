<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<meta http-equiv="Content-Style-Type" content="text/css" />

<title>Free Website Templates :: <?= $title_for_layout ?></title>

<?= $html->css('style') ?>

</head>

<body>

<div id="container">

	<div id="body_image">&nbsp;</div>


	<!-- Start of Page Header -->

	<div id="page_header">
		<h1><span>Game Zone</span></h1>
		<h3><span>Welcome to Game Zone</span></h3>

		<div class="clearthis">&nbsp;</div>
	</div>

	<!-- End of Page Header -->


	<!-- Start of Page Menu -->

	<div id="page_menu">

		<ul>
		<li class="online"><a href="<?=$html->url()?>" title="Online"><span>Online</span></a><span></span></li>
		<li class="downloads"><a href="#" title="Downloads"><span>Downloads</span></a><span></span></li>
		<li class="community"><a href="#" title="Community"><span>Community</span></a><span></span></li>
		<li class="about"><a href="#" title="About"><span>About Zone</span></a><span></span></li>
		</ul>

	</div>

	<!-- End of Page Menu -->


	<div id="page_forms">

		<!-- Start of User Login -->
		<?=$this->element('form_login')?>
		<!-- End of User Login -->


		<!-- Start of Site Search -->

		<div id="sitesearch_header">
		<h2><span>Site Search</span></h2>
		</div>

		<div id="sitesearch">

			<form action="#">

			<div>
			<input type="text" />
			<input type="image" src="images/sitesearch_button.gif" alt="Go" class="button" />
			</div>

			<div class="clearthis">&nbsp;</div>

			</form>

		</div>

		<!-- End of Site Search -->

	</div>


	<div id="content_body">
		<?= $content_for_layout ?>
	</div>


	<div id="clearthis_contentbody">&nbsp;</div>
</div>

<!-- Start of Page Footer -->

<div id="page_footer">
Copyright <a href="http://www.freewebsitetemplates.com">www.yoursite.com</a> | <a href="#termsofuse/">Terms of use</a>
</div>

<!-- End of Page Footer -->


</body>
</html>