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
							<li><a href="prizes">Награди</a></li>
							<li class="active"><a href="#">Регламент<span class="sr-only">(current)</span></a></li>
							<li><a href="faq">FAQ</a></li>
                            <?php 
                                if ($user->isLoggedIn())
                                {
                            ?>
                                <li><a href="profile">Профил</a></li>
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
			<ul id="rules-list">
				<li>
					За да участва, лицето трябва да се регистрира през гугъл формата или сайта, въвеждайки <strong>валидни</strong> данни за себе си. 
					Регистрациите се приемат до 14.06.
				</li>
				<li>
					Участниците могат да участват по отбори - до 5 човека или по отделно.
				</li>
				<li>
					През последния ден, всеки отбор/участник представя своето приложение пред жури, което го оценява. Според оценката се определя дали има награда и каква е тя.
				</li>
				<li>
					В хакатона могат да участват само ученици на ТУЕС към ТУ-София.
				</li>
			</ul>		
		</div>
		<hr />
		
	</div>

	<script src="dependencies/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
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