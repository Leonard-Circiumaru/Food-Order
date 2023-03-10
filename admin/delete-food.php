<?php 
    //Include constants page
    include('../config/constants.php');

    //echo "Delete Food Page";

    if(isset($_GET['id']) && isset($_GET['image_name'])) 
    {
        //Process to delete
        //echo "Process to Delete";

        //1. Get id and image_name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the image if available
        if($image_name != "") 
        {
            //It has image and need to remove from folder
            //Get the image path
            $path = "../images/food/".$image_name;

            //Remove image file from folder
            $remove = unlink($path);

            //Check whether the mage is remove or not
            if($remove==false) 
            {
                //Failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File</div>";
                //Redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the process of deleting food
                die();
            }
        }
        //3. Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed or not and set the session message respectively
        //4. Redirect to manage food page with session message
        if($res==true) 
        {
            //Food delete
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else 
        {
            //Failed to delete food
            $_SESSION['delete'] = "<div class='error'>Fail to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    }
    else 
    {
        //Redirect to manage food page
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>