<?php
$serverName = "localhost";
$username = 'root';
$password = 'root';
$dbName = 'jobPortal';
$query = "";

$currentUser; // Data of Current User who is logged In

$connection = mysqli_connect($serverName, $username, $password, $dbName);

if (!$connection) {
    echo '<script>
        alert("Connection to Database failed!")
    </script>';
} else {
    createTables();
}

function createTables()
{
    global $connection, $query;
    
    // Create users table
    $query = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";

    mysqli_query($connection, $query);


    $query = "CREATE TABLE IF NOT EXISTS job(user_id INT,id int auto_increment primary key, position varchar(100), salaryRange varchar(100), type varchar(100), address varchar(100), date varchar(100))";
    
    mysqli_query($connection, $query);
}

?>
