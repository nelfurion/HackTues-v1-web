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
	<script type="text/javascript" src="functions/ajaxrequest.js"></script>
</head>
<body>
<div id="fb-root"></div>
<script>
  // This is called with the results from from FB.getLoginStatus().
	function statusChangeCallback(response) {
		// The response object is returned with a status field that lets the
		// app know the current login status of the person.
		// Full docs on the response object can be found in the documentation
		// for FB.getLoginStatus().
		if (response.status === 'connected') {
		  // Logged into your app and Facebook.
			testAPI();
		} else if (response.status === 'not_authorized') {
		  // The person is logged into Facebook, but not your app.
		  //document.getElementById('status').innerHTML = 'Please log ' +
		    //'into this app.';
		} else {
		  // The person is not logged into Facebook, so we're not sure if
		  // they are logged into this app or not.
		  //document.getElementById('status').innerHTML = 'Please log ' +
		    //'into Facebook.';
		}
	}

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
		FB.getLoginStatus(function(response) {
		  statusChangeCallback(response);
		});
	}

	window.fbAsyncInit = function() {
		FB.init({
		appId      : '1621393971411590',
		cookie     : true,  // enable cookies to allow the server to access 
		                    // the session
		xfbml      : true,  // parse social plugins on this page
		version    : 'v2.2' // use version 2.2
	});

	// Now that we've initialized the JavaScript SDK, we call 
	// FB.getLoginStatus().  This function gets the state of the
	// person visiting this page and can return one of three states to
	// the callback you provide.  They can be:
	//
	// 1. Logged into your app ('connected')
	// 2. Logged into Facebook, but not your app ('not_authorized')
	// 3. Not logged into Facebook and can't tell if they are logged into
	//    your app or not.
	//
	// These three cases are handled in the callback function.

	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});

};

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    FB.api('/me', function(response) {
      AJAXRequest('login.php', {response: JSON.stringify(response), done: function () {
      	console.log(xmlhttp.responseText);
      }});
      //document.getElementById('status').innerHTML =
        //'Thanks for logging in, ' + response.name + '!';

    });
  }
</script>

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
							<li><a href="teams">Отбори</a></li>
							<li><a href="prizes">Награди</a></li>
							<li><a href="rules">Регламент</a></li>
							<li><a href="faq">FAQ</a></li>
							<?php 
								if ($user->isLoggedIn())
								{
							?>
								<li><a href="profile">Профил</a></li>
								<!-- <a href="/<?php /* echo escape($user->getData()->username); */?>"> -->
								<li><a href="logout.php" onclick="FB.logout(); ">Излез</a></li>
							<?php
								}
								else
								{
							?>
								<li class="pull-left"><div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="true"></div></li>
							<?php
								}
							?>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<hr />
		<?php 
			if (!$user->isLoggedIn())
			{
		?>		
		<div class="jumbotron">
			<p><strong>HackTUES</strong> е тридневно състезание по програмиране - хакатон, провеждащ се в ТУЕС към ТУ-София.
			 Участващите придобиват фундаментални практически знания по програмиране и работа в екип, а за победителите има и награди.</p> 
			<div class="row">
				<div class="col-md-2 col-md-offset-5"><a href="register"><button id="btn-register" type="button" class="hidden btn btn-default btn-sm">Регистрирай се!</button></a></div>
				<div id="status"></div><!-- fb thing, to be deleted later -->
			</div>
  		</div>
  		<hr />
		<?php
			}
		?>  		
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