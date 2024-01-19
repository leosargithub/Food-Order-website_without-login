<?php 
// include constants file
include ('../config/constants.php');

// check wheather the id and image_name value is set or not 
if(isset($_GET['id']) AND isset($_GET['image_name'])){
	// get the value and delete
	$id = $_GET['id'];
	$image_name = $_GET['image_name'];
	// remove the physical image file is available
	if($image_name != ""){
		// image is available. so remove it
		$path = "../images/category/".$image_name;
		// remove the image
		$remove = unlink($path);
		// if failed to remove image then add an error message and stop the process

		if($remove== false){
			// set the session message
			$_SESSION['remove'] = "<div class='error'> Failed to Remove category Image. </div>";
			// redirect ot manage category page 
			header('location:'.SITEURL.'admin/manage-category.php');
			// stop the proces 
			die();
		}
	}

	// delete data from database
	$sql = "DELETE FROM category WHERE id=$id";

	// execute the query
	$res = mysqli_query($conn,$sql);

	// check wheather the data is deleted form database or not
	if($res == true){
		// set sucess message and redirect
		$_SESSION['delete'] = "<div class='sucess'>Category Delete Sucessfully.</div> ";

		// redirect to manage category
		header('location:'.SITEURL. 'admin/manage-category.php');
	} else{

		// seet fail message and redirect
		$_SESSION['delete'] = "<div class='error'>Failed to Delete Category .</div> ";

		// redirect to manage category
		header('location:'.SITEURL. 'admin/manage-category.php');
	}

	
} else {
	// redirect to manage categorypage
	 header('location:'.SITEURL. 'admin/manage-category.php');
	 echo " get value and delete";
}

?> 