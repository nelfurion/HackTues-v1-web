<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">		
	<title>HackTUES</title>
	<link href='dependencies/fonts/open-sans.css' rel='stylesheet' type='text/css'>
	<link href='dependencies/fonts/raleway.css' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="dependencies/bootstrap-3.3.4-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/css/news.css">
	<script type="text/javascript" src="dependencies/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="functions/ajaxrequest.js"></script>
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
							<li class="active"><a href="#">Начало<span class="sr-only">(current)</span></a></li>
							<li><a href="prizes">Награди</a></li>
							<li><a href="rules">Регламент</a></li>
							<li><a href="faq">FAQ</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<hr />	
		<div class="jumbotron">
			<p><strong>HackTUES</strong> е тридневно състезание по програмиране - хакатон, провеждащ се в ТУЕС към ТУ-София.
			 Участващите придобиват фундаментални практически знания по програмиране и работа в екип, а за победителите има и награди.</p> 
  		</div>
  		<hr />		
  		<section id="news-section">
  			<!-- Do not delete! -->
  		</section>
	</div>

	<script src="dependencies/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="functions/helper.js"></script>
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
		}

		function openNewsContent (caller) {
			if (previousElementSibling(caller).style.overflow === "visible") {
				previousElementSibling(caller).style.overflow = "hidden";
				previousElementSibling(caller).style.maxHeight = "200px";
				caller.innerHTML = "Повече информация";
			} else {
				caller.innerHTML = "Скрий";
				previousElementSibling(caller).style.overflow = "visible";
				previousElementSibling(caller).style.maxHeight = "none";
			}
			
		}
	</script>
		
</body>
</html>