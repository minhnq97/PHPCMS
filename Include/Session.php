<?php require_once("Include/Functions.php");?>
<?php
	session_start();
	function Message(){
		if(isset($_SESSION["ErrorMessage"])){
			$Output = "<div class='alert alert-danger'>";
			$Output.= htmlentities($_SESSION["ErrorMessage"]);
			$Output.= "</div>";
			$_SESSION["ErrorMessage"] = null;
			return $Output;
		}
	}

	function SuccessMessage(){
		if(isset($_SESSION["SuccessMessage"])){
			$Output = "<div class='alert alert-info'>";
			$Output.= htmlentities($_SESSION["SuccessMessage"]);
			$Output.= "</div>";
			$_SESSION["SuccessMessage"] = null;
			return $Output;		
		}
	}

	function RequiredLogin(){
		if(!isset($_SESSION["UserId"])){
			Redirect_to("login.php");
		}
	}

	function RequiredAdmin(){
		if($_SESSION["IsAdmin"]!=1){
			Redirect_to("viewblog.php");
		}
	}
?>