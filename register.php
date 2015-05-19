<?php
	
	require_once 'functions/user/init.php';

	if (Input::exists())
	{
		if (Token::check(Input::get('token')))
		{
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array(
					'required' => true,
					'min_len' => 2,
					'max_len' => 20,
					'unique' => 'users'
				),
				'password' => array(
					'required' => true,
					'min_len' => 6
				),
				'password-again' => array(
					'required' => true,
					'matches' => 'password'
				),
				'firstname' => array(
					'required' => true,
					'min_len' => 2,
					'max_len' => 50
				),
				'lastname' => array(
					'required' => true,
					'min_len' => 2,
					'max_len' => 50
				),
				'email' => array(
					'required' => true,
					'min_len' => 2,
					'max_len' => 50
				),
				'class-number' => array(
					'require' => true,
					'min_num' => 8,
					'max_num' => 12
				)

			));

			if ($validation->isPassed())
			{
				$user = new User();

				$salt = Hash::salt(32);

				try 
				{
					$user->create(array(
							'username' => Input::get('username'),
							'password' => Hash::make(Input::get('password'), $salt),
							'salt' => $salt,
							'firstname' => Input::get('firstname'),
							'lastname' => Input::get('lastname'),
							'email' => Input::get('email'),
							'class' => Input::get('class-number') . Input::get('class-letter'),					
							'timestamp' => date('Y-m-d H:i:s'),
							'level' => 1
						));

					$user->login(Input::get('username'), Input::get('password'), true);
					Session::flash('home');
					Redirect::to('home.php');			
				} 
				catch (Exception $e)
				{
					die($e->getMessage());
				}
			}
			else
			{
				foreach ($validation->getErrors() as $error)
				{
					echo $error, '<br>';
				}
			}
		}
	}

?>