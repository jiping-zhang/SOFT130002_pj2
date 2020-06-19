<!DOCTYPE html>
<html lang="en">
<head>
    <title>canvas</title>
</head>
<body>
<canvas width="10" height="10"></canvas>
<script>
	var canvas = document.getElementsByTagName('canvas')[0];
	var dataURL = canvas.toDataURL('image/jpeg',0.6);
	console.log(dataURL);
</script>
</body>
</html>