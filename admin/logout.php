<?php 
    //Include constants.php to SITEURL
    include('../config/constants.php');

    //1. Destroy the session
    session_destroy(); //Unset $_SESSION['user']
    
    //Redirect to Login page
    header('location:'.SITEURL.'admin/login.php');
?>