<?php include('partials.front/menu.php') ?>;

		<!-- fOOD sEARCH Section Starts Here -->
		<section class="food-search text-center">
			<div class="container">
				<form action="<?php echo SITEURL;?>food-search.php" method="POST">
					<input
						type="search"
						name="search"
						placeholder="Search for Food.."
						required
					/>
					<input
						type="submit"
						name="submit"
						value="Search"
						class="btn btn-primary"
					/>
				</form>
			</div>
		</section>
		<!-- fOOD sEARCH Section Ends Here -->

		<!-- fOOD MEnu Section Starts Here -->
		<section class="food-menu">
			<div class="container">
				<h2 class="text-center">Food Items Available Today</h2>
<?php
$sql1= "SELECT * from tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 10";

$res1=mysqli_query($conn,$sql1);
$count1=mysqli_num_rows($res1);
if($count1>0)
{
	while($row1=mysqli_fetch_assoc($res1))
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
	echo "<div class='error'> Food Item not available.</div>";
}

?>
		

			<div class="clearfix"></div>
			</div>

			<p class="text-center">
				<a href="#">See Food Menu</a>
			</p>
		</section>
		<!-- fOOD Menu Section Ends Here -->

		<?php include('partials.front/footer.php'); ?>