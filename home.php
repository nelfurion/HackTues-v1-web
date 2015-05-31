<?php 

	require_once 'functions/user/init.php';

	if (Session::exists('home'))
	{
		echo Session::flash('home');
	}

	$user = new User();

?>

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
					<a href="home.php"><h1>Hack<span class="blue">(&amp;TUES)</span></h1></a>
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
							<li class="active"><a href="#">Начало<span class="sr-only">(current)</span></a></li>
							<li><a href="prizes">Награди</a></li>
							<li><a href="rules">Регламент</a></li>
							<li><a href="faq">FAQ</a></li>
							<li><a href="about">За хакатона</a></li>
							<li><a href="team">Екип</a></li>
							<?php 
								if ($user->isLoggedIn())
								{
							?>
								<li><a href="profile"><?php echo escape($user->getData()->username); ?></a></li>
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
			<div class="row">
				<div class="col-sm-6">
					<p><strong>HackTUES</strong> е тридневно състезание по програмиране - хакатон, провеждащ се в ТУЕС към ТУ-София.
					 Участващите придобиват фундаментални практически знания по програмиране и работа в екип, а за победителите има и награди.</p> 
					<a href="#"><button type="button" class="hidden home-left-pane-button">Регистрирай се!</button></a>
					<a href="rules"><button type="button" class="hidden home-left-pane-button">Регламент</button></a>
					<!-- Carousel. TODO: Add better images and uncomment.
					<div id="form-container" class="col-sm-6">
					<div id="carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
						    <li data-target="#carousel" data-slide-to="0" class="active"></li>
						    <li data-target="#carousel" data-slide-to="1"></li>
						</ol>

						<div class="carousel-inner" role="listbox">
						    <div class="item active">
						    	<img src="assets/images/competition/img1.jpg" alt="...">
						    	<div class="carousel-caption">
						        	...
						    	</div>
						  	</div>
					  	<div class="item">
					    	<img src="assets/images/competition/img2.jpg" alt="...">
					    	<div class="carousel-caption">
					        	...
					    	</div>
					  	</div>
					</div>

						<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
						    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
					    	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    					<span class="sr-only">Next</span>
						</a>
					</div>-->
				</div>
				<div class="col-sm-6">
					<img src="assets/images/right-pane-dates.png" alt="Hackathon dates" class="img-responsive"/>
				</div>
  			</div>
  		</div>
  		<hr />
  		<section id="news-section">
  			<!-- Do not delete! -->
  		</section>
		<hr />
	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="functions/ajaxrequest.js"></script>
	<script>
		$(document).ready(function () {			
		    $('button.hidden').fadeIn(2000).removeClass('hidden');
		    AJAXRequest('partials/news-partial.php', {done: function () {
				document.getElementById('news-section').innerHTML = xmlhttp.responseText;
				changeNewsStyle();
				processNewsNavigation();
			}});
		});

		/* For smaller screen sizes remove the padding of the article paragraphs */
		function changeNewsStyle () {
			if (document.body.clientWidth <= 480) {
				var artContents = document.getElementsByClassName('news-content');
				for (var i = artContents.length - 1; i >= 0; i--) {
					artContents[i].style.paddingLeft = '0px';
					artContents[i].style.width = '100%';
					artContents[i].previousSibling.previousSibling.style.paddingLeft = '0px';
				};
			};
		};

		function processNewsNavigation () {
			document.getElementById("news-nav").addEventListener("click", function (e) {
				if (e.target && e.target.nodeName == "A") {
					AJAXRequest('controllers/news-controller.php', {func:'getNews', startIndex: e.target.innerHTML, done: function () {
						document.getElementById('news-container').innerHTML = xmlhttp.responseText;
						changeNewsStyle();
					}});
				};
			});

			document.getElementById('news-section').addEventListener('click', function (e) {
				if (e.target.className.indexOf('news-title') > -1) {
					if (e.target.parentNode.style.maxHeight !== 'none') {
						e.target.parentNode.style.maxHeight = 'none';
						e.target.nextSibling.nextSibling.innerHTML += '<input type="button" class="article-exit" value="Назад">';
						return false;
					} else {
						e.target.parentNode.style.maxHeight = '400px';

						for (var i = 0; i < e.target.nextSibling.nextSibling.childNodes.length; i++) {
							var node = e.target.nextSibling.nextSibling.childNodes[i];

							if (node.className && node.className.indexOf('article-exit') > -1) {
								e.target.nextSibling.nextSibling.removeChild(node);
							};
						};
					};
				}
				else if (e.target.className.indexOf('article-exit') > -1) {
					e.target.parentNode.parentNode.style.maxHeight = '400px';
					e.target.parentNode.removeChild(e.target);
				};
			});
		}
		/* Forms. Note: Not needed until the registration button is fixed.

		document.getElementById('form-container').addEventListener('click', function (e) {
			if (e.target.id === 'registerBtn') {
				e.target.style.display = 'none';
				if (!document.getElementById('form-register')) {
					AJAXRequest('register.php', {
						done: function () {
							document.getElementById('carousel').style.display = 'none';
							document.getElementById('form-container').innerHTML += xmlhttp.responseText;
						}
					});
				} else {
					document.getElementById('carousel').style.display = 'none';
					document.getElementById('form-register').style.display = 'block';
					document.getElementsByClassName('form-switch')[0].style.display = 'block';
				}
				
			} else if (e.target.id === 'form-exit') {
				e.preventDefault();
				e.stopImmediatePropagation();

				document.getElementById('registerBtn').style.display = 'inline-block';
				document.getElementById('form-register').style.display = 'none';
				document.getElementsByClassName('form-switch')[0].style.display = 'none';
				document.getElementById('carousel').style.display = 'block';
			} else if (e.target.className.indexOf('form-switch') > -1) {
				e.stopImmediatePropagation();
				e.preventDefault();

				if (document.getElementById('form-register').style.display !== 'none') {
					if (!document.getElementById('section-login')) {
						document.getElementById('form-register').style.display = 'none';
						AJAXRequest('login.php', {done: function () {
							var reg = document.getElementById('form-register');
							var formContainer = document.getElementById('form-container');
							reg.style.display = 'none';
							formContainer.innerHTML += xmlhttp.responseText;
						}});
					} else {
						document.getElementById('form-register').style.display = 'none';
						document.getElementById('section-login').style.display = 'block';
					}
				} else {
					document.getElementById('section-login').style.display = 'none';
					document.getElementById('form-register').style.display = 'block';
				}
			}
		}); */
	</script>
		
</body>
</html>