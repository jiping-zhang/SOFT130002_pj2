const nickNameCheck = function ()
{
	const nickName = document.getElementById("nickName");
	const wrongNMText = document.getElementById("wrongNickName");
	return function ()
	{
		if (nickName.checkValidity())
			wrongNMText.style.color = "#999999";
		else
			wrongNMText.style.color = "#ffd2d2";
	}
}();

const userNameCheck = function ()
{
	const userName = document.getElementById("userName");
	const wrongUNText = document.getElementById("wrongUserName");
	return function ()
	{
		if (userName.checkValidity())
			wrongUNText.style.color = "#999999";
		else
			wrongUNText.style.color = "#ffd2d2";
	}
}();

const passwordCheck = function ()
{
	const password = document.getElementById("password");
	const wrongPwText = document.getElementById("wrongPw");
	return function ()
	{
		if (password.checkValidity())
			wrongPwText.style.color = "#999999";
		else
			wrongPwText.style.color = "#ffd2d2";
	}
}();

const rePasswordCheck = function ()
{
	const password = document.getElementById("password");
	const rePassword = document.getElementById("rePassword");
	const wrongRePwText = document.getElementById("wrongRePw");
	return function ()
	{
		if (password.value === rePassword.value)
			wrongRePwText.style.color = "#999999";
		else
			wrongRePwText.style.color = "#ffd2d2";
	}
}();

const submitForm = function ()
{
	const userName = document.getElementById("userName");
	const isAvailableUserNameText = document.getElementById("isAvailableUserNameText");
	const password = document.getElementById("password");
	const rePassword = document.getElementById("rePassword");
	const signUpForm = document.getElementById("signUpForm");
	const nickName = document.getElementById("nickName");
	const isAvailableNickNameText = document.getElementById("isAvailableNickNameText");
	const passwordIntensity=document.getElementById('intensity');
	return function ()
	{
		let rightNickName, isAvailableNickName;
		if (nickName === null)
			rightNickName = isAvailableNickName = true;
		else
		{
			rightNickName = nickName.checkValidity();
			isAvailableNickName = (isAvailableNickNameText.innerHTML === "可用");
		}
		if (rightNickName)
		{
			if (isAvailableNickName)
			{
				if (userName.checkValidity())
				{
					if (isAvailableUserNameText.innerHTML === "可用" || isAvailableUserNameText.innerHTML === "存在")
					{
						if (password.checkValidity())
						{
							if (passwordIntensity.value!=='极弱')
							{
								if (password.value === rePassword.value)
								{
									signUpForm.submit();
								}
								else
									alert("两次输入的密码不一样！");
							}
							else
								alert("密码强度太弱")
						}
						else
							alert("密码需由8-16位英语字母或数字组成");
					}
					else
						alert("请检查邮箱是否重复")
				}
				else
					alert("邮箱名需为有效邮箱地址");
			}
			else
				alert("请检查用户名是否重复")
		}
		else
			alert("昵称需由6-16位 字母或数字或_ 组成")
	}
}();