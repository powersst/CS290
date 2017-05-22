// JavaScript Document




function checkFields(form) 
{
	alert("ENTERING FUNCTION.");
	var regexPassword = new RegExp("^[A-Z]+[a-zA-Z0-9]*([0-9]{2})$");
	var password = form.password1;
	
	//Valid password assign 4
	if(!regexPassword.test(password.value)) 
	{
		alert("Passwords must start with an uppercase letter and end with two digits.");
		password.value = "";
		password.focus();
		return false;
	}
	
	return true;
}