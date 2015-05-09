<?php
	require 'dbquery.php';
	$dataType = htmlspecialchars($_GET['data']);

	if (!$dataType) {
		$message = "Bad data in request!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		return;
	}

	$data = getData($dataType);

	if ($data->num_rows <= 0) {
		echo "В момента няма информация.";
		return;
	}

	switch ($dataType) {
		case 'news':
				while ($row = $data->fetch_assoc()) {
					echo
						"<article class=\"newsArticle\">
							<h3>" . $row['name'] . "</h3>
							<p>" . $row['content'] . "</p>
						</article>";
				}
			break;
		default:
				echo $data;
			break;
	}

?>