<?php include('partials-front/menu.php'); ?>

<section class="cart">
    <div class="container">
        <h2 class="text-center">Your Cart</h2>

        <form action="confirm-order.php" method="POST">
            <table class="tbl-full">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['selected_foods'])) {
                        $selected_foods = $_POST['selected_foods'];
                        $prices = $_POST['prices'];
                        $quantities = $_POST['quantities'];
                        $total_amount = 0;

                        for ($i = 0; $i < count($selected_foods); $i++) {
                            $food_id = $selected_foods[$i];
                            $sql = "SELECT * FROM food WHERE id=$food_id";
                            $res = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($res);
                            $title = $row['title'];
                            $price = $prices[$i];
                            $quantity = $quantities[$i];
                            $total = $price * $quantity;
                            $total_amount += $total;
                            ?>

                            <tr>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $total; ?></td>
                            </tr>

                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

            <div class="order-total">
                <h4>Total Amount: <?php echo $total_amount; ?></h4>
            </div>

            <div class="clearfix"></div>
            
            <input type="hidden" name="selected_foods" value="<?php echo implode(',', $selected_foods); ?>">
            <input type="hidden" name="prices" value="<?php echo implode(',', $prices); ?>">
            <input type="hidden" name="quantities" value="<?php echo implode(',', $quantities); ?>">
            <button type="submit" name="confirm_order" class="btn btn-primary">Confirm Order</button>
        </form>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>
