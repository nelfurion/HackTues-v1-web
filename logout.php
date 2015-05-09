<?php
	require_once 'core/user/init.php';

	$user = new User();
	$user->logout();

	Redirect::to('index.php');