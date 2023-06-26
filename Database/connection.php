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

    $query = "CREATE TABLE IF NOT EXISTS job(id int auto_increment primary key, position varchar(100), salaryRange varchar(100), type varchar(100), address varchar(100), date varchar(100))";
    
    mysqli_query($connection, $query);
}

// Check if the login form is submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to retrieve the user from the database
    $query = "SELECT * FROM users WHERE username='$username'";

    // Execute the query
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables and redirect to the dashboard
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid password
            $loginError = "Invalid username or password.";
        }
    } else {
        // User not found
        $loginError = "Invalid username or password.";
    }
}

// Check if the signup form is submitted
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate form inputs
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        $signupError = "Please fill in all fields.";
    } elseif ($password !== $confirmPassword) {
        $signupError = "Passwords do not match.";
    } else {
        // Check if the username already exists
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $signupError = "Username already exists.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user into the database
            $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
            $result = mysqli_query($connection, $query);

            if ($result) {
                // Registration successful, redirect to the login page
                header("Location: login.php");
                exit();
            } else {
                $signupError = "Error creating user. Please try again.";
            }
        }
    }
}
?>
