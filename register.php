<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Session.php");?>
<?php require_once("Include/Functions.php");?>
<?php 
	if(isset($_POST["Register"])){
		$Username = trim($_POST["Username"]);
		$Password = trim($_POST["Password"]);
		$Email = trim($_POST["Email"]);
		$ConfirmPassword = trim($_POST["Confirm"]);
		if(empty($Username)){
			$_SESSION["ErrorMessage"] = "Please enter your username";
			Redirect_to("register.php");
		} elseif (empty($Email)){
			$_SESSION["ErrorMessage"] = "Please enter your email";
			Redirect_to("register.php");
		} elseif (empty($Password)){
			$_SESSION["ErrorMessage"] = "Please enter your password";
			Redirect_to("register.php");
		} elseif (empty($ConfirmPassword)){
			$_SESSION["ErrorMessage"] = "Please confirm your password";
			Redirect_to("register.php");
		} else {
			$sql = "INSERT INTO
					`user`(`Username`, `Password`, `Email`, `Avatar`, `IsAdmin`) 
					VALUES 
					('".$Username."','".$Password."','".$Email."','default-avatar.png',0)"	;
			$result = mysqli_query($Connection,$sql);
			if(!empty($result)){
				$_SESSION["SuccessMessage"] = "Account ".$Username." is created successfully";
				Redirect_to("register.php");
			} else {
				$_SESSION["ErrorMessage"] = "Error on saving to database";
				Redirect_to("register.php");
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>
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
	<div class="row">
		<div class="col-sm-6 nopadding">
			<div class="card">
				<img class="card-img-top center-block" src="img/default-avatar.png" alt="Card image cap">
				<div class="card-block">
					<div class="form-group">
						<button type="button"  name="Browse" class="text-center btn btn-danger">Choose avatar</button>
					</div>
				</div>
			</div>
		</div> 
		<div class="col-sm-6 nopadding">
			<div class="card">
				<div class="card-block">
					<div class="form-group userInfo">
						<h2 class="card-title">Registration form</h2>
						<form action="register.php" method="POST">
							<div class="input-group username">
							  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user-circle fa-2" aria-hidden="true"></i></span>
							  <input type="text" class="form-control" name="Username" placeholder="Username" aria-describedby="basic-addon1">
							</div>

							<div class="input-group email">
							  <span class="input-group-addon" id="basic-addon2"><i class="fa fa-envelope-open-o fa-2" aria-hidden="true" style="width: 16px;"></i></span>
							  <input type="email" class="form-control" name="Email" placeholder="Email" aria-describedby="basic-addon2">
							</div>
							
							<div class="input-group password">
							  <span class="input-group-addon" id="basic-addon3"><i class="fa fa-lock fa-2" aria-hidden="true" style="width: 16px;"></i></span>
							  <input type="password" class="form-control" name="Password" placeholder="Password" aria-describedby="basic-addon3">
							</div>

							<div class="input-group confirm">
							  <span class="input-group-addon" id="basic-addon4"><i class="fa fa-wrench fa-2" aria-hidden="true" style="width: 16px;"></i></span>
							  <input type="password" class="form-control" name="Confirm" placeholder="Confirm password" aria-describedby="basic-addon4">
							</div>

							<button type="submit"  name="Register" class="text-center btn btn-danger btnregister">Register</button>
						</form>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="login text-center">
		<?php echo Message(); ?>
		<?php echo SuccessMessage(); ?>
		<p><strong>Had an account? </strong>Click here to <strong><a href="login.php">login</a></strong>!</p>
	</div>
	</div>
</body>
</html>