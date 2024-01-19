<?php include('partials-front/menu.php'); ?>

<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food Items</legend>

                <?php
                if (isset($_POST['submit'])) {
                    if(isset($_POST['selected_foods']) && !empty($_POST['selected_foods'])) {
                        foreach ($_POST['selected_foods'] as $food_id) {
                            $sql = "SELECT * FROM food WHERE id=$food_id";
                            $res = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($res) == 1) {
                                $row = mysqli_fetch_assoc($res);
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];

                                echo '<div class="food-menu-box">';
                                echo '<div class="food-menu-img">';
                                if (!empty($image_name)) {
                                    echo '<img src="' . SITEURL . 'images/food/' . $image_name . '" class="img-responsive img-curve">';
                                } else {
                                    echo '<div class="error">Image Not Available.</div>';
                                }
                                echo '</div>';
                                echo '<div class="food-menu-desc">';
                                echo '<h3>' . $title . '</h3>';
                                echo '<input type="hidden" name="selected_foods[]" value="' . $food_id . '">';
                                echo '<input type="hidden" name="food[]" value="' . $food_id . '">';
                                echo '<input type="hidden" name="price[]" value="' . $price . '">';
                                echo '<p class="food-price">' . $price . '</p>';
                                echo '<div class="order-label">Quantity</div>';
                                echo '<input type="number" name="qty[]" class="input-responsive" value="1" required>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        echo '<input type="submit" name="confirm_order" value="Confirm Order" class="btn btn-primary">';
                    } else {
                        echo '<div class="error">No food items selected.</div>';
                    }
                }
                ?>

            </fieldset>

            <?php
            if (isset($_POST['confirm_order'])) {
                $selected_foods = $_POST['selected_foods'];
                $total_amount = 0;
                ?>

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

                    <?php
                    foreach ($selected_foods as $index => $food_id) {
                        $food = $_POST['food'][$index];
                        $price = $_POST['price'][$index];
                        $qty = $_POST['qty'][$index];
                        $subtotal = $price * $qty;
                        $total_amount += $subtotal;
                        echo '<input type="hidden" name="food[]" value="' . $food . '">';
                        echo '<input type="hidden" name="price[]" value="' . $price . '">';
                        echo '<input type="hidden" name="qty[]" value="' . $qty . '">';
                    }
                    ?>
                    <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            <?php
            }
            ?>

        </form>

        <?php
        if (isset($_POST['place_order'])) {
            // Process and save order details to the database
            // ... Your code here ...
            // Redirect user to a thank you page or order confirmation page
        }
        ?>

    </div>
</section>

<?php include('partials-front/footer.php'); ?>
