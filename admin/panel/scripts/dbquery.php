
<?php
	require '../../../classes/common/config.php';
	require '../../../classes/common/database.php';

	if (isset($_POST['func'])) {
		switch ($_POST['func']) {
			case 'saveData':
					saveData($_POST['table'], $_POST['sdata']);
				break;
			//TODO: fix getData and stuff
			default:
				
				break;
		}
	}

	/*
	 ---------------------------------
	Fetches the data, from the database,
	 and sends it to the content handler.
 	*/ 
	function getData($table, $data = array(), $parameters = array())
	{
		$selectedData = implode(", ", $data);
		if (!count($data)) {
			$selectedData = "*";
		}
		
		$db = Database::getInstance();

		$db->rawQuery("SELECT " . $selectedData . " FROM " .$table, $parameters);

		return $db->getResults();
	}

	function saveData($table, $data)
	{
		$db = Database::getInstance();
		//TODO: fix insert with fields, should get fields from $_POST['fields']
		$db->insert($table, $data);
		print_r("</br>");
		print_r($table);
		print_r($data);
	}
 ?>