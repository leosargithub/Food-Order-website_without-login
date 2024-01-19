
<?php include('../config/constants.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>login-Food Order system</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<link rel="stylesheet" type="text/css" href="../css/style1.css">
</head>
<body>
	<div class="container">
<div class="row">
<div class="col-sm-4">
	
</div>
<div class="col-sm-4">
	<div class="login_form">
		<!-- <img src="C:\xampp\htdocs\Food-order\adminlogo.jpg" style="width:60px; height:60px; align-content: center;" alt=" leosar code" class="logo img-fluid"> -->

<br>
<?php
if(isset($_SESSION['login'])){

	echo $_SESSION['login'];
	unset($_SESSION['login']);
}
if(isset($_SESSION['no-login-message'])){
	echo $_SESSION['no-login-message'];
	unset($_SESSION['no-login-message']);
}
?>
<br>

		
	<form action="" method="POST">
  <div class="form-group">
    <label class="label_txt">Username or Email </label>
    <input type="text" class="form-control" name="username" placeholder="Enter Username"> 
    

  </div>
  <div class="form-group">
    <label class="label_txt">Password</label>
    <input type="password" name="password"class="form-control" placeholder="Enter Password">
  </div>
  
  <button type="submit" name ="submit"class="btn btn-primary form_btn" value="Login">Login</button>
</form> 
<p style="font-size: 12px; text-align: center; margin-top:10px; "><a href="forget-password.php" style="color: #00376b;">Forget Password?</a></p>
<br>
<p>Don't have an account?<a href="signup.php">Sign up</a></p>

</div>
</div>
<div class="col-sm-4">
	
</div>
</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</html>
<?php 

// check wheather the submit Button is clicked or NOt
  if(isset($_POST['submit'])){
// process for login

 // $username = $_POST['username'];

 $username = mysqli_real_escape_string($conn, $_POST['username']);


 // $password = md5($_POST['password']);
 

  $raw_password = md5($_POST['password']);

  $password = mysqli_real_escape_string($conn, $raw_password);



 // sql to check wheather the user with user name and passwrod exist or not

$sql = "SELECT * FROM admin WHERE username= '$username' AND password = '$password' ";

// execute the query 

$res = mysqli_query($conn,$sql);

// count rows to check wheather the user exist or not
 $count = mysqli_num_rows($res);

 if($count==1){
// user available and login sucess
 	$_SESSION['login'] = "<div class='sucess' > Login Sucessfully </div> ";
 	$_SESSION['user'] = $username;// to check the user login or not and logout will unset


 	// redirect to home page or dash bord
 	header('location:'.SITEURL.'admin/');

 }
 else
 {
 	// user not available login failed
	$_SESSION['login'] = "<div class='error' > username and password didn't match </div>" ;
 	// redirect to home page or dash bord
 	header('location:'.SITEURL.'admin/login.php');

 }
  }

  ?>