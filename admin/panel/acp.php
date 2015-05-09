<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
			text-decoration: none;
			list-style-type: none;
			color: black;
		}
		#top-nav {
			height: 29px;
			background-color: #656665;
		}
		#left-nav {
			clear: left;
			width: 128px;
			//padding-top: 20px;
			float: left;
		}
		#top-nav li, #left-nav li {
			background-color: #656665;
			padding: 5px;
			border: 1px solid black;
			border-top: none;
		}
		#top-nav li{
			background-color: #656665;
			float: left;
			width: 120px;
			border-top-right-radius: 5px;
			border-bottom-right-radius: 5px;
			margin-right: -5px;
		}
		#top-nav li a {
			color: black;
		}
		#top-nav li a:active {
			background-color: #797A78;
		}
	</style>
</head>
<body>
	<nav>
		<ul id="top-nav">
			<li>
				<a href="#" id="userField">user field</a>
			</li>
			<li>
				<a href="#">Dashboard</a>
			</li>
			<li>
				<a href="#">Statistics</a>
			</li>
		</ul>
		<ul id="left-nav">
			<li onclick = "makeRequest('news');">
				<a href="#">News</a>
			</li>
			<li>
				<a href="#">Competitors</a>
			</li>
			<li>
				<a href="#">Teams</a>
			</li>
			<li>
				<a href="#">Sponsors</a>
			</li>
			<li>
				<a href="#">Schelude</a>
			</li>
			<li>
				<a href="#">Rules</a>
			</li>
			<li>
				<a href="#">Prizes</a>
			</li>
			<li>
				<a href="#">FAQ</a>
			</li>
			<li>
				<a href="#">Crew</a>
			</li>
		</ul>
	</nav>
	<section id="content">
		<!-- 
			AJAX request
		-->
	</section>
	<script type="text/javascript">
		//add onclickevent to the menu
		var topLis = document.getElementById("top-nav").childNodes;
		var leftLis = document.getElementById("left-nav").childNodes;

		for(var li in topLis) {
			if (li.id == "userField") {
				li.onclick = function () {
					makeRequest("user");
				}
			}
			else {
				li.onclick = function () {
					makeRequest(li.innerHTML.toString().toLowerCase());
				}
			}
		}

		for(var li in leftLis) {
			li.onclick = function () {
				makeRequest(li.innerHTML.toString().toLowerCase());
			}
		}

		function makeRequest (requested) {
			if (!requested) {
				alert("BAD REQUEST!");
				return;
			};

			//IE7+, Firefox, Chrome, Opera, Safari
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}
			else {
				//IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("content").innerHTML = xmlhttp.responseText;
				};
			};

			//opens the request, with unique value, so it is not cached
			xmlhttp.open("POST",'scripts/content-handler.php' + "?t=" + Math.random() + "&data=" + requested, true);
			xmlhttp.send();
		}

		
	</script>
</body>
</html>