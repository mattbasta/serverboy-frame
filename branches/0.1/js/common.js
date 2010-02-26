/*
	Serverboy Frame
	Common Library
*/

function g(x) {return document.getElementById(x);}

function Frame() {}
Frame.prototype.g = g;
Frame.prototype.loadhooks = [];
document.frame = new base();

function registerFrame(name, module) {
	document.frame[name] = module;
	document.frame.loadhooks[document.frame.loadhooks.length] = module.init;
}


window.onload = function() {
	
	
}