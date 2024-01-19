 <?php
include ('partial/menu.php');
?>

<div class="main-content">
	<div class="wrapper">
	<h1>Add Category</h1>
	

	<br><br>
	<?php 

		if(isset($_SESSION['add'])){
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
		if(isset($_SESSION['upload'])){
			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}

	?>
	<br><br>
		<form action="" method="POST" enctype="multipart/form-data">

			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Category Title">
					</td>
				</tr>
				<tr>
					<td>Select Image:</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td>Featured:</td>
					<td> 
						<input type="radio" name="featured" value="Yes" >Yes
						<input type="radio" name="featured" value="Yes" >No
					</td>

				</tr>
				<tr> 
					<td>Active:</td>
					<td>
						<input type="radio" name="active" value="Yes" >Yes
						<input type="radio" name="active" value="Yes" >No
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Category" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>
		<?php
		// check wheather the submit button is clicked ro not
		if(isset($_POST['submit'])){

			//echo "clicked";
			// get the value from form and 
			$title = $_POST['title'];
			if(isset($_POST['featured'])){
				// get the vlaue from form
			$featured = $_POST['featured'];	
			}
			 else
			 {
			 	// set the default value 
			 	$featured = "NO";
			 }
			 if(isset($_POST['active'])){
				// get the vlaue from form
			$active = $_POST['active'];	
			}
			 else
			 {
			 	// set the default value 
			 	$active = "NO";
			 }
			 // check wheather the image is selected or not and set the value for image name accordingly.
			 //print_r($_FILES);

			 //die(); // break code here

			 if(isset($_FILES['image']['name'])){

			 	// upload image we need path and destination
			 	$image_name =$_FILES['image']['name'];
			 	// update the image only if image is selected
			 	if($image_name != "" ){



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
			 	 	// redirect to add category page
			 	 	header('location:'.SITEURL. 'admin/add-category.php');
			 	 	// stop the process
			 	 	 die();
			 	 }
			 	}
			 }
			 else
			 {
			 	// don't upload the image and set the image_name value as blank
			 	$image_name = "";
			 }

			 $sql = "INSERT INTO category SET 
			 title = '$title',
			 image_name = '$image_name',
			 featured = '$featured',
			 active = '$active'
			 ";
			 // 3 execute the query and save in database 
			  $res = mysqli_query($conn, $sql);
			  // check wheather the query is executed ro not and data are added or not
			   if($res== true){
			   	// quey executed and category added
			   	$_SESSION['add'] = "<div class='sucess'>Category Added Sucessfully.</div> ";
			   	// redirect to manage category page
			   	header('location:'.SITEURL. 'admin/manage-category.php');
			   }else
			   {
			   	// failed to add category
			   		   	$_SESSION['add'] = "<div class='error'>Failed to  Added Category.</div> ";
			   	// redirect to manage category page
			   	header('location:'.SITEURL. 'admin/manage-category.php');
			   }


			   }

		

		?>
		</div>
	</div>
<?php include('partial/footer.php');
?>