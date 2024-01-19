<?php
include('partial/menu.php');
?>

<?php
// Check whether 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to get the selected food
    $sql2 = "SELECT * FROM food WHERE id = $id";
    // Execute the query
    $res2 = mysqli_query($conn, $sql2);

    // Get the values of the selected food
    $row2 = mysqli_fetch_assoc($res2);
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    // Redirect to manage food page if 'id' is not set
    header('location: ' . SITEURL . 'admin/manage-food.php');
    exit();
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            echo "<div class='error'>Image is not added.</div>";
                        } else {
                            echo "<img src='" . SITEURL . "images/food/$current_image' width='150px' alt='$title'>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            // SQL query to get all active categories from the database
                            $sql = "SELECT * FROM category WHERE active='Yes'";
                            // Execute the query
                            $res = mysqli_query($conn, $sql);
                            // Check whether categories are available
                            if (mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    // Set the selected attribute if the category matches the current category
                                    $selected = ($current_category == $category_id) ? "selected" : "";
                                    echo "<option value='$category_id' $selected>$category_title</option>";
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if ($featured == "Yes") echo "checked"; ?>>Yes
                        <input type="radio" name="featured" value="No" <?php if ($featured == "No") echo "checked"; ?>>No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if ($active == "Yes") echo "checked"; ?>>Yes
                        <input type="radio" name="active" value="No" <?php if ($active == "No") echo "checked"; ?>>No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Get the form data
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Upload the new image if selected
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    // Rename the image
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext;

                    // Get the source path and destination path for the image
                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/food/" . $image_name;

                    // Upload the image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    if (!$upload) {
                        // Failed to upload
                        $_SESSION['upload'] = "<div class='error'>Failed to upload the new image.</div>";
                        header('location: ' . SITEURL . 'admin/manage-food.php');
                        exit();
                    }

                    // Remove the current image if available
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;
                        $remove = unlink($remove_path);
                        if (!$remove) {
                            // Failed to remove the current image
                            $_SESSION['remove-failed'] = "<div class='error'>Failed to remove the current image.</div>";
                            header('location: ' . SITEURL . 'admin/manage-food.php');
                            exit();
                        }
                    }
                }
                else{
                    $image_name = $current_image;
                }
            }
             else 
             {
                $image_name = $current_image;
            }

            // Update the food in the database
            $sql3 = "UPDATE food SET 
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id = $id";

            $res3 = mysqli_query($conn, $sql3);

            if ($res3) {
                // Food updated successfully
                $_SESSION['update'] = "<div class='success'>Food updated successfully.</div>";
                header('location: ' . SITEURL . 'admin/manage-food.php');
                exit();
            } else {
                // Failed to update food
                $_SESSION['update'] = "<div class='error'>Failed to update food.</div>";
                header('location: ' . SITEURL . 'admin/manage-food.php');
                exit();
            }
        }
        ?>
    </div>
</div>

<?php include('partial/footer.php'); ?>
