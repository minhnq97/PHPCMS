<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Session.php");?>
<?php echo RequiredLogin();?>
<?php echo RequiredAdmin();?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
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
					<li><a href="categories.php"><span class="glyphicon glyphicon-list-alt"></span>
					Categories</a></li>
					<li class="active"><a href="manageadmin.php"><span class="glyphicon glyphicon-cog"></span>
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
				<h1>Admin Panel</h1>
				<table class="table table-striped table-hover">
					<tr>
						<th>#</th>
						<th>Username</th>
						<th>Email address</th>
						<th>Account type</th>
						<th>View posts</th>
						<th>Choose Admin</th>
						<th>Remove</th>
					</tr>
					<?php
						$sql = "SELECT
								`Id`, `Username`, `Email`, `IsAdmin`
								FROM 
								`user`
								ORDER BY 
								`Id`";
						$result = mysqli_query($Connection, $sql);
						$NoSr = 1;
						while ($row=mysqli_fetch_assoc($result)) {
							$info = $row;
					?>
					<tr>
						<td><?php echo $NoSr;?></td>
						<td><?php echo $info["Username"];?></td>
						<td><?php echo $info["Email"];?></td>
						<td>
							<?php
								if($info["IsAdmin"]==1){
									echo "Admin";
								} else {
									echo "User";
								}
							?>		
						</td>
						<td><button type="button" class="btn btn-success" >View</button></td>
						<td><button type="button" class="btn btn-info" <?php if($info["IsAdmin"]) echo "disabled"; ?>>Choose</button></td>
						<td><button type="button" class="btn btn-danger">Remove</button></td>
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