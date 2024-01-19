
   <?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php
                 // get the search keyword
             // $search = ($_POST['search']);
             $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
        <form action="order.php" method="POST" class="order">

            <?php

        


             // Sql query to get foods based on search keyword
            //"slelect  * from where title  like '%%' or description like '%%' ";
             $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";

             // execute the query
              $res = mysqli_query($conn, $sql);

              //count rows
              $count = mysqli_num_rows($res);

              // check whether food available or not
              if($count>0){
                //food available
                while($row=mysqli_fetch_assoc($res)){

                    // get the details
                    $id = $row['id'];
                     $title = $row['title'];
                      $price = $row['price'];
                       $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                         <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php 

                    // check whether image name is avaialable or not
                    if($image_name==""){

                        //image not available
                        echo "<div class='error'>Image Not Available. </div>";
                    }
                    else
                    {
                        // image availalbe

                        ?>

                             <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                        <?php
                    }

                    ?>
               
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
    <!-- fOOD Menu Section Ends Here -->

   
      <?php include('partials-front/footer.php'); ?>