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
							<li><a href="prizes">Награди</a></li>
							<li><a href="rules">Регламент</a></li>
							<li><a href="faq">FAQ</a></li>
							<li><a href="about">За хакатона</a></li>
							<li><a href="team">Екип</a></li>
							<li><a href="profile">Username</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<hr />
		<div class="jumbotron">
			<div class="row">
				<div id="form-container" class="col-sm-6">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, perspiciatis quae tempore recusandae consequuntur, fugit, perferendis incidunt alias omnis totam libero, culpa minus ratione maxime necessitatibus eius dolorem itaque natus.</p>
					<button type="button" id="registerBtn" class="hidden left-pane-button">Регистрирай се | Влез</button>
					<button type="button" class="hidden left-pane-button"><a href="rules">Регламент</a></button>
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
		
		

		/**/

		document.getElementById('form-container').addEventListener('click', function (e) {
			if (e.target.id === 'registerBtn') {
				e.target.style.display = 'none';
				if (!document.getElementById('section-register')) {
					AJAXRequest('register.php', {
						done: function () {
							document.getElementById('form-container').innerHTML += xmlhttp.responseText;
						}
					});
				};
				
			} else if (e.target.id === 'form-exit') {
				e.preventDefault();
				e.stopImmediatePropagation();

				document.getElementById('registerBtn').style.display = 'inline-block';
				var regSection = document.getElementById('form-register');
				var formSwitch = document.getElementsByClassName('form-switch')[0];
				document.getElementById('form-container').removeChild(regSection);
				document.getElementById('form-container').removeChild(formSwitch);
			} else if (e.target.className.indexOf('form-switch') > -1) {
				e.stopImmediatePropagation();
				e.preventDefault();

				if (e.target.previousSibling.previousSibling.id === 'form-register') {
					AJAXRequest('login.php', {done: function () {
						var reg = document.getElementById('form-register');
						var formContainer = document.getElementById('form-container');
						formContainer.removeChild(reg);
						formContainer.removeChild(e.target);
						formContainer.innerHTML += xmlhttp.responseText;
					}});
				} else {
					AJAXRequest('register.php', {done: function () {
						var login = document.getElementById('section-login');
						var formContainer = document.getElementById('form-container');
						formContainer.removeChild(login);
						formContainer.innerHTML += xmlhttp.responseText;
					}});
				}
				
				return false;
			}
		});
	</script>
		
</body>
</html>