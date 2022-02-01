
<?php

//include constants.php

include('../config/constants.php');
//destroy session and redirect to login page
session_destroy(); //unsets usr session

header('location:'.SITEURL.'admin/login.php');

?>