<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php

    if(isset($_SESSION['order'])){

        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }

    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 

            // create sql query to display category from database
             $sql  = "SELECT  * FROM category WHERE active = 'Yes' AND featured='Yes' LIMIT 5";

             // execute query
             $res = mysqli_query($conn, $sql);
             // count rows to check whether the category is available or not 
             $count = mysqli_num_rows($res);

             if($count>0){

                // categories avaliable
                while($row = mysqli_fetch_assoc($res)){

                    // Get the value like title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

                    ?>

                     <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
            <div class="box-3 float-container">
                <?php 
                // check whether image is avilable or not
                if($image_name==""){
                    echo "<div class='error'> Image not Available.</div>";
                }
                else
                {
                    //image available
                    ?>

                    <img src="<?php echo SITEURL;  ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                    <?php
                }

                ?>
                

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>

                    <?php
                }
             }
             else 
             {
                // cateogories not available

                echo "<div class='error'>Category Not Added. </div>";
             }

            ?>

           



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
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

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>
    

