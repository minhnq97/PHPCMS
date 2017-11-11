<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Session.php");?>
<?php echo RequiredLogin();?>
<?php echo RequiredAdmin();?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2" id="sideBar">
				<h1 style="color: white;">PHPCMS</h1>
				<ul class="nav nav-pills nav-stacked" id="side-menu">
					<li class="active"><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>
					Dashboard</a></li>
					<li><a href="addpost.php"><span class="glyphicon glyphicon-plus"></span>
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
				<div>
					<?php echo SuccessMessage()?>
					<?php echo Message()?>
				</div>
				<h1>Dashboard</h1>
				<table class="table table-striped table-hover">
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Created date</th>
						<th>Author</th>
						<th>Category</th>
						<th>Comments</th>
						<th>Actions</th>
					</tr>
					<?php
						$sql = "SELECT
								`Id`, `CategoryId`, `Title`, `Datetime`, `Content`, `Image`, `Author` 
								FROM 
								`post`
								ORDER BY 
								`Id`";
						$result = mysqli_query($Connection, $sql);
						$NoSr = 1;
						while ($row=mysqli_fetch_assoc($result)) {
							$info = $row;
							$sqlCategory = "SELECT `Name` FROM `category` WHERE `Id` = ".$info["CategoryId"];
							$subResult = mysqli_query($Connection, $sqlCategory);
							$category = mysqli_fetch_assoc($subResult);
					?>
					<tr>
						<td><?php echo $NoSr;?></td>
						<td><?php echo $info["Title"];?></td>
						<td><?php echo $info["Datetime"];?></td>
						<td><?php echo $info["Author"];?></td>
						<td><?php echo $category["Name"];?></td>
						<td>
							<span class="label label-danger">3</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-primary">5</span>
						</td>
						<td>
							<div class="btn btn-group" role="group">
								<button type="button" class="btn btn-success">Edit</button>
								<button type="button" class="btn btn-info">Preview</button>  
								<button type="button" class="btn btn-warning">Delete</button>	
							</div>
						</td>
					</tr>
					<?php 
					$NoSr++;} ?>
				</table>
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