<?php
include('../config/constants.php');
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
//get the value and delete
$id= $_GET['id'];
$image_name=$_GET['image_name'];

//remove image from category folder first and then from DB
if($image_name!= " ") //image is available
{
$path="../images/food/$image_name"; //get path
$remove=unlink($path); //unlink image from folder
if($remove==false) //failed to remove
{
//set session message and redirect to mamnage category page
$_SESSION['remove']="<div class='error'> Failed to remove image </div>";
header('location:'.SITEURL.'/admin/manage-food.php');
die();//stop the process
}
}

//Delete from db

$sql="DELETE FROM tbl_food WHERE id=$id";
$res=mysqli_query($conn,$sql);

if($res==true)
{
$_SESSION['delete']="<div class='success'>Food Item deleted successfully.</div>";

header('location:'.SITEURL.'admin/manage-food.php');
}
else
{
   $_SESSION['delete']="<div class='error'>Failed to delete food item.</div>";
   header('location:'.SITEURL.'admin/manage-food.php');
}

}
else{

   header('location:'.SITEURL.'admin\manage-food.php');
}
?>