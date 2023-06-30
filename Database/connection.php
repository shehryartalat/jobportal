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


    // Create jobs table
    $query = "CREATE TABLE IF NOT EXISTS jobs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        position VARCHAR(100) NOT NULL,
        salaryRange VARCHAR(100),
        type VARCHAR(100),
        address VARCHAR(100),
        date VARCHAR(100),
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    
    mysqli_query($connection, $query);

    // Create applications table
    $query = "CREATE TABLE IF NOT EXISTS applications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        job_id INT,
        status VARCHAR(100),
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (job_id) REFERENCES jobs(id)
    )";

    mysqli_query($connection, $query);
}
?>
