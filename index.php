<!doctype html>
<html>
<head>
	<title>Hey!!!</title>
	<script>
	
	function get_passwd(numbers, valid_char, len, method, random){
		var xmlhttp;
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}
		else{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				var passwds = JSON.parse(xmlhttp.responseText)['data']['password'];
				var tmp = "";
				passwds.forEach(function parse_passwds(passwd){
						tmp = tmp + passwd + " ";
					});
				document.getElementById("show_passwd").innerHTML = tmp + "</br>";
			}
		}
		xmlhttp.open("POST", "random.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("number=" + numbers + 
				"&valid_char=" + valid_char +
				"&len=" + len + 
				"&method=" + method + 
				"&random=" + random);
	}
	function request_passwd(){
		var inputs = document.getElementsByTagName("form")[0].getElementsByTagName("input");
		get_passwd(inputs[0].value
				, inputs[1].value
				, inputs[2].value
				, inputs[3].value
				, inputs[4].value);
	}
	
	</script>
</head>
	<form action="random.php" method="post">
		<input type="text" name="number">
		<br/>
		<input type="text" name="valid_char">
		<br/>
		<input type="text" name="len">
		<br/>
		<input type="text" name="method">
		<br/>
		<input type="text" name="random">
		<br/>
		<input type="submit" value="submit">
		<button type="button" onclick='get_passwd("200", "0123456789", "6", "1", "1")'> Request Password</button>
		<button type="button" onclick='request_passwd()'>Test</button>
	
	</form>
	<p id="show_passwd">Who am I? What am I doing?</p>

<body>
</body>
</html>
