<?php 
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$startPersonal = microtime(true);
	error_reporting(E_ALL);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$con = mysqli_connect('localhost','admin','','ip'); //REPLACE WITH YOUR VALUES
	$ip = ip2long($_POST['ip']);
	$result = mysqli_query($con, "SELECT country FROM geoip WHERE ip_from >= '".$ip."' AND '".$ip."' <= ip_to1"); //
	$row = mysqli_fetch_row($result);
	echo $row[0];
	echo microtime(true) - $startPersonal;
	die();

}
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<input type="text" id="input">
	<button id="check" onclick="check()">Check</button>

	<script>
		function check(){
			request = new XMLHttpRequest();
			request.open('POST', "index.php");
			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
			elem = document.getElementById("input");
			val = elem.value;
			request.onreadystatechange = function () {
	      		if (request.readyState == 4 && request.status == 200){
	      			alert(request.response);
				}
			}
			request.send("ip="+val);
		}
	</script>
</body>
</html>