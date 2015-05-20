/*
	Very simple ajax library.

	NOTE: the parameter.done function can use the xmlhttp variable in its scope.
		 There is no need to return it, in order to use it there.
*/

function AJAXRequest (filepath, params) {
	if (!filepath) {
		alert("BAD REQUEST: filepath missing!");
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
	/*With params.containerId, we indicate where the responseText should be placed.*/
	if (params.containerId) {
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				if (params.concat) {
					document.getElementById(params.containerId).innerHTML += xmlhttp.responseText;
				} else {
					document.getElementById(params.containerId).innerHTML = xmlhttp.responseText;
				}
				
			};
		};
	}
	else if(params.done){
		/*If containerId is not given, we indicate what should be done when the request finishes.
			params.done should be a javascript function. */
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				/*Calls the function, passed as a parameter.*/
				params.done.call();
			};
		};
	}
	/*Alternatively, we colud just add a 
	'return xmlhttp;' at the end of this file, to handle the output elsewhere.*/

	/*For older browsers, which do not support Object.keys()
	 From https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/keys*/
	if (!Object.keys) {
	  Object.keys = (function() {
	    'use strict';
	    var hasOwnProperty = Object.prototype.hasOwnProperty,
	        hasDontEnumBug = !({ toString: null }).propertyIsEnumerable('toString'),
	        dontEnums = [
	          'toString',
	          'toLocaleString',
	          'valueOf',
	          'hasOwnProperty',
	          'isPrototypeOf',
	          'propertyIsEnumerable',
	          'constructor'
	        ],
	        dontEnumsLength = dontEnums.length;

	    return function(obj) {
	      if (typeof obj !== 'object' && (typeof obj !== 'function' || obj === null)) {
	        throw new TypeError('Object.keys called on non-object');
	      }

	      var result = [], prop, i;

	      for (prop in obj) {
	        if (hasOwnProperty.call(obj, prop)) {
	          result.push(prop);
	        }
	      }

	      if (hasDontEnumBug) {
	        for (i = 0; i < dontEnumsLength; i++) {
	          if (hasOwnProperty.call(obj, dontEnums[i])) {
	            result.push(dontEnums[i]);
	          }
	        }
	      }
	      return result;
	    };
	  }());
	}
	
	/* Build the request params */
	var request = filepath + "?";

	var paramKeys = Object.keys(params);

	for (var i = 0; i < paramKeys.length; i++) {
		request += paramKeys[i] + "=" + params[paramKeys[i]];
		request += "&";
	};
	
	if(params.func !== undefined)
	{
		request += params.func !== undefined ? "func=" + params.func : "";
		request += "&";
	}

	//opens the request, with unique value, so it is not cached
	xmlhttp.open("POST", request + "t=" + Math.random(), true)
	xmlhttp.send();

	/*Uncomment this line, if you want the output of the request to be handled elsewhere, outside of the request itself.
	Only do this if you explicitly need to return the request object. Otherwise just use the variable in a done property function.*/
	//return xmlhttp;
}