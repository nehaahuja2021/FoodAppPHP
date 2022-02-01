<?php include('partials.front/menu.php');?>

<?php
//check whether id is passed
if(isset($_GET['category_id']))
{
	$category_id=$_GET['category_id'];
	$sql= "SELECT title from tbl_category WHERE id= $category_id";
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($res);

$cat_title=$row['title'];

}
else{
	header('location:'.SITEURL);
}
?>

		<!-- fOOD sEARCH Section Starts Here -->
		<section class="food-search text-center">
			<div class="container">
				<h2>Your Search On: <a href="#" class="text-white">"<?php echo $cat_title;?>"</a></h2>
			</div>
		</section>
		<!-- fOOD sEARCH Section Ends Here -->

		<!-- fOOD MEnu Section Starts Here -->
		<section class="food-menu">
			<div class="container">
				<h2 class="text-center">Food Menu</h2>
<?php
$sql5="SELECT * from tbl_food WHERE category_id=$category_id";
$res5=mysqli_query($conn,$sql5);
$count=mysqli_num_rows($res5);
if($count>0)
{
	while($row1=mysqli_fetch_assoc($res5))
	{

		$id=$row1['id'];
		$title=$row1['title'];
		$price=$row1['price'];
		$description=$row1['description'];
		$image_name=$row1['image_name'];
?>
<div class="food-menu-box">
					<div class="food-menu-img">
					<?php
if($image_name=="")
{
	echo " <div class='error'>Image not available</div>";
}
else{
	//image available
?>
<img src="<?php echo SITEURL;?>images\food\<?php echo $image_name; ?>"	alt="Pizza" 	class="img-responsive img-curve"/>
<?php
}
?>
					</div>

					<div class="food-menu-desc">
						<h4><?php echo $title;  ?></h4>
						<p class="food-price"><?php echo $price;  ?></p>
						<p class="food-detail">
						<?php echo $description;  ?>
						</p>
						<br />

						<a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
					</div>
				</div>
				<?php
}
}
else
{
	echo "<div class='error'> Food Item under this category is not available.</div>";
}



?>
				

					

				<div class="clearfix"></div>
			</div>
		</section>
		<!-- fOOD Menu Section Ends Here -->

	<?php	include('partials.front/footer.php'); ?>