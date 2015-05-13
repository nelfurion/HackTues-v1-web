<?php
	require '../scripts/dbquery.php';

	$reqData = ["name", "content"];
	$news = getData("news", $reqData);

	if (!count($news)) {
		echo "В момента няма информация.";
		return;
	}

	for ($i=0; $i < count($news); $i++) { 
		echo
			"<article class=\"newsArticle clear\">
				<h3>" . $news[$i]->name . "</h3>
				<p>" . $news[$i]->content . "</p>
			</article>";
	}
?>