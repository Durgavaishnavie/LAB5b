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

    $sql = "SELECT * FROM `users` WHERE `matric` = '$matric'";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) 
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update User</title>
        </head>
        <body>
            <div>
                <h2>Update User</h2>
                <form action="update.php" method="POST">
                    <label for="matric">Matric</label>
                    <input type="text" name="matric" id="matric" value="<?php echo $row['matric']; ?>" readonly><br>

                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required><br>

                    <label for="role">Access Level</label>
                    <select name="role" id="role" required>
                        <option value="student" <?php if ($row['role'] == 'student') echo 'selected'; ?>>Student</option>
                        <option value="lecturer" <?php if ($row['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
                    </select><br>

                    <input type="submit" name="update" value="Update">
                    <a href="read.php">Cancel</a>
                </form>
            </div>
        </body>
        </html>
        <?php
    } 
    
    else 
    {
        echo "User not found!";
    }
}

if (isset($_POST['update'])) 
{
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE `users` SET `name` = '$name', `role` = '$role' WHERE `matric` = '$matric'";

    if (mysqli_query($con, $sql)) 
    {
        echo "User updated successfully!";
        header("Location: read.php");
        exit();
    } 
    
    else 
    {
        echo "Error updating user: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>