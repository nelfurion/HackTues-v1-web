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
				var name = document.getElementById('articleName').innerHTML;
				var content = nicEditors.findEditor('niceditArea').getContent();
				
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