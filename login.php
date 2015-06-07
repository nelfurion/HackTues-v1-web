<?php
	require_once 'functions/user/init.php';

	if (Input::exists())
	{
		if (Token::check(Input::get('token')))
		{
			$validate = new Validate();
			$validation = $validate->check(array(
					'username' => array('required' => true),
					'password' => array('required' => true)
				));

			if ($validation->isPassed())
			{
				$remember = (Input::get('remember') === 'on') ? true : false;
				$user = new User();
				$login = $user->login(Input::get('username'), Input::get('password'), $remember);

				if ($login)
				{
					session_start();
					$_SESSION['logged'] = true;
					$_SESSION['username'] = $user->username;
					Redirect::to('home');
				}
				else 
				{
					echo 'Грешно потребителско име или парола.';
				}
			}
			else 
			{
				foreach ($validation->getErrors() as $error)
				{
					echo $error . "<br />";
				}
			}
		}
	}
	else if (isset($_GET['response']))
	{
		$response = json_decode($_GET['response']);
		print_r($response);
		echo $response->id;
		$user = new User();
		//$login = $user->login($response->)
		$salt = Hash::salt(32);
		$user->create(array(
							'username' => $response->name,
							'password' => Hash::make($response->id, $salt),
							'salt' => $salt,
							'firstname' => $response->first_name,
							'lastname' => $response->last_name,
							'email' => $response->email,
							'class' => 'not given',
							'timestamp' => date('Y-m-d H:i:s'),
							'level' => 1,
							'languages' => ''
						));

		$user->login($response->name, $response->id, true);
		session_start();
		$_SESSION['logged'] = true;
		$_SESSION['username'] = $user->username;
		Redirect::to('home.php');			
	}
?>
<section id="section-login">
	<form action="login.php" method="post">
		<div class="field">
			<label for="username">Потребител</label>
			<input type="text" name="username" id="username" autocomplete="off">
		</div>

		<div class="field">
			<label for="password">Парола</label>
			<input type="password" name="password" id="password" autocomplete="off">
		</div>

		<div class="field">
			<label for="remember">
				<input type="checkbox" name="remember" id="remember"> Запомни ме
			</label>
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Влез">
	</form>
	<a class="form-switch" href="#">Назад</a>
</section>
