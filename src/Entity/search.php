<?php

$conn=mysqli_connect('localhost','root','','team-3-project');

//query
   $query="SELECT * FROM product";

//Get results
$result= mysqli_query($conn,$query);

//Fetch Data from database
$product=mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($product);