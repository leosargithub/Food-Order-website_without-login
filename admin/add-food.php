<?php
include('partial/menu.php');
?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Food</h1>

			<br><br>
			<?php
			if(isset($_SESSION['upload'])){
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
			?>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>
						Title:
					</td>
					<td>
						<input type="text" name="title" placeholder="title of Food">
					</td>
				</tr>
				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols="30" rows="5" ></textarea>
					</td>
				</tr>
				<tr>
					<td>Price: </td>
					<td>
						<input type="number" name="price">
					</td>
				</tr>
				<tr>
					<td>Selected Image:</td>
					<td>
						<input type="file" name="imag">
					</td>
				</tr>
				<tr>
					<td>Category:</td>
					<td>
						<select name="category">
							<?php
							// create a php code to display from database
							// create a sql query to get all active categories from the database
							$sql = "SELECT * FROM category WHERE active='Yes'";
							// execute the query
							$res = mysqli_query($conn, $sql);
							// count rows to check whether we have categories or not
							$count = mysqli_num_rows($res);
							if($count > 0){
								// we have categories
								while($rows = mysqli_fetch_assoc($res)){
									// get the details of categories
									$id = $rows['id'];
									$title = $rows['title'];
									?>
									<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
									<?php
								}
							}
							else{
								// we do not have categories
								?>
								<option value="0">No Category Found</option>
								<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Featured:
					</td>
					<td>
						<input type="radio" name="featured" value="Yes">Yes
						<input type="radio" name="featured" value="No">No
					</td>
				</tr>
				<tr>
					<td>Active:</td>
					<td>
						<input type="radio" name="active" value="Yes">Yes
						<input type="radio" name="active" value="No">No
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Food" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

		<?php
		// check whether the button is clicked or not
		if(isset($_POST['submit'])){
			// get the data from the form
			$title = $_POST['title'];
			$description = $_POST['description'];
			$price = $_POST['price'];
			$category = $_POST['category'];

			// upload the image if selected
			if(isset($_POST['featured'])){
				$featured = $_POST['featured'];
			}
			else {
				$featured = "No";
			}
			if(isset($_POST['active'])){
				$active = $_POST['active'];
			}
			else{
				$active = "No";
			}
			// check whether the selected image is clicked or not and upload the image only if the image is selected
			if(isset($_FILES['imag']['name'])){
				// get all the details of the selected image
				$image_name = $_FILES['imag']['name'];
				// check whether the image is selected or not
				if($image_name != ""){
					// image is selected
					// rename the image
					// get the extension of the selected image (jpg, png, gif, etc.)
					$ext = end(explode('.', $image_name));
					// create a new name for the image
					$image_name = "Food-name-".rand(0000, 9999).".".$ext; // new image name may be like
					// upload image
					// get the source path and destination path
					// source path is the current location of the image
					$src = $_FILES['imag']['tmp_name'];
					// destination path for the image to be uploaded
					$dst = "../images/food/".$image_name;
					// finally, upload the food image
					$upload = move_uploaded_file($src, $dst);
					// check whether the image uploaded or not
					if($upload == false){
						// failed to upload the image
						// redirect to add food page with an error message
						$_SESSION['upload'] = "<div class='error'>Failed to upload Image.</div> ";
						header('location:'.SITEURL.'admin/add-food.php');
						die(); // stop the process
					}
				}
			}
			else {
				$image_name = "";
			}

			// insert into the database
			// create an SQL query to save or add food
			$sql2 = "INSERT INTO food SET 
				title = '$title',
				description = '$description',
				price = $price,
				image_name = '$image_name',
				category_id = $category,
				featured = '$featured',
				active = '$active'
			";
			// execute the query
			$res = mysqli_query($conn, $sql2);
			// check whether the data is inserted or not
			if($res == true){
				// data inserted successfully
				$_SESSION['add'] = "<div class='sucess'>Food Added Successfully.</div>";
				header('location:'.SITEURL.'admin/manage-food.php');
			}
			else {
				$_SESSION['add'] = "<div class='error'>Failed to Add food.</div>";
				header('location:'.SITEURL.'admin/manage-food.php');
			}
		}
		?>
	</div>
</div>

<?php
include('partial/footer.php');
?>
