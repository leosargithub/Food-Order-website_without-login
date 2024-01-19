<?php
include('partial/menu.php');
?>

<div class="main-content">
	<div class="wrapper">
		<h1>Manage Order</h1>
		<br><br>
<?php
if(isset($_SESSION['update'])){
	echo $_SESSION['update'];
	unset($_SESSION['update']);
}

?>
		<br><br>
		<table class="tbl-full">
			<tr>
				<th>S.N</th>
				<th>Food</th>
				<th>Price</th>
				<th>Quantaty</th>
				<th>Total</th>
				<th>Order Date</th>
				<th>Status</th>
				<th>Customer Name</th>
				<th>Contact</th>
				<th>Email</th>
				<th>Address</th>
				<th>Actions</th>

				<?php
				// get all the orders from the database
				$sql = "SELECT * FROM `order` ORDER BY id DESC";// display the latest order at first
				// execute the query
				$res = mysqli_query($conn, $sql);
				// count the rows
				$count = mysqli_num_rows($res);

				$sn = 1;

				if ($count > 0) {
					// Orders available
					while ($row = mysqli_fetch_assoc($res)) {
						// get all the order details
						$id = $row['id'];
						$food = $row['food'];
						$price = $row['price'];
						$qty = $row['qty'];
						$total = $row['total'];
						$order_date = $row['order_date'];
						$status = $row['status'];
						$customer_name = $row['customer_name'];
						$customer_contact = $row['customer_contact'];
						$customer_email = $row['customer_email'];
						$customer_address = $row['customer_address'];
				?>

						<tr>
							<td><?php echo $sn++; ?></td>
							<td><?php echo $food; ?></td>
							<td><?php echo $price; ?></td>
							<td><?php echo $qty; ?></td>
							<td><?php echo $total; ?></td>
							<td><?php echo $order_date; ?></td>

							<td>
								<?php 
								  if($status=="ordered"){
								  	echo "<lable>$status</lable>";
								  }
								  elseif ($status=="on deliverey") {
								  	// code...
								  	echo "<lable style='color: orange;'>$status</lable>";
								  }
								    elseif ($status=="delivered") {
								  	// code...
								  	echo "<lable style='color: green;'>$status</lable>";
								  }
								    elseif ($status=="cancelled") {
								  	// code...
								  	echo "<lable style='color: red;'>$status</lable>";
								  }
								?>
							</td>
						
							<td><?php echo $customer_name; ?></td>
							<td><?php echo $customer_contact; ?></td>
							<td><?php echo $customer_email; ?></td>
							<td><?php echo $customer_address; ?></td>
							<td>
								<a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">UpdateOrder</a>
							</td>
						</tr>

				<?php
					}
				} else {
					// Orders not available
					echo "<tr><td colspan='12' class='error'>Orders Not Available.</td></tr>";
				}
				?>
		</table>
	</div>
</div>

<?php include('partial/footer.php'); ?>
