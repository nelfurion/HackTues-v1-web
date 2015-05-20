<!DOCTYPE html>
<html lang="en">
<head>
	<title>FAQ</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">		
	<title>HackTUES</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">		
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<header>		
			<div class="row">					
				<div class="col-sm-12">
					<h1>Hack(<span class="blue">&amp;TUES</span>)</h1>
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
							<li><a href="home">Начало <span class="sr-only">(current)</span></a></li>
							<li><a href="prizes">Награди</a></li>
							<li><a href="sponsors">Спонсори</a></li>
							<li><a href="rules">Регламент</a></li>
							<li class="active"><a href="#">FAQ</a></li>
							<li><a href="about">За хакатона</a></li>
							<li><a href="team">Екип</a></li>	        		        	        
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<hr />
		<div class="row">
			<div class="col-sm-12">
				<h2>FAQ</h2>
				<?php
					require_once 'controllers/faq-controller.php';
				?>
			</div>		
		</div>
		<hr />
	</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>