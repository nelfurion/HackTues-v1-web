<section id="news-section">
	<h3>Новини</h3>
	<div id="news-container">
		<?php
			require_once 'controllers/news-controller.php';
		?>
	</div>
	<ul class="pagination" id="news-nav">
	  	<?php
			require_once 'controllers/news-controller.php';
			paginate();
		?>
	</ul>
</section>