<?php include('partials-front/menu.php'); ?>

<section class="food-search text-center">
    <!-- ... Search form ... -->
</section>

<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>

<section class="categories">
    <!-- ... Categories section ... -->
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <form action="<?php echo SITEURL; ?>order.php" method="POST" class="order-form">
            <?php
            $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($res2) > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php if (!empty($image_name)) : ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php else : ?>
                                <div class="error">Image not Available.</div>
                            <?php endif; ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <p class="food-detail"><?php echo $description; ?></p>
                            <input type="checkbox" name="selected_foods[]" value="<?php echo $id; ?>">
                        </div>
                    </div>

                <?php
                }
                ?>
                <div class="clearfix"></div>
                <button type="submit" name="submit" class="btn btn-primary">Order Selected Items</button>
            <?php
            } else {
                echo "<div class='error'>Food Not Available.</div>";
            }
            ?>
        </form>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>
