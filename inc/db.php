<?php
$server = "localhost";
$username = "root"; //Username
$password = "";	//Password
$database = "md5"; //Database Name

$connection = mysqli_connect($server,$username,$password,$database);

if(!$connection)
{
  die("Unable to connect to server");
}
?>
