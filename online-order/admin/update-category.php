<?php
include('partial/menu.php');
?>


<div class="main-content">
	<div class="wrapper">
		<h1>Update Category</h1>

		<br><br>
		<?php 
		// check wheaher the id is set or not 
		if(isset($_GET['id'])){
			//get the id and all other detalis
			 $id = $_GET['id'];
			 //create sql query to gell all other details
			 $sql = "SELECT * FROM category WHERE id = $id";

			 // execute the query
			  $res = mysqli_query($conn,$sql);

			  // count the rows to check wheather the id si valid or not
			   $count = mysqli_num_rows($res);

			   if($count==1){

			   	// get all data
			   	$row = mysqli_fetch_assoc($res);
			   	$title = $row['title'];
			   	  	$current_image = $row['image_name'];
			   	  	$featured = $row['featured'];
			   	  	$active = $row['active'];

			   } else
			   {
			   	// redirect to manage category with session message
			   	$_SESSION['no-category-found'] = "<div class='error'> Category not found. </div> ";
			   	header('location:'.SITEURL. 'admin/manage-category.php');
			   }

		} else {
			// redirect to manage category
			header('location:'.SITEURL. 'admin/manage-category.php');
		}
		?>
		<form action="" method="POST" enctype="multipart/form-data">

		<table class="tbl-30">
			<tr>
				<td>
					Title:
				</td>
				<td>
					<input type="text" name="title" value="<?php echo $title; ?>">
				</td>
			</tr>
			<tr>
				<td>Current Image: </td>
				<td>
				<?php
				if($current_image != ""){
					// display the image

					?>
					<img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">

					<?php
				}
				else
				{
					// display the message
					echo "<div class='error'>Image is not added. </div> ";
				}
				?>
				</td>
			</tr>
			<tr> 
				<td>New Image:</td>
				<td>
					<input type="file" name="image">
				</td>
			</tr>
			<tr>
				<td>Featured:</td>
				<td>
					<input <?php if($featured == "Yes") { echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
					<input <?php if($featured == "No") { echo "checked";} ?> type="radio" name="featured" value="Yes">No
				</td>
			</tr>
			<tr>
				<td>Active:</td>
				<td>
					<input <?php if($active == "Yes") { echo "checked";} ?> type="radio" name="active" value="Yes">Yes
					<input <?php if($active == "No") { echo "checked";} ?> type="radio" name="active" value="Yes">No
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
				
				<input type="hidden" name="id" value="<?php echo $id; ?>">

					<input type="submit" name="submit" value="Update Category" class="btn-secondary">
				</td>
			</tr>
		</table>
</form>
<?php
if(isset($_POST['submit'])){


	// get all the value from our form 
	$id = $_POST['id'];
	$title = $_POST['title'];
	$current_image = $_POST['current_image'];
	$featured = $_POST['featured'];
	$active = $_POST['active'];
	// updating new image if selected
	// checked wheather image is selected or nor
	if(isset($_FILES['image']['name'])){
		// get the image details 
		$image_name = $_FILES['image']['name'];

		// check wheather the image is available or not
		 if($current_image != ""){
		 	// image Available
		 	//upload the new image 
		 	// auto rename our page
			 	// get the extension of our image (jpg,png,gif,etc)
			 	$ext = end(explode('.', $image_name));

			 	// rename the image
			 	$image_name = "food_category_".rand(000, 999).'.'.$ext;

			 	$source_path = $_FILES['image']['tmp_name'];

			 	$destination_path = "../images/category/".$image_name;

			 	//finaly upload the image
			 	$upload = move_uploaded_file($source_path, $destination_path);

			 	//check wheather the image is uploaded or not
			 	 if($upload==false)
			 	 {
			 	 	// set message
			 	 	$_SESSION['upload'] = "<div class='error'>Failed to upload image. </div>";
			 	 	// redirect to manage category page
			 	 	header('location:'.SITEURL. 'admin/manage-category.php');
			 	 	// stop the process
			 	 	 die();
			 	 }
		 	// remove the current image
			 	
		if ($current_image != "") {
   	 $remove_path = "../images/category/" . $current_image;
    $remove = unlink($remove_path);
    // check the image is removed or not
    // if failed to remove then display message and stop the process
    if ($remove == false) {
        // failed to remove image
	        $_SESSION['failed-remove'] = "<div class='error'>Failed to remove Current Image</div> ";
        header('location:' . SITEURL . 'admin/manage-category.php');
        die(); // stop the process
   	 }
	}

			 	 
			 	 
		 }
		 else
		 {
		 		$image_name = $current_image;
		 }
	}
	else 
	{
		$image_name = $current_image;

	}

	// updating new image if selected
$sql2 = "UPDATE category SET 
    title = '$title',
    image_name = '$image_name',
    featured = '$featured',
    active = '$active'
    WHERE id = $id
";



	// execute the query
		$res2 = mysqli_query($conn, $sql2);


	// redirected  to manage category with message

 	// check wheather executed or not
		if($res2==true){

			// category updated
			$_SESSION['update'] = "<div class='sucess' >Category update Sucessfully.</div> ";
			header('location:'.SITEURL. 'admin/manage-category.php');
		} else
		{

			// failed to update Category
			$_SESSION['update'] = "<div class='error' >Failed  update Category.</div> ";
			header('location:'.SITEURL. 'admin/manage-category.php');
		}


}
?>


	</div>
</div>




<?php
include('partial/footer.php');

?>