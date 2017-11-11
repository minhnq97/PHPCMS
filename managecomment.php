<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Session.php");?>
<?php echo RequiredLogin();?>
<?php echo RequiredAdmin();?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Comment</title>
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
					<li><a href="manageadmin.php"><span class="glyphicon glyphicon-cog"></span>
					Manage Admin</a></li>
					<li class="active"><a href="managecomment.php"><span class="glyphicon glyphicon-envelope"></span>
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
				<h1>Unapproved comment</h1>
				<table class="table table-striped table-hover">
					<tr>
						<th>#</th>
						<th>Post</th>
						<th>Comment</th>
						<th>Created time</th>
						<th>User</th>
						<th>Action</th>
					</tr>
					<?php
						$sql = "SELECT
								`Id`, `PostId`, `Createtime`, `Username`, `Comment`, `IsApproved` 
								FROM 
								`comment`
								WHERE
								`IsApproved` = 0
								ORDER BY 
								`Id`";
						$result = mysqli_query($Connection, $sql);
						$NoSr = 1;
						while ($row=mysqli_fetch_assoc($result)) {
							$info = $row;
							$sqlPost = "SELECT `Title` FROM `post` WHERE `Id` = ".$info["PostId"];
							$subResult = mysqli_query($Connection, $sqlPost);
							$post = mysqli_fetch_assoc($subResult);
					?>
					<tr>
						<td><?php echo $NoSr;?></td>
						<td><a href="blogpost.php?PostId=<?php echo $info['PostId'];?>"><?php echo $post["Title"];?></a></td>
						<td><?php echo $info["Comment"];?></td>
						<td><?php echo $info["Createtime"];?></td>
						<td><?php echo $info["Username"];?></td>
						<td>
							<div class="btn btn-group" role="group">
								<a href="approvecomment.php?CommentId=<?php echo $info["Id"];?>"><button type="button" class="btn btn-success">Approve</button></a>
								<a href="removecomment.php?CommentId=<?php echo $info["Id"];?>"><button type="button" class="btn btn-danger">Remove</button></a>
							</div>
						</td>
					</tr>
					<?php 
					$NoSr++;} ?>
				</table>
				<h1>Approved comment</h1>
				<table class="table table-striped table-hover">
					<tr>
						<th>#</th>
						<th>Post</th>
						<th>Comment</th>
						<th>Created time</th>
						<th>User</th>
						<th>Action</th>
					</tr>
					<?php
						$sql = "SELECT
								`Id`, `PostId`, `Createtime`, `Username`, `Comment`, `IsApproved` 
								FROM 
								`comment`
								WHERE
								`IsApproved` = 1
								ORDER BY 
								`Id`";
						$result = mysqli_query($Connection, $sql);
						$NoSr = 1;
						while ($row=mysqli_fetch_assoc($result)) {
							$info = $row;
							$sqlPost = "SELECT `Title` FROM `post` WHERE `Id` = ".$info["PostId"];
							$subResult = mysqli_query($Connection, $sqlPost);
							$post = mysqli_fetch_assoc($subResult);
					?>
					<tr>
						<td><?php echo $NoSr;?></td>
						<td><a href="blogpost.php?PostId=<?php echo $info['PostId'];?>"><?php echo $post["Title"];?></a></td>
						<td><?php echo $info["Comment"];?></td>
						<td><?php echo $info["Createtime"];?></td>
						<td><?php echo $info["Username"];?></td>
						<td>
							<div class="btn btn-group" role="group">
								<a href="unapprovecomment.php?CommentId=<?php echo $info["Id"];?>"><button type="button" class="btn btn-success">Unapprove</button></a>
								<a href="removecomment.php?CommentId=<?php echo $info["Id"];?>"><button type="button" class="btn btn-danger">Remove</button></a>
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