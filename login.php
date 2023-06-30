<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet prefetch" href="https://fonts.googleapis.com/css?family=Open+Sans:600">
  <link rel="stylesheet" href="./css/login.css">

  <?php include 'Database/connection.php' ?>

</head>


<body>
  <?php include 'Component/Navbar.php'  ?>

  <?php

  
// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

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
      if (password_verify($password, $user['password'])) {
        // Password is correct, set session variables and redirect to the dashboard
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: profile.php");
        exit();
      } else {
        // Invalid password
        echo '<script>
      alert("Invalid username or password.")
  </script>';
      }
    } else {
      // User not found
      echo '<script>
  alert("Invalid username or password.")
</script>';
    }
  }

  // Check if the signup form is submitted
  if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate form inputs
    if (empty($username) || empty($password) || empty($confirmPassword)) {
      echo '<script>
  alert("Please fill in all fields.")
</script>';
    } elseif ($password !== $confirmPassword) {
      echo '<script>
  alert("Passwords do not match.")
</script>';
    } else {
      // Check if the username already exists
      $query = "SELECT * FROM users WHERE username='$username'";
      $result = mysqli_query($connection, $query);

      if ($result && mysqli_num_rows($result) > 0) {
        echo '<script>
      alert("Username already exists.")
  </script>';
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
          echo '<script>
        alert("Error creating user. Please try again.")
    </script>';
          $signupError = "Error creating user. Please try again.";
        }
      }
    }
  }
  ?>
  <div class="login-wrap">
    <div class="login-html">
      <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
      <label for="tab-1" class="tab">Sign In</label>
      <input id="tab-2" type="radio" name="tab" class="sign-up">
      <label for="tab-2" class="tab">Sign Up</label>
      <div class="login-form">
        <form class="sign-in-htm" method="POST" action="login.php">
          <div class="group">
            <label for="user" class="label">Username</label>
            <input id="username" name="username" type="text" class="input">
          </div>
          <div class="group">
            <label for="pass" class="label">Password</label>
            <input id="password" name="password" type="password" class="input" data-type="password">
          </div>
          <div class="group">
            <input id="check" type="checkbox" class="check">
            <label for="check"><span class="icon"></span> Keep me Signed in</label>
          </div>
          <div class="group">
            <input type="submit" class="button" value="Sign In" name="login">
          </div>
          <div class="hr"></div>
          <div class="foot-lnk">
            <a href="#forgot">Forgot Password?</a>
          </div>
        </form>
        <form class="sign-up-htm" name="myForm" method="POST" action="login.php">
          <div class="group">
            <label for="user" class="label">Username</label>
            <input id="username" name="username" type="text" class="input">
          </div>
          <div class="group">
            <label for="pass" class="label">Password</label>
            <input id="password" name="password" type="password" class="input" data-type="password">
          </div>
          <div class="group">
            <label for="pass" class="label">Confirm Password</label>
            <input id="pass" name="confirmPassword" type="password" class="input" data-type="password">
          </div>
          <div class="group">
            <input type="submit" class="button" value="Sign Up" name="signup">
          </div>
          <div class="hr"></div>
          <div class="foot-lnk">
            <label for="tab-1">Already Member?</label>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>