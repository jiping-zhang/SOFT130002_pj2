document.getElementById("file0").addEventListener('change',function ()
{
	let objUrl = getObjectURL(document.getElementById("file0").files[0]);
	if (objUrl!="")
	{
		document.getElementById("imgContainer0").innerHTML='<img src="'+objUrl+'" class="contImg" id="img0">';
		/*document.getElementById('img0').onload=function ()
		{
			stretchImage();
		}*/
		document.getElementById('img0').addEventListener('load',function (){stretchImage()});
	}
});

function getObjectURL(file) {
	let url = null;
	if(window.createObjectURL!=undefined) {
		url = window.createObjectURL(file) ;
	}else if (window.URL!=undefined) { // mozilla(firefox)
		url = window.URL.createObjectURL(file) ;
	}else if (window.webkitURL!=undefined) { // webkit or chrome
		url = window.webkitURL.createObjectURL(file) ;
	}
	return url ;
}