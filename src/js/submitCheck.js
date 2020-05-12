let captchaAns;

const shiftCaptchaText = function ()
{
	const captchaText = document.getElementById("captchaText");
	return function ()
	{
		let a = Math.floor(50.0 * Math.random());
		let b = Math.floor(a * Math.random());
		let c = Math.floor(2.0 * Math.random());
		switch (c)
		{
			case 0:
				captchaText.innerHTML = ("" + a + " + " + b + " = ");
				captchaAns = a + b;
				break;
			case 1:
				captchaText.innerHTML = ("" + a + " - " + b + " = ");
				captchaAns = a - b;
				break;
		}
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
	const isAvailableUserNameText=document.getElementById("isAvailableUserNameText");
	const password = document.getElementById("password");
	const rePassword = document.getElementById("rePassword");
	//const iAgree = document.getElementById("iAgree");
	const signUpForm = document.getElementById("signUpForm");
	//const captchaInput = document.getElementById("captchaInput");
	return function ()
	{
		if (userName.checkValidity())
		{
			if (isAvailableUserNameText.innerHTML==="可用"||isAvailableUserNameText.innerHTML==="存在")
			{
				if (password.checkValidity())
				{
					if (password.value === rePassword.value)
					{
						signUpForm.submit();
					}
					else
						alert("两次输入的密码不一样！");
				}
				else
					alert("密码需由8-16位英语字母或数字组成");
			}
			else
				alert("请检查用户名")
		}
		else
			alert("用户名需为有效邮箱地址");
	}
}();

/*	var setCity = (function ()
	{
		var provinceForm = document.getElementById("provinceForm");
		var cityForm = document.getElementById("cityForm");
		city = new Object();
		city['Shanghai'] = ['Yangpu district', 'Minghang district', 'Pudong new district'];
		city['Beijing'] = ['Haiding district'];
		city['Jiangsu'] = ['Suzhou', 'Wuxi', 'Nanjing', 'Changzhou', 'Nantong'];
		city['Zhejiang'] = ['Hangzhou', 'Ninbo', 'Wenzhou'];
		city['Guangdong'] = ['Guangzhou', 'Shenzhen', 'Foshan', 'Dongguan'];
		return function ()
		{
			var provinceValue = provinceForm.value;
			var i;
			cityForm.length = 1;
			if (provinceValue == '0') return;
			if (typeof (city[provinceValue]) == 'undefined') return;
			for (i = 0; i < city[provinceValue].length; i++)
			{
				cityForm.options[i + 1] = new Option();
				cityForm.options[i + 1].text = city[provinceValue][i];
				cityForm.options[i + 1].value = city[provinceValue][i];
			}
		}
	})();*/

//shiftCaptchaText();
