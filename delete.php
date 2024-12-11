<?php
session_start(); 

if (!isset($_SESSION['logged_in'])) 
{
    header("Location: login.php");
    exit();
}
$con = mysqli_connect('localhost', 'root', '', 'Lab_5b');

if (!$con) 
{
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['matric'])) 
{
    $matric = $_GET['matric'];

    $sql = "DELETE FROM `users` WHERE `matric` = '$matric'";

    if (mysqli_query($con, $sql)) 
    {
        echo "User deleted successfully!";
        header("Location: read.php");
        exit();
    } 
    
    else 
    
    {
        echo "Error deleting user: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>