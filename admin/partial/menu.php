<?php
include('../config/constants.php');
include('login-check.php');
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Food order System - Home page</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
		
</head>
<body>
<!-- Menu Sectin start -->
<div class="menu text-center">

	<div class="wrapper">
		
		<ul>
			<li><a href="index.php" >Home</a></li>
				<li><a href="manage-admin.php" >Admin </a></li>
					<li><a href="manage-category.php" >Category</a></li>
						<li><a href="manage-food.php" >Food</a></li>
							<li><a href="manage-order.php" >Order</a></li>
								<li><a href="logout.php" ><input type="button" >Logout</a></li>
		</ul>
	</div>
	</div>
<!-- Menu Sectin end -->