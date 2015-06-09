<?php

	require_once 'functions/user/init.php';

	// !$username = Input::get('user')
	if (!$_SESSION['logged']) {
		Redirect::to("home.php");
	}
	else 
	{
		$user = new User($_SESSION['username']);
		if (!$user->exists())
		{
			Redirect::to(404);
		}
		else 
		{
			$data = $user->getData();
		}
		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">		
			<title><?php echo escape($data->username) ?> - HackTUES</title>
			<link href='dependencies/fonts/open-sans.css' rel='stylesheet' type='text/css'>
			<link href='dependencies/fonts/raleway.css' rel='stylesheet' type='text/css'>	
			<link rel="stylesheet" href="dependencies/bootstrap-3.3.4-dist/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="assets/css/main.css">		
			<script type="text/javascript" src="dependencies/jquery-1.11.3.min.js"></script>
		</head>
		<body>
			<div class="container">
				<header>		
					<div class="row">					
						<div class="col-sm-12">
							<a href="home"><h1>Hack<span class="blue">TUES</span></h1></a>
						</div>
					</div>
					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
				            		<span class="sr-only">Toggle navigation</span>
				            		<span class="icon-bar"></span>
				            		<span class="icon-bar"></span>
				            		<span class="icon-bar"></span>
				          		</button>
							</div>
							<div id="navbar" class="collapse navbar-collapse">
								<ul class="nav navbar-nav">
									<li><a href="home">Начало</a></li>
									<li><a href="teams">Отбори</a></li>
									<li><a href="prizes">Награди<span class="sr-only">(current)</span></a></li>
									<li><a href="rules">Регламент</a></li>
									<li><a href="faq">FAQ</a></li>
		                            <?php 
		                                if ($user->isLoggedIn())
		                                {
		                            ?>
		                                <li class="active"><a href="profile">Профил</a></li>
		                                <!-- <a href="/<?php echo escape($user->getData()->username); ?>"> -->
		                                <li><a href="logout.php">Излез</a></li>
		                            <?php
		                                }
		                            ?>  							
								</ul>
							</div>
						</div>
					</nav>
				</header>
				<hr />
				<div class="jumbotron">
					<h3><?php echo escape($data->firstname) . ' ' . escape($data->lastname) . ' (' . escape($data->username) . ')'?></h3>
					<h4><?php echo escape($user->fetchUserIdentifier($user->getData()->level)); ?></h4>
					<b>Клас</b>: <?php
					if (empty($data->class)) {
						echo "Не е въведен.";
					} else {
						echo escape($data->class); 
					}
					?><br />
					<b>Езици</b>:
					<?
					if (empty($data->languages)) {
						echo "Не са въведени.";
					} else {
						echo escape($data->languages); 
					}		
					?><br />
					<b>Е-поща</b>:					
					<?
					if (empty($data->email)) {
						echo "Няма.";
					} else {
						echo escape($data->languages); 
					}		
					?><br />			
					<b>Дата на регистрация</b>: <?php echo escape($data->timestamp); ?> <br /> <br />
					[<a class="link-blue" href="update.php">Промени</a>]
				</div>
				<hr />
				
			</div>

			<script src="dependencies/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
		</body>
		</html>
		<?php 
}