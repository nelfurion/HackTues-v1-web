<?php 

	require_once 'functions/user/init.php';

	$errors = array();
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
							'level' => 1,
							'languages' => implode(' ', Input::get('languages'))
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
				$errors = $validation->getErrors();
			}
		}
	}

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
	<title>HackTUES</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/css/bootstrap-select.min.css">	
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
							<li><a href="teams">Отбори</a></li>
							<li><a href="prizes">Награди</a></li>
							<li><a href="rules">Регламент</a></li>
							<li><a href="faq">FAQ</a></li>
							<?php 
								if ($user->isLoggedIn())
								{
							?>
								<li><a href="profile"><?php echo escape($user->getData()->username); ?></a></li>
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
		<form class="form-horizontal" action="register.php" onsubmit="return validateOnClient();" role="form" method="post">
			<div id="register-panel" class="panel panel-default">		
				<div class="panel-body" id="form-panel">
					<?php

						foreach ($errors as $error)
						{
							echo '<div class="alert alert-danger" role="alert">
  								  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								  <span class="sr-only">Error:</span>' . $error . '</div>';
						}
					?>
					<div class="form-group">
						<label for="firstname" class="col-sm-4 control-label">Име</label>
						<div class="col-sm-4">
							<input type="text" name="firstname" class="form-control" id="firstname" placeholder="Име" value="<?php echo escape(Input::get('firstname')); ?>" autocomplete="off" aria-describedby="firstname-help-block">
							<span id="firstname-help-block" class="help-block">От 2 до 20 символа, на кирилица.</span>
						</div>
					</div>
					<div class="form-group">
						<label for="lastname" class="col-sm-4 control-label">Фамилия</label>
						<div class="col-sm-4">
							<input type="text" name="lastname" class="form-control" id="lastname" placeholder="Фамилия" value="<?php echo escape(Input::get('lastname')); ?>" autocomplete="off" aria-describedby="lastname-help-block">
							<span id="lastname-help-block" class="help-block">От 2 до 20 символа, на кирилица.</span>					
						</div>
					</div>
					<div class="form-group">
						<label for="class-number" class="col-sm-4 control-label">Клас</label>
						<div class="col-sm-3">
							<input type="number" name="class-number" class="form-control" min="8" max="12" id="class-number" value="<?php echo escape(Input::get('class-number')); ?>" autocomplete="off" aria-describedby="class-help-block">
						</div>
						<div class="col-sm-1">
							<select id="class-letter-xs-fix" name="class-letter" class="form-control">
							  <option value="А">А</option>
							  <option value="Б">Б</option>
							  <option value="В">В</option>
							  <option value="Г">Г</option>
							</select>
						</div>	
					</div>
					<div class="form-group">
						<label for="languages" class="col-sm-4 control-label">Предпочитани технологии</label>
						<div class="col-sm-4">
							<select class="selectpicker" name="languages[]" data-width="100%" title="Изберете технологии" id="languages" multiple>
								<option value="C">C</option>
								<option value="C++">C++</option>
								<option value="C#">C#</option>
								<option value="Java">Java</option>
								<option value="Objective-C">Objective-C</option>
								<option value="Perl">Perl</option>
								<option value="Python">Python</option>
								<option value="Ruby">Ruby</option>								
								<option value="PHP">PHP</option>
								<option value="JavaScript">JavaScript</option>																											
								<option value="HTML">HTML</option>
								<option value="CSS">CSS</option>																																																							
							</select>							
						</div>
					</div>						
					<div class="form-group">
						<label for="email" class="col-sm-4 control-label">Е-поща</label>
						<div class="col-sm-4">
							<input type="email" name="email" id="email" class="form-control" placeholder="Е-поща" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off" aria-describedby="email-help-block">
							<span id="email-help-block" class="help-block">На нея ще получите линк за активация.</span>
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-4 control-label">Потребителско име</label>
						<div class="col-sm-4">
							<input type="text" name="username" id="username" class="form-control" placeholder="Потребител" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off" aria-describedby="username-help-block">
							<span id="username-help-block" class="help-block">От 2 до 20 символа, на латиница.</span>
						</div>
		  			</div>
		  			<div class="form-group">
		  				<label for="password" class="col-sm-4 control-label">Парола</label>
		  				<div class="col-sm-4">
		  					<input type="password" placeholder="Парола" class="form-control" name="password" id="password" aria-describedby="password-help-block">
		  					<span id="password-help-block" class="help-block">Трябва да е минимум 6 символа.</span>
		  				</div>
		  			</div>	
		  			<div class="form-group">
		  				<label for="password-again" class="col-sm-4 control-label">Потвърди парола</label>
		  				<div class="col-sm-4">
		  					<input type="password" name="password-again" class="form-control" placeholder="Потвърди парола" id="password-again">
		  				</div>
		  			</div>	  			
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-4">
							<div class="checkbox">
								<label><input type="checkbox" id="agree">Прочетох и приемам <a href="rules" target="_blank" class="link-blue">регламента</a> за участие.</label>
							</div>
		    			</div>
					</div>
				</div>
				<div class="panel-footer" style="overflow:hidden;text-align:right;">
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10" id="form-footer">
							<button type="submit" class="btn btn-default btn-sm" id="form-submit">Регистрирай се!</button>
							<button onclick="location.href = 'home';" class="btn btn-default btn-sm">Отказ</button>		
							<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
						</div>
					</div>
				</div>
			</div>
		</form>
		<hr />
		
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		document.getElementById('form-submit').addEventListener('submit', function (event) {
			event.preventDefault();
			event.stopImmediatePropagation();
		});
		function validateOnClient () {
			var hasError = false;
			var firstname = document.getElementById('firstname');
			if (firstname.value.length < 2 || firstname.value.length > 20) {
				firstname.parentNode.className += " has-error";
				hasError = true;
			} else {
				var className = firstname.parentNode.className;
				className = className.replace(' has-error', ' has-success');
				firstname.parentNode.className = className;
			}

			var lastname = document.getElementById('lastname');
			if (lastname.value.length < 2 || lastname.value.length > 20) {
				lastname.parentNode.className += " has-error";
				hasError = true;
			} else {
				var className = lastname.parentNode.className;
				className = className.replace(' has-error', ' has-success');
				lastname.parentNode.className = className;
			}

			var grade = document.getElementById('class-number');
			if (grade.value < 8 || grade.value > 12) {
				grade.parentNode.className += " has-error";
				hasError = true;
			} else {
				var className = grade.parentNode.className;
				className = className.replace(' has-error', ' has-success');
				grade.parentNode.className = className;
			}

			var email = document.getElementById('email');
			if (email.value.indexOf('@') === -1) {
				email.parentNode.className += " has-error";
				hasError = true;
			} else {
				var className = email.parentNode.className;
				className = className.replace(' has-error', ' has-success');
				email.parentNode.className = className;
			}

			var username = document.getElementById('username');
			if (username.value < 2 || username.value > 20) {
				username.parentNode.className += " has-error";
				hasError = true;
			} else {
				var className = username.parentNode.className;
				className = className.replace(' has-error', ' has-success');
				username.parentNode.className = className;
			}

			var pass = document.getElementById('password');
			
			if (pass.value.length < 6) {
				pass.parentNode.className += " has-error";
				hasError = true;
			} else {
				var className = pass.parentNode.className;
				className = className.replace(' has-error', ' has-success');
				pass.parentNode.className = className;
			}


			var passValid = document.getElementById('password-again');
			if ((passValid.value !== pass.value) || !passValid.value) {
				passValid.parentNode.className += " has-error";
				hasError = true;
			} else {
				var className = passValid.parentNode.className;
				className = className.replace(' has-error', ' has-success');
				passValid.parentNode.className = className;
			}

			var tech = document.getElementById('languages');
			if (tech.selectedIndex === -1) {
				tech.parentNode.className += " has-error";
				hasError = true;
			} else {
				var className = tech.parentNode.className;
				className = className.replace(' has-error', ' has-success');
				tech.parentNode.className = className;
			}

			var agree = document.getElementById('agree');
			if (!agree.checked) {
				agree.parentNode.parentNode.className += " has-error";
				hasError = true;
			} else {
				var className = agree.parentNode.className;
				className = className.replace(' has-error', ' has-success');
				agree.parentNode.className = className;
			}

			if (hasError) {
				/*var regBtn = document.getElementById('form-submit');
				var nodes = regBtn.parentNode.childNodes;
				console.log(nodes);
				return false;
				.*if (nodes.indexOf("Не е попълнено задължително поле!") === -1) {
					var errorText = document.createTextNode("Не е попълнено задължително поле!");
					regBtn.parentNode.insertBefore(errorText, regBtn);
				};*/
				//console.log('im here!');*/
				return false;
			};
		}
	</script>
</body>
</html>