<?php

$con = mysqli_connect('localhost', 'root', '', 'Lab_5b');

$matric = $_POST['matric'];
$name = $_POST['name'];
$password = $_POST['password'];
$role = $_POST['role'];

$sql = "INSERT INTO `users`(`matric`, `name`, `password`, `role`) VALUES ('$matric','$name','$password','$role')";

$rs = mysqli_query($con, $sql);

if($rs)
{
    echo "User registration inserted successfully!";
}

?>