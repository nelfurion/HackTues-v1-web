<!--
	Fetches the data, from the database,
	 and sends it to the content handler.
 -->

<?php
	require '../../../core/init.php';
	require '../../../classes/common/config.php';
	require '../../../classes/common/database.php';

	function getData($table)
	{
		$db = Database::getInstance();
		$db->rawQuery("SELECT name, content FROM news", array());
		return $db->getResults();
	}

	/*function getData($type) {
		/*this should be changed, to be compatible with the server db's
		  shoud be able to create array with fields,
		  to be selected in the query*/
	/*	  $dbname;
		  $sql;
		switch ($type) {
			case 'news':
				$dbname = 'news';
				$sql = "SELECT id, name, content FROM articles";
				break;
			case 'competitors':
				$dbname = 'competitors';
				break;
			case 'sponsors':
				$dbname = 'sponsors';
				break;
			case 'user':
				$dbname = 'admins';
				break;
			case 'teams':
				$dbname = 'teams';
				break;
			case 'crew':
				$dbname = 'crew';
				break;	
			default:
				return "Bad data type!";
				break;
		}
		$servername = 'localhost';
		$username = 'root';
		$password = '';
		

		//creates the connection
		if (!$dbname) {
			echo "Bad data type! Could not resolve db connection.";
		}
		$conn = new mysqli($servername, $username, $password, $dbname);

		//check for errors
		if ($conn->connect_error) {
			die("Connection to database failed!" . $conn->connect_error);
		}

		//query the db
		if (!$sql) {
			//not sure if return or echo
			return "Bad data type!";
			echo "Bad data type! Could not resolve query.";
		}

		$result = $conn->query($sql);

		return $result;

		//close connection
		mysqli_close($conn);
	}*/
 ?>