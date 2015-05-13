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
			float: left;
			display: inline-block;
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
		#content {
			overflow: hidden;
		}
		#content #areaHolder {
			height: 200px;
			min-width: 300px;
			max-width: 50%;
			overflow: scroll;
		}
		.clear {
			clear: both;
		}
	</style>
</head>
<body>
	<nav>
		<ul id="top-nav">
			<li class="navLi">
				<a href="#" id="userField">user field</a>
			</li>
			<li class="navLi" id="dashboard">
				<a href="#" >Dashboard</a>
			</li>
			<li class="navLi" id="statistics">
				<a href="#">Statistics</a>
			</li>
		</ul>
		<ul id="left-nav">
			<li class="navLi" id="news">
				<a href="#">News</a>
			</li>
			<li class="navLi" id="competitors">
				<a href="#">Competitors</a>
			</li>
			<li class="navLi" id="teams">
				<a href="#">Teams</a>
			</li>
			<li class="navLi" id="sponsors">
				<a href="#">Sponsors</a>
			</li>
			<li class="navLi" id="schelude">
				<a href="#">Schelude</a>
			</li>
			<li class="navLi" id="rules">
				<a href="#">Rules</a>
			</li>
			<li class="navLi" id="prizes">
				<a href="#">Prizes</a>
			</li>
			<li class="navLi" id="faq">
				<a href="#">FAQ</a>
			</li>
			<li class="navLi" id="crew">
				<a href="#">Crew</a>
			</li>
		</ul>
	</nav>
	<section id="content">
		<!-- 
			AJAX request
		-->
	</section>
	<div class="clear"></div>
	<script type="text/javascript" src="scripts/ajaxrequest.js"></script>
	<script type="text/javascript" src="scripts/nicedit.js"></script>
	<script type="text/javascript" src="scripts/addnews.js"></script>
	<script type="text/javascript">
		var viewsDir = "views/";
		//TODO: fix request with fields and stuff
		document.getElementById("top-nav").addEventListener("click", function (e) {
			if (e.target && e.target.nodeName == "A") {
				AJAXRequest(viewsDir + e.target.parentNode.id + ".php", []);
			};
			if (e.target && e.target.nodeName == "LI") {
				AJAXRequest(viewsDir + e.target.id + ".php", []);
			};
		});
		document.getElementById("left-nav").addEventListener("click", function (e) {
			if (e.target && e.target.nodeName == "A") {
				AJAXRequest(viewsDir + e.target.parentNode.id + ".php", []);
			};
			if (e.target && e.target.nodeName == "LI") {
				AJAXRequest(viewsDir + e.target.id + ".php", []);
			};
		});
		
	</script>
	</body>
</html>