<!--
	Fetches the news, from the database,
	 and populates the page with articles.
 -->

<?php
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'news';

	//creates the connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		//check for errors
		if ($conn->connect_error) {
			die("Connection to database failed!" . $conn->connect_error);
		}

		//query the db
		$sql = "SELECT id, name, content FROM articles";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			/*output data of each row
				and populate the page */
			while ($row = $result->fetch_assoc()) {
				echo
				"<article class=\"newsArticle\">
					<h3>" . $row['name'] . "</h3>
					<p>" . $row['content'] . "</p>
				</article>";
			}
		} else {
			echo "<p> Все още няма новини. </p>";
		}

		//close connection
		mysqli_close($conn);
 ?>