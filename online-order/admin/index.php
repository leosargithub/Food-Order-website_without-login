<?php include('partial/menu.php');
?>

<!-- Menu content  Sectin start -->
<div class="main-content">

	<div class="wrapper">

<h1><strong>DASHBOARD</strong></h1>
<br><br>
<?php
if(isset($_SESSION['login'])){

	echo $_SESSION['login'];
	unset($_SESSION['login']);
}
?>
<br><br>

<div class="col-4 text-center">

	<?php 
	//sql query
	$sql = "SELECT * FROM category";
	// execute query
	$res = mysqli_query($conn, $sql);
	// count row
	$count = mysqli_num_rows($res);

	?>

	<h1><?php echo $count; ?></h1>
	<br>
	Categories
</div>
<div class="col-4 text-center">
		<?php 
	//sql query
	$sql2 = "SELECT * FROM food";
	// execute query
	$res2 = mysqli_query($conn, $sql2);
	// count row
	$count2 = mysqli_num_rows($res2);

	?>
		<h1><?php echo $count2; ?></h1>	<br>
	Foods
</div>
<div class="col-4 text-center">
<?php 
	//sql query
	$sql3 = "SELECT * FROM `order`";
	// execute query
	$res3 = mysqli_query($conn, $sql3);
	// count row
	$count3 = mysqli_num_rows($res3);

	?>
		<h1><?php echo $count3; ?></h1>
	<br>
	Total Orders
</div>
<div class="col-4 text-center">
	<?php 

	// create sql query to get total revenue generated
	$sql4 = "SELECT SUM(total) AS Total FROM `order` WHERE status='delivered'";

	//execute the query
	$res4= mysqli_query($conn, $sql4);

	// get the value 
	 $row4 = mysqli_fetch_assoc($res4);
	 // get the total revenue
	 $total_revenue = $row4['Total'];

	?>

	<h1><?php echo $total_revenue; ?></h1>
	<br>
	Revenue Generated
</div>
<div class="clearfix"></div>

	</div>
</div>

<!-- Menu content Sectin end -->

<?php include('partial/footer.php');
?>