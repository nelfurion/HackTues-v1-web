<?php
	if (isset($_GET['article-content'])) {
		require_once 'scripts/dbquery.php';
		saveNews($_GET['article-content']);
		require_once dirname(__FILE__) . '/../../classes/common/redirect.php';
		Redirect::to('acp');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>HackTues - Админ панел</title>
	<link rel="stylesheet" type="text/css" href="styles/main-panel-style.css">
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
				<a href="#" onclick="loadStatistics()">Statistics</a>
			</li>
		</ul>
		<ul id="left-nav">
			<li class="navLi" id="news">
				<a href="#news">News</a>
			</li>
			<li class="navLi" id="competitors">
				<a href="#competitors">Competitors</a>
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
	<!--<script type="text/javascript" src="scripts/nicedit.js"></script>-->
	<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="scripts/addnews.js"></script>
	<script type="text/javascript">
		var viewsDir = "views/";
		//TODO: fix request with fields and stuff
		document.getElementById("top-nav").addEventListener("click", function (e) {
			if (e.target.id != 'statistics' && e.target.parentNode.id != 'statistics') {
				if (e.target && e.target.nodeName == "A") {
					AJAXRequest(viewsDir + e.target.parentNode.id + ".php", []);
				};
				if (e.target && e.target.nodeName == "LI") {
					AJAXRequest(viewsDir + e.target.id + ".php", []);
				};
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
		

		/*	A long time ago, in a galaxy far far away, javascript had a point.
			This code works only if the developer options of the browser are closed.
			JS is so good. I want to kiss it and lick it and do bad things to it.
		*/
		function loadStatistics () {
			var script = document.createElement('script');
			script.src='charts/Chart.js';

			document.getElementsByTagName('body')[0].appendChild(script);

			script = document.createElement('script');
			script.src = 'linechart.js';

			document.getElementsByTagName('body')[0].appendChild(script);
		}


		
	</script>
	</body>

</html>