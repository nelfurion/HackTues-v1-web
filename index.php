<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(-1);

	require_once 'functions/user/init.php';

	if (Session::exists('home'))
	{
		echo Session::flash('home');
	}

	$user = new User();
	if ($user->isLoggedIn())
	{
	?>
		<p>Username: <a href="profile.php?user=<?php echo escape($user->getData()->username); ?>"><?php echo escape($user->getData()->username); ?></a> [ <?php echo escape($user->fetchUserIdentifier($user->getData()->level)); ?> ]</p>

		<ul>		
			<li><a href="logout.php">Излез</a></li>
		</ul>
	<?php
	} 
	else 
	{
		echo '<p>Трябва да <a href="login.php">влезете</a> или да се <a href="register.php">регистрирате</a>.';
	}