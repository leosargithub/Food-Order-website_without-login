<?php
include('partial/menu.php');


?>

<div class="main-content">
	<div class="wrapper">
		<h1>Change Password</h1>
		<br><br>
		<?php
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}
		?>

<form action="" method="POST">
	<table class="tbl-30">
		<tr>
			<td>Current Password: </td>
			<td>
				<input type="password" name="current_password" placeholder="Current Password">
			</td>
		</tr>
		<tr>
			<td>New Password: </td>
			<td>
				<input type="password" name="new_password" placeholder="New Password">
			</td>
		</tr>
		<tr>
			<td>Confirm Password: </td>
			<td>
				<input type="password" name="confirm_password" placeholder="Confirm Password">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="submit" name="submit" value="Change Password" class="btn-secondary">
			</td>
		</tr>
	</table>
</form>

	</div>
</div>

<?php
// Check wheather the submit Button is clicked or not
if(isset($_POST['submit'])){


//echo "clikced";
	// get the data from form
 $id = $_POST['id'];
  $current_password = md5($_POST['current_password']);
  $new_password =md5($_POST['new_password']);
  $confirm_password = md5($_POST['confirm_password']);

	// Check wheather the user with current id and current password exist or not
  $sql = "SELECT * FROM admin wHERE id=$id AND password='$current_password' ";

  // execute query
  $res = mysqli_query($conn,$sql);
  if($res == TRUE){
  	// to check data available
  	 $count = mysqli_num_rows($res);
  	 if($count == 1){
  	 	// user exist and passwrod can be changede
  	 	//echo "user found";
  	 	// Check the wheather the new  password and confirm pasword is match or not
  	 	if($new_password == $confirm_password){


  	 		
  	 		//update password
			//echo "Password Match";  	
			$sql2 = "UPDATE admin SET password = '$new_password' wHERE id = $id ";

			$res2 = mysqli_query($conn,$sql2);

			// check the query executed or not
			if($res2 == TRUE){
				// Display Sucess message
				$_SESSION['change-pwd'] = "<div class='sucess'>Password Changed Sucessfully.  </div>";
  	 	// redirect the user 
  	 	header('location:' .SITEURL. 'admin/manage-admin.php');
			} 	
			else{
				// display error message
				$_SESSION['change-pwd'] = "<div class='error'>Failed to Changed Password. </div>";
  	 	// redirect the user 
  	 	header('location:' .SITEURL. 'admin/manage-admin.php');
			}
  	 	}

  	 	else{
  	 		// redirect to manage admin with error message
  	 		$_SESSION['pwd-not-match'] = "<div class='error'>Password Did  Not Match </div>";
  	 	// redirect the user 
  	 	header('location:' .SITEURL. 'admin/manage-admin.php');
  	 	}

  	 }
  	 else
  	 {
  	 	// user doesn't exist and redirect 
  	 	$_SESSION['user-not-found'] = "<div class='error'>User Not Found </div>";
  	 	// redirect the user 
  	 	header('location:' .SITEURL. 'admin/manage-admin.php');
  	 }
  }

	// check wheather the new password and confirm passowrd match or not


	// change password if all condtion is ture

} else
{
	// not clicked
}


?>

<?php include('partial/footer.php');