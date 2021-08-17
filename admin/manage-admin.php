<?php include('partials/menu.php');?>




<!--Main Content Section Starts Here-->
<div class="main-content">
   <div class="wrapper">
<h1> Manage Admin </h1>
<br>
<br>
<?php //start php
if (isset($_SESSION['add']))
{
     echo $_SESSION['add'];//displying message
     unset($_SESSION['add']) ;// removing session message
}
if (isset($_SESSION['delete']))
{
     echo $_SESSION['delete'];//displying message
     unset($_SESSION['delete']) ;// removing session message
}
if (isset($_SESSION['update']))
{
     echo $_SESSION['update'];//displying message
     unset($_SESSION['update']) ;// removing session message
}



?>
<br>
<br>
<!--button to add admin -->
<a href="add-admin.php" class="btnprimary">Add admin </a>
<br> 
<br>
<br>
<table class= "tblfull">
<tr>
   <th> S.No </th>
   <th>Full Name </th>
   <th> User Name </th>
   <th> Actions </th>
</tr>
<?php
$sql= "SELECT * from tbl_admin";

$res=mysqli_query($conn,$sql);
if($res==TRUE)
{
     //count rows to check whether we have data in db

     $count=mysqli_num_rows($res);//function to get all rows in db

     if($count>0)
     {
          //we have data in db
          while($rows=mysqli_fetch_assoc($res))
          {
               $id=$rows['id'];
               $full_name=$rows['full_name'];
               $username=$rows['username'];

               //display value in table break php here
               ?>

<tr>
<td>  <?php echo $id?> </td>
<td><?php echo $full_name?>  </td>
<td> <?php echo $username?>   </td>
<td> <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btnsecondary">Update admin </a>
     <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btndanger">Delete Admin  </a>
     
</td>
</tr>
               <?php

          }
     }

     else
     {
          //dont have data in db
     }
}

?>
</table>

</div>
</div>
<!--Main Content Section Ends Here-->

<?php include('partials/footer.php'); ?>