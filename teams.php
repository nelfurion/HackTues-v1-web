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
	<title>HackTUES - Отбори</title>
	<link href='dependencies/fonts/open-sans.css' rel='stylesheet' type='text/css'>
    <link href='dependencies/fonts/raleway.css' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="dependencies/bootstrap-3.3.4-dist/css/bootstrap.min.css">

	<script type="text/javascript" src="dependencies/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/css/teams.css">
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
							<li class="active"><a href="teams">Отбори<span class="sr-only">(current)</span></a></li>
							<li><a href="prizes">Награди</a></li>
							<li><a href="rules">Регламент</a></li>
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
			<table id="teams">
				<caption>HackTUES - Отбори</caption>
				<thead><tr><th>Отбор:</th><th>Проект:</th></tr></thead>
				<tbody>
					<?php
						require dirname(__FILE__) . '/functions/dbquery.php';
						$fields = ['*'];
						$teams = getData('teams', $fields);
						for ($i=0; $i < count($teams); $i++) {
							if ($i % 2 == 0) {
								echo '<tr class="tr-even">
										<td class="td-team-name"><strong>' . $teams[$i]->name . '</strong></td>
										<td>' . $teams[$i]->project_description . '</td>
								 </tr>';
							}
							else {
								echo '<tr class="tr-odd">
										<td class="td-team-name"><strong>' . $teams[$i]->name . '</strong></td>
										<td>' . $teams[$i]->project_description . '</td>
								 </tr>';
							}
							
						}
					?>
				</tbody>
				<tfoot><tr><td colspan="2">Отбори на HackTUES 1 - 2015</td></tr></tfoot>
			</table>
		</div>
		<hr />
		
	</div>

	<script src="dependencies/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
</body>
</html>