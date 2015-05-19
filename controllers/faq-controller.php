<?php
	require_once '../functions/dbquery.php';
	$faq = getData('faq', ['question', 'answer']);
	if (count($faq) == 0) {
		echo 'Все още няма информация.';
	}

	for ($i=0; $i < count($faq); $i++) { 
		echo 
			'<dt class="faq-question">'
				. $faq[$i]->question .
			'</dt>
			<dd>'
				. $faq[$i]->answer .
			'</dd>';
	}
?>