<?php include('partials-front/menu.php'); ?>

<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        if(isset($_POST['submit'])) {
            $search = mysqli_real_escape_string($conn, $_POST['search']);

            $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
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
                            <input type="checkbox" name="selected_foods[]" value="<?php echo $id; ?>">
                        </div>
                    </div>

                    <?php
                }
                ?>
                <div class="clearfix"></div>
                <button type="submit" name="submit_order" class="btn btn-primary">Order Button</button>
                <?php
            } else {
                echo "<div class='error'>Food not found.</div>";
            }
        }
        ?>

        <?php
        if(isset($_POST['submit_order'])) {
            $selected_foods = $_POST['selected_foods'];
            if(!empty($selected_foods)) {
                // Loop through selected food items and process the order
                echo "<h3>Selected Food Items:</h3>";
                echo "<ul>";
                foreach($selected_foods as $food_id) {
                    // You can fetch and display additional details here
                    echo "<li>Food ID: $food_id</li>";
                }
                echo "</ul>";
            } else {
                echo "<div class='error'>No food items selected.</div>";
            }
        }
        ?>

    </div>
</section>

<?php include('partials-front/footer.php'); ?>
