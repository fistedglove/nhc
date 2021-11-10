// JavaScript Document

/**/

function setAmount(){
	
	var quan = document.getElementById("quantity");
	var price = document.getElementById("price");
	var amount = document.getElementById("amount");
	
	amount.value = quan.value * price.value;
		
	}

function setFee(){
	
	var dur = document.getElementById("duration");
	var fee = document.getElementById("monthlyfee");
	var total = document.getElementById("totalfee");
	
	total.value = Math.ceil(dur.value * fee.value);
		
	}


function displayForm(){
		var e = document.getElementById("registerForm");
		if(e.style.display != "inline"){
		document.getElementById("registerForm").style.display = "inline";
		document.getElementById("loginForm").style.display = "none";
		}else {
			document.getElementById("registerForm").style.display = "none";
		}
		
	}
/**/
function displayPassword(){
		var e = document.getElementById("changePassword");
		if(e.style.display != "inline"){
		document.getElementById("changePassword").style.display = "inline";
		
		}else {
			document.getElementById("changePassword").style.display = "none";
		}
		
	}
/**/
function validatePass(){
		
		var p = document.getElementById("userCheck");	
		var pass = document.getElementById("pass");
		var conpass = document.getElementById("conpass");
		if(pass.value != conpass.value){	
		alert("Password Does Not Match.");
		return false;
		}else if(p.innerHTML == "Username is not Available"){
			
		alert("Username is not Available! Please choose another");
		return false;	
		}			 
}
/**/
window.onload = function(){
		
		 new JsDatePick({
			useMode:2,
			isStripped:false,
			target:"date",
            dateFormat:"%M %d, %Y",
			cellColorScheme:"beige",
            yearsRange:[1900,2020],
            imgPath:"img/"
		});
        
	};
/**/	
function displayDetails(){
		var e = document.getElementById("orderDetailsTbl");
		if(e.style.display != "inline"){
		document.getElementById("orderDetailsTbl").style.display = "inline";
		}else {
			document.getElementById("orderDetailsTbl").style.display = "none";
		}
		
	}