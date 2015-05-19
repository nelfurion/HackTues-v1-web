<!DOCTYPE html>
<html lang="en">
<head>
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
							<li class="active"><a href="#">Начало <span class="sr-only">(current)</span></a></li>
							<li><a href="#">Награди</a></li>
							<li><a href="#">Спонсори</a></li>
							<li><a href="#">Регламент</a></li>
							<li><a href="#">FAQ</a></li>
							<li><a href="#">За хакатона</a></li>
							<li><a href="#">Екип</a></li>	        		        	        
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<hr />
		<div class="jumbotron">
			<div class="row">
				<div class="col-sm-6">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, perspiciatis quae tempore recusandae consequuntur, fugit, perferendis incidunt alias omnis totam libero, culpa minus ratione maxime necessitatibus eius dolorem itaque natus.</p>
					<button type="button" class="hidden left-pane-button">Регистрирай се</button>
					<button type="button" class="hidden left-pane-button">Регламент</button>
				</div>
				<div class="col-sm-6">
					<img src="assets/images/right-pane-dates.png" alt="Hackathon dates" class="img-responsive"/>
				</div>
  			</div>
  		</div>
		<hr />

		<?php
			require_once 'partials/news-partial.php';
		?>
		<hr />
		<footer>
			<div class="row">
				<div class="col-sm-1">
					<a href="http://elsys-bg.org"><img src="assets/images/elsys-logo.png" alt="TUES" /></a>	
				</div>
				<div class="col-sm-1">	
					<a href="https://hackbulgaria.com/"><img src="assets/images/hbg-logo.png" alt="Hack Bulgaria" /></a>
				</div>
			</div>		
		</footer>
		
	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="functions/ajaxrequest.js"></script>
	<script>
		$(document).ready(function () {			
		    $('button.hidden').fadeIn(2000).removeClass('hidden');     
		});

		document.getElementById("news-nav").addEventListener("click", function (e) {
			console.log(e.target.innerHTML);
			if (e.target && e.target.nodeName == "A") {
				AJAXRequest('controllers/news-controller.php', {containerId: 'news-container', startIndex: e.target.innerHTML}, 'getNews');
			};
			/*if (e.target && e.target.nodeName == "LI") {
				AJAXRequest('controllers/news-controller.php', [], 'getNews', {containerId: 'news-container'});
			};*/
		});
	</script>
		
</body>
</html>