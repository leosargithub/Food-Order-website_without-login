<?php
// include constants.php for siteurl

include ('../config/constants.php');
// Destroy the session 
session_destroy();
// unset $_session['user']

// Redirect to loging page
header('location:'.SITEURL.'admin/login.php'); 
?>