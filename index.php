<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(-1);

	require_once 'core/init.php';

	if (Session::exists('home'))
	{
		echo Session::flash('home');
	}

	$user = new User();
	if ($user->isLoggedIn())
	{
	?>
		<p>Username: <a href="#"><?php echo escape($user->getData()->username); ?></a></p>

		<ul>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	<?php
	} 
	else 
	{
		echo '<p>You need to <a href="login.php">log</a> in or <a href="register.php">register</a>.';
	}