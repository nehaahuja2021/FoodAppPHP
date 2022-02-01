<?php include('../config/constants.php') ?>

<html>
<head>
   <title>Food Order System </title>
   <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="login">
<h1 class ="text-center">Login</h1><br> <br>
<?php
if(isset($_SESSION['login']))
{
   echo $_SESSION['login'];
   unset ($_SESSION['login']);
}
if(isset($_SESSION['no-login-message']))
{
echo $_SESSION['no-login-message'];
unset ($_SESSION['no-login-message']);
}
?>
<br>
<!--Login form starts -->
<form action ="" method="POST" class="text-center">
  UserName:<br> <input type="text" name="username" placeholder="Enter username"><br><br>
Password: <br> <input type="password" name="password" placeholder="Enter password"><br><br>
<input type="submit" name="submit" value="Login" class="btnprimary">
</form>

<!--Ends -->

</div>

</body>
</html>
<?php
//check whether login button is clcked

if(isset($_POST['submit'])) 
// get data from login form
{
$username=$_POST['username'];

$password=md5($_POST['password']);
//check whether the user with username and password exists or not
$sql= "SELECT * FROM tbl_admin WHERE username= '$username' AND password='$password'";

//execute

$res=mysqli_query($conn,$sql);

//count rows to check whether user exists or not

$count=mysqli_num_rows($res);
if($count==1)
{
//user exists ans set session message for login success
$_SESSION['login']="<div class='success'>Logged in successfully</div>";
//redirect to homepage
$_SESSION['user']=$username; //check whethr user is logged in or not.logout will unset it.
header('location:'.SITEURL.'admin/');
}
else{
//user not available
$_SESSION['login']="<div class='error'>Log in failed</div>";
//display message at same page

header('location:'.SITEURL.'admin/login.php');

}
}

?>