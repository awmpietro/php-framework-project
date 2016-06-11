<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Calendar Manager</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700,800' rel='stylesheet' type='text/css'/>
		<?php foreach ($css as $c) : ?>
		<link href="<?php echo $c; ?>" rel='stylesheet' type='text/css'/>
		<?php endforeach; ?>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="public/libs/html5shiv/dist/html5shiv.min.js"></script>
		<script type="text/javascript" src="public/libs/respond/dest/respond.min.js"></script>
		<![endif]-->
	</head>
	<body >
		<?php if($this->active != 'login') : ?>
		<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">C M</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="">Home</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<?php endif; ?>
		<?php echo $this->content; ?>
		<?php foreach ($js as $j) : ?>
		<script type="text/javascript" src="<?php echo $j; ?>" ></script>
		<?php endforeach; ?>
	</body>
</html>