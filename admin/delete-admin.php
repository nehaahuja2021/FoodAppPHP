<?php
//include constants.php file
include('../config/constants.php');

// 1)get id of admin to be deleted

 $id= $_GET['id'];
 
//2) create sql query to delete admin

$sql= "DELETE from tbl_admin where id=$id";
//execute query
$res= mysqli_query($conn,$sql);
//check query executed successfully

if($res==TRUE)
{
   //query executed successfully
   //echo "Admin Deleted";
   //create session variable to display message
   $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
   //redirect to manage-admin page

   header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
//echo "Failed to execute";

$_SESSION['delete']="<div class='error'>Failed to Delete Admin </div>";
header('location:'.SITEURL.'admin/manage-admin.php');
}




//3) redirect to manage-admin pg with message (success or error)



?>