<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HackTUES</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">		
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>	
</head>
<body>
	<div id="wrapper">
		<header>		
			<div id="logo">					
				<h1>Hack(<span class="blue">&amp;TUES</span>)</h1>
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
			<div id="left-pane">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, perspiciatis quae tempore recusandae consequuntur, fugit, perferendis incidunt alias omnis totam libero, culpa minus ratione maxime necessitatibus eius dolorem itaque natus.</p>
				<button type="button" class="hidden left-pane-button">Регистрирай се</button>
				<button type="button" class="hidden left-pane-button">Регламент</button>				
			</div>
			<div id="right-pane">
				<img src="assets/images/right-pane-dates.png" alt="Hackathon dates" class="img-responsive"/>
			</div>
		</div>
		<hr />

		<section id="news-section">
			<?php
				require_once 'controllers/news-controller.php';
				echo "KUREC";
			?>
		</section>

		<footer id="footer" class="clearfix">
			<a href="http://elsys-bg.org"><img src="assets/images/elsys-logo.png" alt="TUES" /></a>			
			<a href="https://hackbulgaria.com/"><img src="assets/images/hbg-logo.png" alt="Hack Bulgaria" /></a>				
		</footer>
		
	</div>
	
	<script>
		$(document).ready(function () {
			$('.left-pane-button').css('opacity', 0.5); 			
		    $('button.hidden').fadeIn(2000).removeClass('hidden'); 
			    
			$('.left-pane-button').hover(  
			   function(){  
			      $(this).stop().fadeTo('slow', 1);  
			   },  
			   function(){  
			      $(this).stop().fadeTo('slow', 0.4);  
			   });		    
		});
	</script>
	<script src="assets/js/rainbow-custom.min.js"></script>	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>	
</body>
</html>