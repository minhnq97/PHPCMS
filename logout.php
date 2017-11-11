<?php require_once("Include/Session.php");?>
<?php require_once("Include/Functions.php");?>
<?php
	$_SESSION["UserId"] = null;
	$_SESSION["Username"] = null;
	$_SESSION["IsAdmin"] = null;
	session_destroy();
	Redirect_to("login.php");
?>