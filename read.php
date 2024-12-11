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

$sql = "SELECT * FROM `users`";
$result = mysqli_query($con, $sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) 
{
    session_destroy();
    header("Location: login.php");
    exit();
}

echo "<table border='1'>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th colspan='2'>Action</th>
        </tr>";

if (mysqli_num_rows($result) > 0) 
{
    while ($row = mysqli_fetch_assoc($result)) 
    {
        echo "<tr>
                <td>{$row['matric']}</td>
                <td>{$row['name']}</td>
                <td>{$row['role']}</td>
                <td>
                    <a href='update.php?matric={$row['matric']}'>Update</a>
                </td>
                <td>
                    <a href='delete.php?matric={$row['matric']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                </td>
              </tr>";
    }
} 

else 
{
    echo "<tr>
            <td>No users found</td>
          </tr>";
}

echo "</table>";
echo "<br>";

echo "<form action='' method='POST'>
            <input type='submit' name='logout' value='Logout'>
      </form">

mysqli_close($con);
?>