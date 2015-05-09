<?php
	require '../scripts/dbquery.php';

	$news = getData("news");

	if ($news->num_rows <= 0) {
		echo "В момента няма информация.";
		return;
	}
	
	while ($row = $news->fetch_assoc()) {
		echo
			"<article class=\"newsArticle\">
				<h3>" . $row['name'] . "</h3>
				<p>" . $row['content'] . "</p>
			</article>";
	}
?>