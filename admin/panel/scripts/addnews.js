function escapeHtml(str) {
    return String(str)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;")
        .replace(/\//g, "&#x2F;")
}

function addArticle () {
	var section = document.getElementById("content");
	var firstArticle = document.querySelector(".newsArticle");

	var input = document.createElement('input');
	input.id="articleName";
	input.type="text";

	var textarea = document.createElement('textarea');
	textarea.cols = "80";
	textarea.rows = "5";
	textarea.id = "niceditArea";

	var areaHolder = document.createElement('div');
	areaHolder.id = "areaHolder";

	areaHolder.appendChild(input);
	areaHolder.appendChild(textarea);

	section.insertBefore(areaHolder, firstArticle);

	new nicEditor({
			fullPanel : true, onSave : function(content, id, instance) {
				var name = escapeHtml(document.getElementById('articleName').innerHTML);
				if (!name) {
					alert('You must add a name to the piece of news!');
					return;
				};

				var content = escapeHtml(nicEditors.findEditor('niceditArea').getContent());
				if (!content) {
					alert('The news must have content!');
				};
				//AJAXRequest uses AJAX script to contact the server
				AJAXRequest(
					"scripts/dbquery.php",
				 	[
				 		{'name': name, 'content': content}
				 	],
					"saveNews"
				);

			} 
		}
  	).panelInstance('niceditArea');
}