<?php require_once("Include/DB.php");?>
<?php require_once("Include/Session.php");?>
<?php require_once("Include/Functions.php");?>
<?php echo RequiredLogin();?>
<?php echo RequiredAdmin();?>
<?php
	if(isset($_POST["Submit"])){
		$Category = trim($_POST['Category']);
		if(empty($Category)){
			$_SESSION["ErrorMessage"] = "All field must be filled out";
			Redirect_to("categories.php");
			exit;
		} else {
			$datetime = time();
			$CurrentTime = strftime("%Y-%m-%d %H:%M:%S",$datetime);		
			$sql = "INSERT INTO
					`category`(`Name`, `Datetime`, `Creator`)
					VALUES 
					('".$_POST['Category']."','".$CurrentTime."','Admin')"	;
			$result = mysqli_query($Connection,$sql);
			if(!empty($result)){
				$_SESSION["SuccessMessage"] = "Category added ".$_POST['Category']." successfully";
				Redirect_to("categories.php");
			} else {
				$_SESSION["ErrorMessage"] = "Error on saving to database";
				Redirect_to("categories.php");
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Categories</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2" id="sideBar">
				<h1 style="color: white;">PHPCMS</h1>
				<ul class="nav nav-pills nav-stacked" id="side-menu">
					<li><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>
					Dashboard</a></li>
					<li><a href="addpost.php"><span class="glyphicon glyphicon-plus"></span>
					Add New Post</a></li>
					<li class="active"><a href="categories.php"><span class="glyphicon glyphicon-list-alt"></span>
					Categories</a></li>
					<li><a href="manageadmin.php"><span class="glyphicon glyphicon-cog"></span>
					Manage Admin</a></li>
					<li><a href="managecomment.php"><span class="glyphicon glyphicon-envelope"></span>
					Comments</a></li>
					<li><a href="viewblog.php"><span class="glyphicon glyphicon-book"></span>
					Live Blog</a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>
					Logout</a></li>
				</ul>
			</div>
			<div class="col-sm-10" id="mainPage">
				<h1>Manage Categories</h1>
				<div>
					<?php echo Message(); ?>
					<?php echo SuccessMessage(); ?>
				</div>
				<form action="categories.php" method="POST">
					<div class="form-group">
						<label>Name:</label></br>
						<input type="text" name="Category" id="category" class="form-control" placeholder="Name">
					</div>
					<input type="submit" name="Submit" value="Add category" class="btn btn-info">
				</form>	
				<div class="table-responsive">
					<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Datetime</th>
						<th>Creator</th>
						<th>Action</th>
					</tr>
					<?php
					$sql = "SELECT
							`Id`, `Name`, `Datetime`, `Creator`
							FROM 
							`category` 
							ORDER BY 
							`Id`"	;
					$result = mysqli_query($Connection,$sql);
					$NoOrder = 1;
					while($row=mysqli_fetch_assoc($result)){
						$info = $row;
						// var_dump($info);
					?>
					<tr>
						<td><?php echo $NoOrder ?></td>
						<td><?php echo $info["Name"] ?></td>
						<td><?php echo $info["Datetime"] ?></td>
						<td><?php echo $info["Creator"] ?></td>
						<td><a href="removecategory.php?CategoryId=<?php echo $info["Id"];?>"><button type="button" class="btn btn-danger">Remove</button></a></td>
					</tr>
					<?php
						$NoOrder++;
					} 
					?>
				</table>
				</div>
				
				
			</div>
		</div>
	</div>
	<div id="footer">
		<hr>
		<p>Theme By | MinhNQ</p>
		<p>This site is only for study purpose</p>
	</div>
	<div style="height: 10px; background-color: #27aae1"></div>
</body>
</html>