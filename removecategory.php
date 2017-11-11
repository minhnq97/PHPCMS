<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Session.php");?>
<?php require_once("Include/Functions.php");?>
<?php echo RequiredLogin();?>
<?php echo RequiredAdmin();?>
<?php
	$sql = "DELETE FROM `category` WHERE `Id` = '".$_GET['CategoryId']."'";
	$result = mysqli_query($Connection,$sql);
	if(mysqli_affected_rows($Connection)){
		$_SESSION["SuccessMessage"] = "Delete category successfully.";
		Redirect_to("categories.php");
	} else {
		$_SESSION["ErrorMessage"] = "Cannot delete this category.";
		Redirect_to("categories.php");
	}
?>