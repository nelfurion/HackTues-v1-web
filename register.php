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
<meta charset="utf-8">
<form id="form-register" class="form-signin" action="register.php" method="post">
		<div class="row">
			<div class="col-md-6">
				<label for="firstname">Име: </label>
			</div>
			<div class="col-md-6">
				<input type="text" name="firstname" class="form-control" id="firstname" placeholder="Име" value="<?php echo escape(Input::get('firstname')); ?>" autocomplete="off">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="lastname">Фамилия: </label>
			</div>
			<div class="col-md-6">
				<input type="text" name="lastname" class="form-control" id="lastname" placeholder="Фамилия" value="<?php echo escape(Input::get('lastname')); ?>" autocomplete="off">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="class-number">Клас: </label>
			</div>
			<div class="col-md-6">
				<div class="col-md-6">
					<input type="number" name="class-number" class="form-control" min="8" max="12" id="class-number" value="<?php echo escape(Input::get('class-number')); ?>" autocomplete="off">
				</div>
				<div class="col-md-6">
					<select name="class-letter" class="form-control">
					  <option value="А">А</option>
					  <option value="Б">Б</option>
					  <option value="В">В</option>
					  <option value="Г">Г</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="email">Е-мейл: </label>
			</div>
			<div class="col-md-6">
				<input type="email" name="email" id="email" class="form-control" placeholder="Е-мейл" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="username">Потребител: </label>
			</div>
			<div class="col-md-6">				
				<input type="text" name="username" id="username" class="form-control" placeholder="Потребител" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="password">Парола: </label>
			</div>
			<div class="col-md-6">
				<input type="password" placeholder="Парола" class="form-control" name="password" id="password">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="password-again">Потвърди паролата: </label>
			</div>
			<div class="col-md-6">
				<input type="password" name="password-again" class="form-control" placeholder="Потвърди парола" id="password-again">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<button id="form-exit">Отказ</button>
			</div>
			<div class="col-md-6">
				<input id="reg-send" type="submit" value="Регистрирай се!">				
				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			</div>
		</div>
</form>
<a class="form-switch" href="#">Вече имаш акаунт?</a>