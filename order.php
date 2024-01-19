<?php include('partials-front/menu.php'); ?>
<?php
// Check whether food id is set or not
if (isset($_POST['selected_foods'])) {

    // Get the food ids of the selected food
    $selected_foods = $_POST['selected_foods'];
    $selected_foods_str = implode(',', $selected_foods);

    // Create SQL to retrieve selected food details
    $sql = "SELECT * FROM food WHERE id IN ($selected_foods_str)";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether data is available or not
    if ($res) {
        // Check the number of rows returned
        $count = mysqli_num_rows($res);

        if ($count == count($selected_foods)) {
            // We have data for all selected foods
            // ... your existing code ...

        } else {
            // Some food items not available
            // Redirect to home page
            header('location: ' . SITEURL);
            exit(); // Stop executing the rest of the code
        }
    } else {
        // Query execution failed
        // Redirect to home page
        header('location: ' . SITEURL);
        exit(); // Stop executing the rest of the code
    }
} else {
    // No food selected, redirect to homepage
    header('location: ' . SITEURL);
    exit(); // Stop executing the rest of the code
}
?>


<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Confirm Your Order</h2>

        <form action="confirm-order.php" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>
                <?php
                if (isset($_POST['selected_foods'])) {
                    foreach ($_POST['selected_foods'] as $key => $food_id) {
                        $sql2 = "SELECT * FROM food WHERE id=$food_id";
                        $res2 = mysqli_query($conn, $sql2);
                        $row = mysqli_fetch_assoc($res2);
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>


                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php if ($image_name == "") {
                                    echo "<div class='error'>Image not Available. </div>";
                                } else { ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php } ?>
                            </div>

                            <div class="food-menu-desc">
                                <h3><?php echo $title; ?></h3>
                                <input type="hidden" name="selected_foods[]" value="<?php echo $food_id; ?>">
                                <input type="hidden" name="prices[]" value="<?php echo $price; ?>">
                                <p class="food-price"><?php echo $price; ?></p>

                                <div class="order-label">Quantity</div>
                                <input type="number" name="quantities[]" class="input-responsive" value="1" required>
                            </div>
                        </div>

                    <?php
                    }
                }
                ?>
            </fieldset>

            <!-- Delivery details form fields here -->
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Enter your full name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="number" name="contact" placeholder="Enter your phone number" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="Enter your email" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="4" placeholder="Enter your delivery address" class="input-responsive" required></textarea>
            <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

           
        </form>

         
        

    </div>
</section>

<?php include('partials-front/footer.php'); ?>
