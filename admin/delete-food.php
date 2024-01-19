<?php

include('../config/constants.php');
if(isset($_GET['id']) && isset($_GET['image_name'])){


	// process to delete
	// echo "Process to deleted";

	// get id and image name
	$id = $_GET['id'];
	$image_name = $_GET['image_name'];
	// remove the image if avalalbe

	if($image_name != ""){

		// it has image and need to remove from folder

		// get the image path
		$path = "../images/food/".$image_name;

		//remove image file from folder
		$remove = unlink($path);

		// check wheather the image is removed or not
		if($remove== false){

			// failed to remove image
			$_SESSION['upload'] = "<div class='error'>Failed to Remove Image file. </div>";
			//redirect to manage food
			header('location:'.SITEURL.'admin/manage-food.php');

			// sotp the process of deleteing food
			die();
		}
	}

	// delete food from database

	$sql = "DELETE FROM food WHERE id=$id";

	// execute query
	$res = mysqli_query($conn, $sql);

	// check the query executed or not andd set the session message respectively

	// redirect to manage food with session message

	if($res==TRUE){

		//food deleted
		$_SESSION['delete'] = "<div class='sucess'>Food Deleted Sucessfully.</div>";
		header('location:'.SITEURL.'admin/manage-food.php');

	}else{

		// failed to deleted food
		$_SESSION['delete'] = "<div class='error'>Failed Deleted food.</div>";
		header('location:'.SITEURL.'admin/manage-food.php');

	}

}
 else {

 	// redirect to manage food page
 	// echo "redirect";

 	$_SESSION['unautorize'] = "<div class='error'>Unauthorized Access.</div>";
 	header('location:'.SITEURL. 'admin/manage-food.php');
 }
?>