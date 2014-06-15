function name_required(field,alerttxt){
	with (field)
  	{
		if (value.length<6)
			{alert(alerttxt);return false;}
		else {return true}
	}
}

function pwd_required(a,alerttxt){
	var pwdt;
	with (a){
		if (value.length<6)
			{alert(alerttxt);
			return false;}
		}
	return true;
}

function repeat_pwd_required(a,b,alerttxt){
	var pwdt;
	with (a){
		pwdt = value;
		with (b){
			if (value!=pwdt){
				alert(alerttxt);
				return false;
			}
		}
	}
	return true;
}

function email_required(a,alerttxt){
	var pwdt;
	with (a){
		if (value.length<1)
			{alert(alerttxt);
			return false;}
		}
	return true;
}

function validate_form(thisform){
	with (thisform)
		{
		if (pwd_required(inputUserName,"用户名过短！最少6字符")==false)
			{inputUserName.focus();return false;}
		if (name_required(inputPassword,"密码过短！最少6字符")==false)
			{inputPassword.focus();return false;}
		}
	document.getElementById('submit').disabled = true;
	return true;
}

function validate_register_form(thisform){
	with (thisform){
		if (pwd_required(inputUserName,"用户名过短！最少6字符")==false)
			{inputUserName.focus();return false;}
		if (name_required(inputPassword,"密码过短！最少6字符")==false)
			{inputPassword.focus();return false;}
		if (repeat_pwd_required(inputPassword,inputRePassword,"两次输入密码不相同！")==false)
			{inputPassword.focus();return false;}
		if (email_required(inputEmail,"邮箱不得为空！")==false)
			{inputEmail.focus();return false;}
	}
	document.getElementById('submit').disabled = true;
	return true;
}
