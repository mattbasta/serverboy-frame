/*
	Serverboy Frame
	Form Validation
*/

var FrameValidation = {
	init: function() {
		
	},
	validate: function(e) {
		// To be called by each individual validatable control
	}
	submit: function(e) {
		
	},
	generateErrors: function() {
		var labels = document.getElementsByTagName("label");
		for(var i=0;i<labels.length;i++) {
			var l = labels[i];
			if(l.htmlFor=='' || l.className.indexOf('validate') > -1) {
				var div = document.createElement("div");
				div.className = "validationerror";
				div.id = l.id + "_vbox";
				var p = document.createElement("p");
				p.id = l.id + "_verror";
				p.innerHTML = "You cannot do this!";
				div.appendChild(p);
				
				l.appendChild(div);
			}
		}
	}
};
registerFrame('validation', FrameValidation);