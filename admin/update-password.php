<?php include('partials/menu.php');?>
<div class="main-content">
<div class="wrapper">
<h1> Change Password </h1>
<br>
<br>
<form action="" method="POST">

<?php
if(isset($_GET['id']))
{
   $id=$_GET['id'];
}

?>
<table class="tbl-thirty">
<tr>
   <td>Current Password: </td>
   <td> <input type="password" name="current_password" placeholder="current password"></td>
</tr>
<tr>
<td>New Password: </td>
   <td> <input type="password" name="new_password" placeholder="new password"></td>
</tr>

<tr>
<td>Confirm Password: </td>
   <td> <input type="password" name="confirm_password" placeholder="confirm password"></td>
</tr>

<tr>
   <td colspan=2>
      <input type="hidden" name="id" value=<?php echo $id; ?>>
       <input type="submit" name="submit" value="Change password" class=btnsecondary>
</table>


</form>

</div>

</div>

<?php

if(isset($_POST['submit'])) //check whether button is clicked
{
   //echo "button clicked";
//1)get data from form

$id= $_POST['id'];
$current_password=md5($_POST['current_password']);
$new_password=md5($_POST['new_password']);
$confirm_password=md5($_POST['confirm_password']);
//check whether user with current id and password exists or not
$sql=" SELECT * from tbl_admin where id=$id and password='$current_password'";
$res=mysqli_query($conn,$sql);
if($res==TRUE)
{
$count=mysqli_num_rows($res);
if($count==1)
{
//user exists and password can be changed
//echo"user found";
//check password match or not

if($new_password==$current_password)
{
   //update password //echo password match
$sql2="UPDATE tbl_admin SET password='$new_password' where id=$id";
$res2= mysqli_query($conn,$sql2);

if($res2==TRUE)
{
   //display success message
   $_SESSION['change-password']="<div class='success'> Password changed successfully! </div>";
   //redirect
   header('location:'.SITEURL.'admin/manage-admin.php');
}
else{
   //display error message
   $_SESSION['change-password']="<div class='error'> Failed to change password! </div>";
   //redirect
   header('location:'.SITEURL.'admin/manage-admin.php');
}

}
else
{
//redirect to manage admin with error message
$_SESSION['passwords-not-match']="<div class='error'> Password did not match </div>";
   //redirect
   header('location:'.SITEURL.'admin/manage-admin.php');

}

}
else
{
   //user does not exist//validation to check whether user exists or nt
   $_SESSION['user_not_found']="<div class='error'> User Not Found </div>";
   //redirect
   header('location:'.SITEURL.'admin/manage-admin.php');

}

}

//check whether current or new password and confirm paasowrd match or not

//finally update password if all above is true

}

?>

<?php include('partials/footer.php'); ?>