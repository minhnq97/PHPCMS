<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Session.php");?>
<?php require_once("Include/Functions.php");?>
<?php 
	if(isset($_POST["Login"])){
		$Username = trim($_POST["Username"]);
		$Password = trim($_POST["Password"]);
		// $Remember = trim($_POST["Remember"]);
		if(empty($Username)){
			$_SESSION["ErrorMessage"] = "Please enter your username";
			Redirect_to("login.php");
		} elseif(empty($Password)){
			$_SESSION["ErrorMessage"] = "Please enter your password";
			Redirect_to("login.php");
		} else {
			$sql = "SELECT 
					`Id`, `Username`, `Password`, `Email`, `Avatar`, `IsAdmin` 
					FROM 
					`user` 
					WHERE `Username` = '".$Username."'";
			$result = mysqli_query($Connection,$sql);
			$row=mysqli_fetch_assoc($result);
			if(strcmp($row["Password"],$Password)==0){
				$_SESSION["UserId"] = $row["Id"];
				$_SESSION["Username"] = $row["Username"];
				$_SESSION["IsAdmin"] = $row["IsAdmin"];
				if($row["IsAdmin"]==0){
					Redirect_to("viewblog.php");
				} else {
					$_SESSION["SuccessMessage"] = "Welcome ".$Username."!";
					Redirect_to("dashboard.php");
				}
			} else {
				$_SESSION["ErrorMessage"] = "Incorrect username or password. Please try again!";
				Redirect_to("login.php");
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<!-- <link rel="stylesheet" type="text/css" href="style/materialize.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="offset-sm-3 col-sm-6" id="loginForm">
			<div class="card">
				<img class="card-img-top center-block" src="img/default-avatar.png" alt="Card image cap">
				<div class="card-block">
					<div class="form-group">
						<form action="login.php" method="POST">
							<div class="input-group username">
							  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user-circle fa-2" aria-hidden="true"></i></span>
							  <input type="text" class="form-control" name="Username" placeholder="Username" aria-describedby="basic-addon1">
							</div>

							<div class="input-group password">
							  <span class="input-group-addon" id="basic-addon2"><i class="fa fa-lock fa-2" aria-hidden="true" style="width: 16px;"></i></span>
							  <input type="password" class="form-control" name="Password" placeholder="Password" aria-describedby="basic-addon2">
							</div>
							
						<div class="checkbox">
					  		<label class="custom-control custom-checkbox">
							  <input type="checkbox" class="custom-control-input" name="Remember">
							  <span class="custom-control-indicator"></span>
							  <span class="custom-control-description">Remember me</span>
							</label>
						</div>
<span class="forget"><a href="#">Forget password?</a></span>
							<button type="submit"  name="Login" class="form-control btn btn-danger">Login</button>
						</form>	
					</div>
				</div>
			</div>
			<div class="register text-center">
				<?php echo SuccessMessage()?>
				<?php echo Message()?>
				<p><strong>Haven't had an account yet? </strong> Click here to <strong><a href="register.php">register</a></strong>!</p>
			</div>
		</div>
	</div>
</body>
</html>