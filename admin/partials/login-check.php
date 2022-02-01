<?php

//Authorization-Access Control

if(!isset($_SESSION['user'])) //if user session is not set
{

  $_SESSION['no-login-message']= "<div class='error text-center'> Please login to access admin panel. </div>";

   header('location:'.SITEURL.'admin/login.php');
}

?>