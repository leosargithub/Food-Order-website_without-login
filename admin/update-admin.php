<?php
include('partial/menu.php');
?>





<div class="main-content">
	<div class="wrapper">
		<h1>Update Admin</h1>
		<br><br>
		<?php 
		// get the id of selected Admin
		 $id = $_GET['id'];
		// Create Sql query to get the details
		 $sql = "SELECT * FROM admin wHERE id=$id";
		 // execute the query
		 $res = mysqli_query($conn, $sql);

		 // check the query is executed or not
		 if($res==TRUE){
		 	// check the data is available or not
		 	$count = mysqli_num_rows($res);
		 	// check the admin data or not
		 	if($count==1){
		 		// Get the details
		 		//echo "admin availabe"; 
		 		$row = mysqli_fetch_assoc($res);
		 		$full_name = $row['full_name'];
		 		$username = $row['username'];

		 	}
		 	else {
		 		// Rediredt the manage admin page
		 		header('location:' .SITEURL. 'admin/manage-admin.php');
		 	}
		 }
		?>
		<form action="" method="POST">
			<table class="tbl-30"> 

				<tr>
					<td>Full Name </td>
					<td>
						<input type="text" name="full_name" value="<?php echo $full_name; ?>">
					</td>
				</tr>
				<tr>
					<td>Username </td>
					<td>
						<input type="text" name="username" value="<?php echo $username; ?>">
					</td>
				</tr>
				<tr> 
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
					</td>
				</tr>

			</table>
			
		</form>
	</div>
</div>


<?php 
// check wheather the submit btn is clicked or not
if(isset($_POST['submit'])){
	//echo "button clicked";
	// get all the value from to update
	$id = $_POST['id'];
	$full_name = $_POST['full_name'];
	$username = $_POST['username'];
	//create sql query  to update Admin
	$sql = "UPDATE admin SET full_name = '$full_name', username = '$username' 
	WHERE id = '$id'";

	// execute the query 
	 $res = mysqli_query($conn, $sql);
	 // check whether the query excuted sucessfully or not
	 if($res==TRUE){
	 	// Query executed and admin update
	 	 $_SESSION['update'] = "<div class='sucess' > Admin updated Sucessfully. </div>";
	 	 // Redirect to manage admin page
	 	 header('location:' .SITEURL. 'admin/manage-admin.php');
	 }
	 else

	 {
	 	// failed to update
	 	 $_SESSION['update'] = "<div class='error' >  failed to deleted admin. </div>";
	 	 // Redirect to manage admin page
	 	 header('location:' .SITEURL. 'admin/manage-admin.php');
	 }
}
?>



<?php include('partial/footer.php');
?>
