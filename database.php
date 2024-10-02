<?php 
session_start();
$servername="localhost";
$username="root";
$password="";
$db="ccetblog";
$conn=new mysqli($servername,$username,$password,$db);
if($conn->connect_error){
    echo "Unable to Connect to Database";
}
?>