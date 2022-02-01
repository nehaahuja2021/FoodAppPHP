<?php include('partials\menu.php'); ?>
<div class="main-content">

<div class="wrapper">

<h1> Add Category<h1>
<br>
<?php

if (isset($_SESSION['add'])) //checking whether session is set or not
{
   echo $_SESSION['add'];
   unset ($_SESSION['add']);
}

if (isset($_SESSION['upload'])) //checking whether session is set or not
{
   echo $_SESSION['upload'];
   unset ($_SESSION['upload']);
}
?>
<br><br>
<!--add category form-->
<form action = "" method="POST" enctype="multipart/form-data">
<table class="tbl-thirty">
<tr>
   <td> Title: </td>
   <td> <input type="text" name="title" placeholder="category title"></td>
</tr>

<tr> 
<td> Select Image: </td>
<td> <input type="file" name="image"> </td>
</tr>

<tr>
   <td> Featured: </td>
   <td> 
      <input type="radio" name="featured" value="Yes"> Yes
      <input type="radio" name="featured" value="No"> No
   </td>
</tr>

<tr>
<td>Active: </td>
<td> 
      <input type="radio" name="active" value="Yes"> Yes
      <input type="radio" name="active" value="No"> No
   </td>
</tr>
<tr>
<td colspan="2">
<input type="submit" name="submit" value="Add Category" class="btnsecondary">
</td>
</tr>
</table>
</form> <!--category orm ends-->

<?php
if(isset($_POST['submit']))
{
   //get value from category form

   $title= $_POST['title'];
   //for radio input type check whether button is selected or not
if(isset($_POST['featured']))
{
//get value from form

$featured=$_POST['featured'];
}
else{
   //set default value
   $featured="No";
}

if(isset($_POST['active']))
{
$active= $_POST['active'];

}
else{
   $active="No";
}
//check whtehr image is selected or not n set value for imagename

//print_r($_FILES['image']);

//die();
 if(isset($_FILES['image']['name'])) //if filetype image has name, only then it will be uploaded
 {
$image_name=$_FILES['image']['name'];
//autorename image else it will replace the image uploaded with same name
//get the extension of the image e.g food.jpg
$ext= end(explode('.',$image_name)); // get extension

$image_name="Food_Category".rand(000,999).'.'.$ext; //e.g Food_Category_512

$source_path=$_FILES['image']['tmp_name'];
$destination_path="../images/category/$image_name";
//finally upload
$upload=move_uploaded_file($source_path,$destination_path);
//check whether image is uploaded or not and if image s not uploaded we will stop the process and redirect with error message

if($upload==FALSE)
{ //set message
   $_SESSION['upload']="<div class='error'> Failed to upload </div>";
   header('location:'.SITEURL.'admin/add-category.php');
   // stop the process if we failed to upload image, we do want data to be inserted in db
   die(); 
}
 }
 else{
//do not uplod imge and set value as blank
$image_name="";
 }



//execute query to insrt data in db
$sql="INSERT INTO tbl_category SET
title='$title', image_name='$image_name',featured='$featured',active='$active'";

$res=mysqli_query($conn,$sql);
//check whether query execute successfully and data inserted

if($res==TRUE)
{
//query executed
$_SESSION['add']="<div class='success'>Category added successfully</div>";


//redirect to manage category page
header('location:'.SITEURL.'admin/manage-category.php');

}
else{
//failed
$_SESSION['add']="<div class='error'> Failed to add category </div>";
//stays at same page
header('location:'.SITEURL.'admin/add-category.php');

}


}
?>
</div>
</div>








<?php include('partials\footer.php'); ?>
