    <?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php 
                //Get the source keyword
                //$search = mysqli_real_escape_string($conn, isset($_GET['search']) ? $_GET['search'] : '');
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            
            <h2>Fruits/Vegetables on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Fruits/Vegetables Menu</h2>

            <?php 
                //Sql query to get food based on keyword search
                //$search = huelva '; DROP database name;
                //"SELECT * FROM tbl_food WHERE title LIKE '%huelva'%' OR description LIKE '%huelva%'";
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Check whether available or not
                if($count>0) 
                {
                    //Food available
                    while($row=mysqli_fetch_assoc($res)) 
                    {
                        //Get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                        //Check whether image_name available or not
                                        if($image_name=="") 
                                        {
                                            //Image not available
                                            echo "<div class='error'>Image not Available.<?div>";
                                        }
                                        else 
                                        {
                                            //Image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">RON<?php echo $price; ?></p>
                                    <p class="food-detail">
                                    <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else 
                {
                    //Food not available
                    echo "<div class='error'>Watermelon not Found.</div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>