<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'Lab_5b');
if (!$con) 
{
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) 
{
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE `matric` = '$matric'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) 
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['matric'] = $matric; 

        header("Location: read.php");
        exit();
    } 
    
    else
    {
        $error_message = "Invalid username or password.";
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
        <h1>Login Page</h1>
        <?php
        if (isset($error_message)) 
        {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
        <form action="" method="POST">
            <label for="matric">Matric: </label>
            <input type="text" name="matric" id="matric" required><br>

            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required><br>

            <input type="submit" name="login" value="Login">
        </form>
        <br>
        <a href="register.html" class="register-link">Register</a> here if you have not.
</body>
</html>