<?php
// Include the menu file
include('partial/menu.php');
?>
<div class="main-content">
	<div class="wrapper">
		
		<h1>Add Admin</h1>
		<br><br>
		<?php 
		if(isset($_SESSION['add'])){
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}

		?>
		<form action="" method="POST">
			<table class="tbl-30">
				<tr>
				<td>Full Name: </td>
				<td>
					<input type="text" name="full_name" placeholder="Enter Your Name">
				</td>
			</tr>
			<tr>
				<td>Username: </td>
				<td>
					<input type="text" name="username" placeholder="Enter Your Username">
				</td>
			</tr>
			<tr>
				<td>Password: </td>
				<td>
					<input type="text" name="password" placeholder="Enter Your Password">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="submit" class="btn-secondary" value="Add Admin">
				</td>
			</tr>

			</table>
		</form>
	</div>
</div>



<?php
// Include the footer file
include('partial/footer.php');
?>


<?php
// process the value from form and save it in database

// check whether the submit button is clicked or not

if(isset($_POST['submit'])){
	//button "button clicked"

	// get the data from form 
	$full_name = $_POST['full_name'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	// sql query to save the data into database
	$sql = "INSERT INTO admin SET 
	full_name = '$full_name',
	username = '$username',
	password = '$password'


	";

	// execute query and save data in database
	//$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());

	//$db_select = mysqli_select_db($conn,'food-order') OR die(mysqli_error());

	$res = mysqli_query($conn, $sql) or die(mysqli_error());

	// check whether the query is executed 

	if($res==TRUE){
		// Data Inserted
		//echo " data insered";
		$_SESSION['add'] = "<div class='sucess'>Admin Added Sucessfully. </div>";
		// redirect page
		header('location:'.SITEURL.'admin/manage-admin.php');
	}
	else
	{
		//failed to insert data
		 //echo "Failed to insert data";
		$_SESSION['add'] = "<div class='error'>Failed Added Admin. </div>";
		// redirect page
		header('location:'.SITEURL.'admin/manage-admin.php');
	}


}


?>