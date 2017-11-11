<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Session.php");?>
<?php require_once("Include/Functions.php");?>
<?php echo RequiredLogin();?>
<?php echo RequiredAdmin();?>
<?php
	$sql = "DELETE FROM `comment` WHERE `Id` = '".$_GET['CommentId']."'";
	$result = mysqli_query($Connection,$sql);
	if(mysqli_affected_rows($Connection)){
		$_SESSION["SuccessMessage"] = "Delete comment successfully.";
		Redirect_to("managecomment.php");
	} else {
		$_SESSION["ErrorMessage"] = "Cannot delete this comment.";
		Redirect_to("managecomment.php");
	}
?>