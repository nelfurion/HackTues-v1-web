<?php

	class Validate 
	{
		private $_passed = false,
				$_errors = array(),
				$_db = null;

		public function __construct()
		{
			$this->_db = Database::getInstance();
		}

		public function check($source, $items = array())
		{
			foreach($items as $item => $rules)
			{
				foreach ($rules as $rule => $rule_value)
				{
					$value = trim($source[$item]);
					$translatedItem = $this->toString(escape($item));					
					if ($rule == 'required' && empty($value))
					{
						$this->addError("Полето '{$translatedItem}' е задължително.");
					}
					else if(!empty($value))
					{
						switch ($rule)
						{
							case 'min_len':
								if (strlen($value) < $rule_value)
								{
									$this->addError("Полето '{$translatedItem}' трябва да бъде минимум {$rule_value} знака.");
								}
								break;
							case 'max_len':
								if (strlen($value) > $rule_value)
								{
									$this->addError("Полето '{$translatedItem}' не трябва да надвишава {$rule_value} знака.");
								}							
								break;
							case 'min_num':
								if ($value < $rule_value)
								{
									$this->addError("Стойността на полето '{$translatedItem}' трябва да е над {$rule_value}.");
								}
								break;
							case 'max_num':
								if ($value > $rule_value)
								{
									$this->addError("Стойността на полето '{$translatedItem}' не трябва да надвишава {$rule_value}.");									
								}
								break;
							case 'matches':
								if ($value != $source[$rule_value])
								{
									$this->addError("Въведените пароли не съвпадат.");
								}
								break;
							case 'unique':
								$check = $this->_db->select($rule_value, array($item, '=', $value));
								if ($check->getCount())
								{
									$this->addError("Въведеното потребителско име вече съществува в базата данни.");	
								}
								break;
						}
					}
				}
			}

			if (empty($this->_errors))
			{
				$this->_passed = true;
			}

			return $this;
		}

		private function addError($error)
		{
			$this->_errors[] = $error;
		}

		private function toString($item)
		{
			switch ($item) {
				case 'username':
					return 'потребител';
					break;
				case 'password':
					return 'парола';
					break;
				case 'password-again':
					return 'потвърди парола';
					break;
				case 'email':
					return 'е-поща';
					break;
				case 'firstname':
					return 'име';
					break;
				case 'lastname':
					return 'фамилия';
					break;
			}
		}

		public function getErrors()
		{
			return $this->_errors;
		}

		public function isPassed()
		{
			return $this->_passed;
		}
	}