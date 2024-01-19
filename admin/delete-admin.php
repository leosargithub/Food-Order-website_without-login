<?php

// include constant.php file here
include('../config/constants.php');

// get the id of admin to be deleted
  $id = $_GET['id'];

// Create sql query to delete  admin
$sql = "DELETE FROM admin WHERE id=$id";

// Execute the query 
$res = mysqli_query($conn,$sql);

// check the querey executed sucessfully or not
if($res==true){
	// query executed sucessfully
	// echo "Admin Deleted";
  	 // create session varialble to display message
	$_SESSION['delete'] = "<div class='sucess'> Admin Deleted Sucessfully </div>";
	// redirect to the Manage Admin page
	header('location:' .SITEURL. 'admin/manage-admin.php');

}
else
{
	// failed to deletd admin
//	echo "failed to Deleted Admin";
	$_SESSION['delete'] = "<div class='error'> Failed to deleted Admin </div> ";
	// redirect to the Manage Admin page
	header('localhost:' .SITEURL. 'admin/manage-admin.php');


}

//  redirect to manage admin page with message 

?>