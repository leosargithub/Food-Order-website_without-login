<?php include('partials-front/menu.php'); ?>

<?php
// check whether food id is set or not
if (isset($_GET['food_id'])) {

    // get the food id and details of the selected food 
    $food_id = $_GET['food_id'];
    // get the details of the selected food

    $sql = "SELECT * FROM food WHERE id=$food_id";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // count the rows
    $count = mysqli_num_rows($res);
    // check whether the data is available or not
    if ($count == 1) {
        // we have data
        // get the data from the database
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];

        $image_name = $row['image_name'];
    } else {
        // food not available 
        // redirect to home page
        header('location: ' . SITEURL);
        exit(); // stop executing the rest of the code
    }
} else {

    // redirect to homepage
    header('location: ' . SITEURL);
    exit(); // stop executing the rest of the code
}

?>

<!-- fOOD SEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php

                    // check whether the image is available or not
                    if ($image_name == "") {

                        // image is not available
                        echo "<div class='error'>Image Not Available. </div>";
                    } else {
                        // image is available
                        ?>

                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">

                    <?php
                    }

                    ?>

                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <p class="food-price"><?php echo $price; ?></p>

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Enter your name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Enter a contact number" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="Enter your email" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="Enter your address" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php

        // check whether submit button is clicked or not
        if (isset($_POST['submit'])) {
            // get all the details of the form

            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:sa"); // order date

            $status = "ordered"; // ordered on delivery, delivered, cancelled

            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // save the order in database
            // create SQL to save the data
            $sql2 = "INSERT INTO `order` SET 
                food='$food',
                price=$price,
                qty=$qty,
                total=$total,
                order_date='$order_date',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'";


            // execute the query
            $res2 = mysqli_query($conn, $sql2);

            // check whether the query executed successfully or not
            if ($res2) {
                // query executed and order saved

                $_SESSION['order'] = "<div class='sucess text-center'>Food ordered Successfully.</div> ";
                header('location:' . SITEURL);
                exit(); // stop executing the rest of the code
            } else {
                // failed to save order

                $_SESSION['order'] = "<div class='error'>Failed to order food.</div> ";
                header('location:' . SITEURL);
                exit(); // stop executing the rest of the code
            }

        }

        ?>

    </div>
</section>
<!-- fOOD SEARCH Section Ends Here -->
<?php include('partials-front/footer.php'); ?>
