<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "antara";
$conn = mysqli_connect($server,$username,$password,$db);
if ($conn){

}else{
    die("error". mysqli_connect_error());
}
?>