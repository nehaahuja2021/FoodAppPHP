<?php include('partials\menu.php'); ?>
<div class="main-content">

<div class="wrapper">

<h1> Add Food<h1>
<br><br>

<?php

if (isset($_SESSION['upload'])) //checking whether session is set or not
{
   echo $_SESSION['upload'];
   unset ($_SESSION['upload']);
}


?>
<form action="" method="POST" enctype="multipart/form-data">
<table class="tbl-thirty">
<tr>
   <td> Title: </td>
   <td> <input type="text" name="title" placeholder="Enter title"></td>
</tr>
<tr>
   <td> Description: </td>
   <td> <textarea name="description"  cols="30" rows="5" placeholder="Enter Description"></textarea></td>
</tr>
<tr>
   <td> Price: </td>
   <td> <input type="number" name="price"></td>
</tr>
<tr>
   <td>Select Image:</td>
  <td> <input type="file" name="image"></td>

<tr>
<td>Category:</td>
<td> <select name="category">
   <?php //create php code to display category from db 
$sql="SELECT * FROM tbl_category where active='Yes'";
$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);

if($count>0)
{

   while($row=mysqli_fetch_assoc($res))
   {
      //get the details of all categories present

      $id=$row['id'];
      $title=$row['title'];
      ?>

      <option value="<?php echo $id;?>"><?php echo $title;?> </option>
      <?php

   }
}
else{
   //we do not have active categories
   ?>
    <option value="0">No Categories found </option>
   <?php
  
}

?>
  
</select> </td>
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
<input type="submit" name="submit" value="Add Food" class="btnsecondary">
</td>
</tr>

</table>
</form>
<?php
if(isset($_POST['submit']))
{
$title=$_POST['title']; //get data from form  3)insert into db 4)rdirect to manage food page
$description=$_POST['description'];
$price=$_POST['price'];
$category=$_POST['category'];
$featured=$_POST['featured'];

$active=$_POST['active'];
if(isset($_POST['featured']))
{
   $featured=$_POST['featured'];
}
else{
   //seting default value
   $featured="No";
}
if(isset($_POST['active']))
{
   $active=$_POST['active'];
}
else{
   //set default value 
   $active="No";
}


// 2)upload image if selected
//check if select image is clicked or not
if(isset($_FILES['image']['name']))
{
$image_name=$_FILES['image']['name'];
//check if image is selected or not and uplod image only if selected
//if($image_name!="")
//{
   //rename image and then upload
$ext=end(explode('.',$image_name));
$image_name="Food_Name".rand(0000,9999).'.' .$ext;
//$image_name="Food_Category".rand(000,999).'.'.$ext;
//get source path which is the current path
$src= $_FILES['image']['tmp_name'];
$dst= "../images/food/$image_name";
//$destination_path="../images/category/$image_name";
$upload=move_uploaded_file($src,$dst);
if($upload==FALSE)
{
   $_SESSION['upload']="<div class='error'> Failed to upload </div>";
header('location:'.SITEURL.'admin/add-food.php');

   die();
}
}
//
else{
   //set default value to blank
   $image_name =" ";
}

//execute query to insrt data in db
$sql2="INSERT INTO tbl_food SET
title='$title',
description='$description',
price=$price,
 image_name='$image_name',
 category_id=$category,
 featured='$featured',
 active='$active'";

$res2=mysqli_query($conn,$sql2);
//check whether query execute successfully and data inserted

if($res2==TRUE)
{
//query executed
$_SESSION['add']="<div class='success'>Food item added successfully</div>";
//redirect to manage category page
header('location:'.SITEURL.'admin/manage-food.php');
}
else{
//failed
$_SESSION['add']="<div class='error'> Failed to add food item </div>";
//stays at same page
header('location:'.SITEURL.'admin/add-food.php');
}
}
?>
</div>
</div>














<?php include('partials\footer.php'); ?>
