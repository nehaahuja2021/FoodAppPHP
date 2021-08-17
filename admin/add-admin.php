<?php include('partials/menu.php'); ?> 

<div class="main-content">

<div class="wrapper">

<h1> Add Admin <h1>
<br>
<?php

if (isset($_SESSION['add'])) //checking whether session is set or not
{
   echo $_SESSION['add'];
   unset ($_SESSION['add']);
}

?>

<form action = "" method="POST">
<table class="tbl-thirty">
<tr>
   <td> FullName </td>
   <td> <input type="text" name="full_name" placeholder="enter your name"></td>
</tr>
<tr>
   <td> Username </td>
   <td> <input type="text" name="username" placeholder="username"></td>
</tr>

<tr>
   <td> Password </td>
   <td> <input type="password" name="password" placeholder="password"></td>
</tr>

<tr>
<td colspan="2">
<input type ="submit" name="submit" value=" Add Admin" class="btnsecondary">
</td>

</tr>

</table>


</form>
</div>


</div>



<?php include('partials/footer.php'); ?> 


<?php
//process value of form and save it to DB
if (isset($_POST['submit']))
{
   //echo "button clicked";
   //get data from form

    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);//password encrypt with md5 function
//sql query to save in db

$sql=" INSERT into tbl_admin SET
full_name=' $full_name',
username='$username',
password='$password'";



//execute query and save data in db
$res= mysqli_query($conn,$sql) or die(mysqli_error());

//check whether data is inserted

if($res==TRUE)
{
//echo"data inserted";

//create session variable to display message
$_SESSION['add']="<div class='success'>Admin added successfully</div>";

//redirect
header("location:".SITEURL.'admin/manage-admin.php');
}
else{
   //echo"data not inserted";

   $_SESSION['add']="<div class='error'> Failed to add Admin </div>";

//redirect
header("location:".SITEURL.'admin/add-admin.php');
}

}


?>