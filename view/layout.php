<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Controle de Estoque</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700,800' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="/public/css/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="/public/css/font-awesome.css" />

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="/public/js/html5shiv.js"></script>
		<script type="text/javascript" src="/public/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body >
		<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Sistema de Controle de Estoque</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="<?php if($this->active == 'produtos'){echo 'active';} ?>"><a href="/produtos">Produtos</a></li>
						<li class="<?php if($this->active == 'clientes'){echo 'active';} ?>"><a href="/clientes">Clientes</a></li>
						<li class="<?php if($this->active == 'pedidos'){echo 'active';} ?>"><a href="/pedidos">Pedidos</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<?php echo $this->content; ?>
		<script src="/public/js/jquery.js"></script>
		<script src="/public/js/bootstrap.min.js"></script>
		<script src="/public/js/jquery.validate.js"></script>
		<script src="/public/js/bootbox.min.js"></script>
	</body>
</html>
	