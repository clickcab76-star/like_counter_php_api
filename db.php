<?php

$host="localhost";
$user="root";
$password="";
$database="like_counter";

$conn = new mysqli($host,$user,$password,$database);

if($conn->connect_error){
    die("Connection Failed");
}

?>