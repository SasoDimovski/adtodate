/*
url - klic jsp-ja, ki vrne podatke
div - koncni kontainer, kjer se rezultati prikazejo 
before - funkcija, ki se izvede pred klicem 
after - funkcija, ki se izvede po klicu 
popup - s klicem, lahko nafilamo ze prikazan kontainer, ali pa skritega, ki se pokaze kot popup 
*/ ﻿
function getJSP(url, div, before, after, popup) 
{ 
        //alert(url);
        //alert(div);
		//alert(after);
		//alert(popup);
		//return false;
	// ce url-ju dodamo vedno nov parameter - Date(), se s tem izognemo problemu osvezevanja v IE 
	//if ((url.indexOf(".php?") > -1)) 
	//{ url += '&date='+Date(); }
	//else { url += '?date='+Date(); }
	
	var ac = new ajaxCaller(url, div, before, after, popup); 
	ac.load(); 
}



function ajaxCaller(klic, div, before, after, popup) 
{ 
	this._klic = encodeURI(klic); 
	this._div = div; 
	this._before = before; 
	this._after = after; 
	this._popup = popup; 
	//alert(this._klic)
}




ajaxCaller.prototype.load = function()
{
	
	var _this = this;
	
	this._xhr = this._getXMLHTTPRequest();
	this._before;// tuka se definira (ili povikuva) funkcijata sto se izveduva prva posle klikot
    // ===================================================================================================================================
		if (this._before=="1")
		{
			document.getElementById(this._div).innerHTML ="<div style=\"text-align:center;\"><img  src=\"../img/ajax-loader1.gif\"></img></div>";
		}
		else
		{
			document.getElementById(this._div).innerHTML ="<div id=\"loader\" style=\"position: fixed;z-index: 17;width: 100%;height: 100%;margin: 0px;top: 0px;left: 0px;display: block;filter: alpha(opacity=75);-moz-opacity: 0.75;opacity:0.75;text-align:center;margin-top:20%\"><img  src=\"../img/ajax-loader.gif\"></img></div>";
		}
    // ===================================================================================================================================

	this._xhr.open("GET", this._generateDataUrl(), true); 					
	this._xhr.send(null); 
	
	this._xhr.onreadystatechange = function()
	{ _this._onData() }; 
	
		
}



ajaxCaller.prototype._generateDataUrl = function() 
{ return this._klic; }



ajaxCaller.prototype._onData = function() 
{ 
	if (this._xhr.readyState == 4) 
	{ 
		//if (this._xhr.status == 0) //ako je lokalno
		if (this._xhr.status == 200) 
		{ 

			if (this._popup == 1) { document.getElementById(this._div).style.display = "block"; }
			
			document.getElementById(this._div).innerHTML = this._xhr.responseText;
			
			
			
            // tuka se definira (ili povikuva) funkcijata sto se izveduva posledna posle klikot
			eval(this._after); 
		}
	} 
}






//All modern browsers (IE7+, Firefox, Chrome, Safari, and Opera) have a built-in XMLHttpRequest object.
//Syntax for creating an XMLHttpRequest object:
//xmlhttp=new XMLHttpRequest();
//Old versions of Internet Explorer (IE5 and IE6) uses an ActiveX Object:
//xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

ajaxCaller.prototype._getXMLHTTPRequest = function() 
{ 
	var xmlHttp; 
	try 
	{ 
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		//xmlHttp = new ActiveXObject("Msxml2.XMLHttp"); 
	} 
	catch (e) 
	{ 
		try 
		{ 
			xmlHttp = new ActiveXObject("Microsoft.XMLHttp");
		}
		catch (e2)
		{}
	}

	if (xmlHttp == undefined && (typeof XMLHttpRequest != 'undefined')) 
	{ 
		xmlHttp = new XMLHttpRequest(); 
	}

	return xmlHttp;
}