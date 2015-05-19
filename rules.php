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
							<li><a href="home">Начало <span class="sr-only">(current)</span></a></li>
							<li><a href="prizes">Награди</a></li>
							<li><a href="sponsors">Спонсори</a></li>
							<li class="active"><a href="#">Регламент</a></li>
							<li><a href="faq">FAQ</a></li>
							<li><a href="about">За хакатона</a></li>
							<li><a href="team">Екип</a></li>	        		        	        
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<hr />
		<section>
			<div class="col-sm-12">
				<h2>Регламент</h2>
				<p>Ем хуу някой го напише. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore consequatur quae nihil possimus eveniet, sapiente facilis, id officia quisquam quaerat corrupti, doloremque nulla adipisci, distinctio nisi ab harum magni quod. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat velit et, laboriosam nobis non sit, molestias id, autem inventore sed aperiam optio tenetur. Delectus hic enim libero, nobis laborum quisquam.</p>
			</div>		
		</section>
		<hr />
		
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