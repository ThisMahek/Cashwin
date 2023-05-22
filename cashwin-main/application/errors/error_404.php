<!DOCTYPE HTML>
<html>
	<head>
		<title>404 page not found</title>	
		<link href="<?= site_url('assets/404/css/style.css') ?>" rel="stylesheet" type="text/css"  media="all" />		
	</head>
	<body>
		<!--start-wrap--->
		<div class="wrap">
			<!---start-header---->
				<div class="header">
					<div class="logo">
						<a class="navbar-brand" href="<?= site_url() ?>"><img src="<?= site_url('assets/images/logo.png') ?>" alt="logo"></a>
					</div>
				</div>
			<!---End-header---->
			<!--start-content------>
			<div class="content">
				<img src="<?= site_url('assets/404/images/error-img.png') ?>" title="error" />
				<p><span><label>O</label>hh.....</span>You Requested the page that is no longer There.</p>
				<a href="<?= site_url(); ?>">Back To Home</a>
				<div class="copy-right">
					
				</div>
   			</div>
			<!--End-Cotent------>
		</div>
		<!--End-wrap--->
	</body>
</html>

