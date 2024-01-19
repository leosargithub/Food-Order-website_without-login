<?php include('partials-front/menu.php'); ?>

<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Confirm Your Order</h2>

        <?php
        if (isset($_POST['submit'])) {
            // Get all the details of the form
            $selected_foods = $_POST['selected_foods'];
            $quantities = $_POST['quantities'];
            $total = 0;

            // Calculate total price and total quantity
            $total_quantity = 0;
            $foods_str = '';
            foreach ($selected_foods as $key => $food_id) {
                $price = $_POST['prices'][$key];
                $qty = $_POST['quantities'][$key];
                $total += $price * $qty;
                $total_quantity += $qty;

                // Fetch food title for insertion
                $sql_food = "SELECT title FROM food WHERE id=$food_id";
                $res_food = mysqli_query($conn, $sql_food);
                $row_food = mysqli_fetch_assoc($res_food);
                $food_title = $row_food['title'];

                // Append food title to foods_str
                $foods_str .= $food_title . ', ';
            }
            $foods_str = rtrim($foods_str, ', '); // Remove trailing comma and space

            // Order details
            $order_date = date("Y-m-d H:i:s"); // Use "H" for 24-hour format
            $status = "ordered";
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact']; // Fix typo: 'contatct' to 'contact'
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // Insert order into the database
            $sql_insert = "INSERT INTO `order` (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Prepare and execute the SQL statement
            $stmt = $conn->prepare($sql_insert);
            $stmt->bind_param('sdidssssss', $foods_str, $total, $total_quantity, $total, $order_date, $status, $customer_name, $customer_contact, $customer_email, $customer_address);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['order'] = "<div class='success text-center'>Food ordered Successfully.</div> ";
                header('location:' . SITEURL );
                exit(); // stop executing the rest of the code
            } else {
                $_SESSION['order'] = "<div class='error'>Failed to order food.</div> ";
                header('location:' . SITEURL);
                exit(); // stop executing the rest of the code
            }
        }
        ?>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>
