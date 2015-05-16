<?php

	require_once 'functions/user/init.php';

	if (!$username = Input::get('user'))
	{
		Redirect::to("index.php");
	}
	else 
	{
		$user = new User($username);
		if (!$user->exists())
		{
			Redirect::to(404);
		} 
		else 
		{
			$data = $user->getData();
		}
		?>
		<head>
			<meta charset="UTF-8">			
			<title><?php echo escape($data->username) ?> - HackTUES</title>
		</head>
		<body>
			<h3><?php echo escape($data->firstname) . ' ' . escape($data->lastname) . ' (' . escape($data->username) . ')'?></h3>
			<h4><?php echo escape($user->fetchUserIdentifier($user->getData()->level)); ?></h4>
			<p>Клас: <?php echo escape($data->class); ?></p>
			<p>Дата на регистрация: <?php echo escape($data->timestamp); ?></p>
			<p>Е-поща: <?php echo escape($data->email); ?></p>
			<p>[<a href="update.php">Промени</a>]</p>
		</body>
		<?php 
}