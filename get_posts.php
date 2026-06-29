<?php

header("Content-Type: application/json");

include "db.php";

$result=$conn->query("SELECT * FROM posts");

$posts=[];

while($row=$result->fetch_assoc()){

    $posts[]=$row;

}

echo json_encode($posts);

?>