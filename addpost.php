<?php require_once("Include/DB.php");?>
<?php require_once("Include/Session.php");?>
<?php require_once("Include/Functions.php");?>
<?php echo RequiredLogin();?>
<?php echo RequiredAdmin();?>
<?php
	if(isset($_POST["Submit"])){
		$Category = trim($_POST['Category']);
		$Title = trim($_POST['Title']);
		$Content = trim($_POST['Content']);
		$Image = $_FILES["Image"]["name"];
		$Target = "Upload/".basename($_FILES["Image"]["name"]);
		if(empty($Category)){
			$_SESSION["ErrorMessage"] = "You must choose a category";
			Redirect_to("addpost.php");
		} elseif(empty($Title)){
			$_SESSION["ErrorMessage"] = "Title cannot be left empty";
			Redirect_to("addpost.php");
		} elseif (empty($Content)) {
			$_SESSION["ErrorMessage"] = "Content cannot be left empty";
			Redirect_to("addpost.php");
		} else {
			$datetime = time();
			$CurrentTime = strftime("%Y-%m-%d %H:%M:%S",$datetime);		
			$sql = "INSERT INTO
					`post`(`CategoryId`, `Title`, `Datetime`, `Content`, `Image`, `Author`)
					VALUES 
					('".$Category."','".$Title."','".$CurrentTime."','".$Content."','".$Image."','".$_SESSION['Username']."')";
			$result = mysqli_query($Connection,$sql);
			if(!empty($result)){
				move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
				$_SESSION["SuccessMessage"] = "New post added successfully";
				Redirect_to("addpost.php");
			} else {
				$_SESSION["ErrorMessage"] = "Error on saving to database";
				Redirect_to("addpost.php");
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add post</title>
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
					<li class="active"><a href="addpost.php"><span class="glyphicon glyphicon-plus"></span>
					Add New Post</a></li>
					<li><a href="categories.php"><span class="glyphicon glyphicon-list-alt"></span>
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
				<h1>Add new post</h1>
				<div>
					<?php echo Message(); ?>
					<?php echo SuccessMessage(); ?>
				</div>
				<form action="addpost.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="title">Title:</label></br>
						<input type="text" name="Title" id="title" class="form-control" placeholder="Title">
					</div>
					<div class="form-group">
						<label for="category">Category:</label></br>
						<select class="form-control" id="category" name="Category">
							<?php
							$sql = "SELECT
									`Id`, `Name`, `Datetime`, `Creator`
									FROM 
									`category` 
									ORDER BY 
									`Id`"	;
							$result = mysqli_query($Connection,$sql);
							while($row=mysqli_fetch_assoc($result)){
								$info = $row;
							?>
							<option value="<?php echo $info["Id"] ?>"><?php echo $info["Name"] ?></option>
							<?php
							} 
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="image">Select Image:</label></br>
						<input type="file" name="Image" id="image" class="form-control">
					</div>
					<div class="form-group">
						<label for="content">Content:</label></br>
						<textarea class="form-control" id="content" name="Content"></textarea>
					</div>
					<input type="submit" name="Submit" value="Add new post" class="btn btn-info">
				</form>	
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