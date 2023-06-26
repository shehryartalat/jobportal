<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet prefetch" href="https://fonts.googleapis.com/css?family=Open+Sans:600">
  <link rel="stylesheet" href="./css/login.css">
</head>

<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["username"]) && isset($_GET["password"])) {
  $username = $_GET["username"];
  $password = $_GET["password"];
  
  if (validateSignInForm($username, $password)) {
      // Perform sign-in logic here
      signIn($username, $password);
  } else {
      echo '<script>
          alert("Invalid sign-in credentials!");
      </script>';
  }
}

// Handle sign-up form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirm_password"];
  
  if (validateSignUpForm($username, $password, $confirmPassword)) {
      // Perform sign-up logic here
      signUp($username, $password);
  } else {
      echo '<script>
          alert("Invalid sign-up credentials!");
      </script>';
  }
}

function validateSignInForm($username, $password) {
  // Add your custom validation logic for sign-in form here
  // For example, you can check if the fields are not empty
  if (empty($username) || empty($password)) {
      return false;
  }
  
  return true;
}

function validateSignUpForm($username, $password, $confirmPassword) {
  // Add your custom validation logic for sign-up form here
  // For example, you can check if the fields are not empty and if the passwords match
  if (empty($username) || empty($password) || empty($confirmPassword) || $password != $confirmPassword) {
      return false;
  }
  
  return true;
}

function signIn($username, $password) {
  // Add your sign-in logic here
  // For example, you can query the database to check if the credentials are valid
  
  // Sample code to check against a hard-coded username and password
  $validUsername = "admin";
  $validPassword = "password";
  
  if ($username == $validUsername && $password == $validPassword) {
      // Sign-in successful
      // Redirect to the desired page
      header("Location: welcome.php");
      exit();
  } else {
      // Invalid credentials
      echo '<script>
          alert("Invalid sign-in credentials!");
      </script>';
  }
}

function signUp($username, $password) {
  // Add your sign-up logic here
  // For example, you can insert the user into the database
  
  // Sample code to insert the user into the database
  $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
  
  if (mysqli_query($connection, $query)) {
      // Sign-up successful
      // Redirect to the desired page
      header("Location: welcome.php");
      exit();
  } else {
      // Failed to sign up
      echo '<script>
          alert("Failed to sign up!");
      </script>';
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
        <form class="sign-in-htm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" onsubmit="return validateSignInForm()">
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
            <input type="submit" class="button" value="Sign In">
          </div>
          <div class="hr"></div>
          <div class="foot-lnk">
            <a href="#forgot">Forgot Password?</a>
          </div>
        </form>
        <form class="sign-up-htm"  name="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validateSignUpForm()">
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
            <input id="pass" type="password" class="input" data-type="password">
          </div>
          <div class="group">
            <input type="submit" class="button" value="Sign Up">
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