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
	var newsAreaExists = document.getElementById('areaHolder');

	if (!newsAreaExists) {
		var nameLabel = document.createElement('label');
		nameLabel.htmlFor = "article-name";
		nameLabel.innerHTML = "<strong>Име<strong>:";

		var input = document.createElement('input');
		input.id="article-name";
		input.type="text";

		var contentLabel = document.createElement('label');
		contentLabel.htmlFor = "article-content";
		contentLabel.innerHTML = "<strong>Съдържание<strong>:";

		var textarea = document.createElement('textarea');
		textarea.cols = "80";
		textarea.rows = "5";
		textarea.id = "article-content";

		var areaHolder = document.createElement('div');
		areaHolder.id = "areaHolder";
		
		areaHolder.appendChild(nameLabel);
		areaHolder.appendChild(input);
		areaHolder.appendChild(contentLabel);
		areaHolder.appendChild(textarea);

		section.insertBefore(areaHolder, firstArticle);

		new nicEditor({
				fullPanel : true, onSave : function(content, id, instance) {
					var name = escapeHtml(document.getElementById('article-name').value);
					//console.log(document.getElementById('article-name').innerHTML);
					if (!name) {
						alert('You must add a name to the piece of news!');
						return;
					};

					var content = escapeHtml(nicEditors.findEditor('article-content').getContent());
					console.log("content: " + content);
					if (!content || content === '&lt;br&gt;') {
						alert('The news must have content!');
					}
					else {
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
			}
	  	).panelInstance('article-content');
	};
}