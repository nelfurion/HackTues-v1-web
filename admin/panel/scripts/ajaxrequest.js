function makeRequest (filepath) {
			if (!filepath) {
				alert("BAD REQUEST! - filepath");
				return;
			};

			//IE7+, Firefox, Chrome, Opera, Safari
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}
			else {
				//IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("content").innerHTML = xmlhttp.responseText;
				};
			};

			//opens the request, with unique value, so it is not cached
			xmlhttp.open("POST",filepath + "?t=" + Math.random(), true);
			xmlhttp.send();
		}