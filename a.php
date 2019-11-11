<?php
session_start();
if(empty($_SESSION['key']))
$_SESSION['key']=bin2hex(random_bytes(32));
$csrf=hash_hmac('sha256','this is some string:a.php',$_SESSION['key']);
if(isset($_POST['submit'])){
	if(hash_equals($csrf, $_POST['csrf'])){
		echo "Your name is:".$_POST['username'];

	}
	else
		echo 'CSRF Token Failed!';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CSRF ATTACK PREVENTION</title>
</head>
<body>
<form method="POST" action="a.php">
	<input type="text" name="username" placeholder="Enter ur name">
	<input type="hidden" name="csrf" value="<?php echo $csrf ?>">
<input type="submit" name="submit" value="SUBMIT">
	
</form>
</body>
</html>