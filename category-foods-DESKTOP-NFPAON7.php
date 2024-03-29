<?php include('partials-front/menu.php'); ?>

<?php
if(isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $sql = "SELECT title FROM category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    header('location:' . SITEURL);
    exit(); // Exit to prevent further execution
}
?>

<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <form method="post" action="order.php">
            <div class="food-menu-items">
                <?php
                $sql2 = "SELECT * FROM food WHERE category_id=$category_id";
                $res2 = mysqli_query($conn, $sql2);

                if(mysqli_num_rows($res2) > 0) {
                    while($row2 = mysqli_fetch_assoc($res2)) {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                if($image_name != "") {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                } else {
                                    echo "<div class='error'>Image Not Available.</div>";
                                }
                                ?>
                            </div>
                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?></p>
                                <p class="food-detail"><?php echo $description; ?></p>
                                                        </div>
                        </div>

                        <?php
                    }
                } else {
                    echo "<div class='error'>Food Not Available.</div>";
                }
                ?>
            </div>
            <div class="clearfix"></div>
            <button type="submit" name="submit" class="btn btn-primary">Order Button</button>
        </form>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>
