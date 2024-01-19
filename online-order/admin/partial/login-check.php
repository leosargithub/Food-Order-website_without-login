
<?php
// Authorixation - Acess control

// check wheather the user is logged in or not
if(!isset($_SESSION['user'])){

// user is not loged in 
	// Redirect to login page with message
	 $_SESSION['no-login-message'] = "<div class='error' > Please login to acess Admin Panel. </div>";
	 // redirect to login page
	 header('location:'.SITEURL.'admin/login.php');
}

?>
