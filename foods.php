<?php include('partials-front/menu.php'); ?>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <form action="order.php" method="POST" class="order">
            <?php
            $sql = "SELECT * FROM food WHERE active='Yes'";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
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
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <p class="food-detail"><?php echo $description; ?></p>
                            <br>

                            <input type="checkbox" name="selected_foods[]" value="<?php echo $id; ?>">
                        </div>
                    </div>

                <?php
                }
            } else {
                echo "<div class='error'>Error retrieving food items.</div>";
            }
            ?>

            <div class="text-center">
                <input type="submit" name="place_order" value="Place Order" class="btn btn-primary">
            </div>
        </form>

        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>
