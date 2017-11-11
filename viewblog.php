<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Session.php");?>
<!DOCTYPE html>
<html>
<head>
	<title>View blog</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/publicstyles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div style="height: 10px; background-color: #27aae1"></div>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span> 
		      	</button>
				<a href="#" class="navbar-brand">PHPCMS</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="">Home</a></li>
					<li><a href="">Blog</a></li>
					<li><a href="">About us</a></li>
					<li><a href="">Contact us</a></li>
					<li><a href="">Features</a></li>
				</ul>
				<form class="navbar-form navbar-right">
					<input type="text" name="Search" class="form-control" placeholder="Search">
					<button type="button" class="btn btn-default" name="SearchButton"><span class="glyphicon glyphicon-search"></span></button>
				</form>
			</div>
		</div>
	</nav>
	<div style="height: 10px; background-color: #27aae1; margin-top: -20px;"></div>
	<div class="container">
		<div class="col-sm-8">
			<h1>Main area blog</h1>
			<?php
				$sql = "SELECT
						`Id`, `CategoryId`, `Title`, `Datetime`, `Content`, `Image`, `Author` 
						FROM 
						`post`
						ORDER BY 
						`Id`";
				$result = mysqli_query($Connection, $sql);
				while ($row=mysqli_fetch_assoc($result)) {
					$info = $row;
					$sqlCategory = "SELECT `Name` FROM `category` WHERE `Id` = ".$info["CategoryId"];
					$subResult = mysqli_query($Connection, $sqlCategory);
					$category = mysqli_fetch_assoc($subResult);
				?>					
					<div class="thumbnail">
						<h2><?php echo $info["Title"]?></h2>
						<img src="<?php echo "Upload/".$info["Image"]?>">
						<strong>Category: <?php echo $category["Name"] ?> | Created date: <?php echo $info["Datetime"] ?>| Created by: <?php echo $info["Author"] ?></strong>
						<p><?php echo $info["Content"] ?>.</p>
						<a href="blogpost.php?PostId=<?php echo $info['Id'];?>"><button type="button" class="btn btn-info" style="float: right;">Read more</button></a>
						<div style="clear: both;"></div>
					</div>
				<?php }?>
		</div>
		<div class="col-sm-offset-1 col-sm-3">
			<h1>Follow us</h1>
				<a href="#" class="fa fa-facebook"></a>
				<a href="#" class="fa fa-twitter"></a>
				<a href="#" class="fa fa-google"></a>
				<a href="#" class="fa fa-linkedin"></a>
				<a href="#" class="fa fa-youtube"></a>
			<h1>Categories</h1>
			<ul class="list-group">
				<?php
				$sql = "SELECT 
						`Id`, `Name`, `Datetime`, `Creator` 
						FROM 
						`category`
						ORDER BY 
						`Id`";
				$result = mysqli_query($Connection, $sql);
				while ($row=mysqli_fetch_assoc($result)) {
					$info = $row;
				?>
				<li class="list-group-item"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;<a href=""><?php echo $info['Name'];?></a></li>
				<?php }?>
			</ul>
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
