<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Session.php");?>
<?php require_once("Include/Functions.php");?>
<?php echo RequiredLogin();?>
<?php echo RequiredAdmin();?>
<?php
	$sql = "UPDATE `comment` SET `IsApproved`= 1 WHERE `Id` = '".$_GET['CommentId']."'";
	$result = mysqli_query($Connection,$sql);
	if(mysqli_affected_rows($Connection)){
		$_SESSION["SuccessMessage"] = "Approved comment successfully.";
		Redirect_to("managecomment.php");
	} else {
		$_SESSION["ErrorMessage"] = "Cannot approve this comment.";
		Redirect_to("managecomment.php");
	}
?>