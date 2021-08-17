<?php include('partials/menu.php'); ?> 

<div class="main-content">
<div class="wrapper">
   <h1> Update Admin Page </h1>
   <br>
   <br>
<?php
//get id of selected admin

$id=$_GET['id'];
//sql query
$sql= "SELECT * FROM tbl_admin where id=$id";
$res=mysqli_query($conn,$sql);

if($res==TRUE)
{
//check whether data is available
$count=mysqli_num_rows($res);
//check whether we have admin data ornot

if($count==1)//adding validation
{// will get the details
//echo " Admin Available";
$row=mysqli_fetch_assoc($res);
$full_name=$row['full_name'];
$username=$row['username'];

}

else{
//redirect to manage admin page
header('location:'.SITEURL.'admin/manage-admin.php');

}


}


?>


   <form action="" method="POST">
<table class="tbl-thirty">
<tr>
   <td> FullName </td>
   <td> <input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
</tr>
<tr>
   <td> Username </td>
   <td> <input type="text" name="username" value="<?php echo $username; ?>"></td>
</tr>

<tr>
<td colspan="2"> <!--to update, we need to pass id also but it wont be displayed on update page -->
   <input type="hidden" name="id" value="<?php echo $id ?>" >
<input type ="submit" name="submit" value="Update Admin" class="btnsecondary">
</td>

</tr>

</table>

</form>
</div>
</div>

<?php
//check whether submit button is clicked or not
if(isset($_POST['submit']))
{
   //echo "button clicked";
   //get all values from form to update
    $id=$_POST['id'];
   $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    //query to update admin
    $sql= "UPDATE tbl_admin SET full_name='$full_name',
    username='$username' where id='$id'";
    //execute query
    $res=mysqli_query($conn,$sql);
    
    //check whether uery executed suucessfully or not
    if($res==TRUE)
    {
       //admin updated
       $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
       header("location:".SITEURL."admin/manage-admin.php");
    }
    else
    {
      //failed to update
      $_SESSION['update']="<div class='error'> Failed to update</div>";
      header("location:".SITEURL."admin/manage-admin.php");
   }
    

   }
?>

<?php include('partials/footer.php'); ?>