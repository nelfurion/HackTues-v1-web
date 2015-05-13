function AJAXRequest (filepath, fields, params, func) {
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
	//TODO: fix fields
	var request = filepath;
	if (fields.length > 0) {
		request += "&fields=";
		request += fields.join();
	};

	if (params) {
		//TODO: fix params
		for (var i = 0; i < params.length; i++) {
			request += "&" + params[i].name + "=" + params[i].value;
		}

		xmlhttp.open("POST", request + "?t=" + Math.random(), true)
	}
	else
	{
		request = func !== undefined ? "&func=" + func : "";
		xmlhttp.open("POST",filepath + "?t=" + Math.random() + func, true);
	}

	xmlhttp.send();
}