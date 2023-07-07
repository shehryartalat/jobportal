<!DOCTYPE html>
<html>

<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

    <?php include 'Database/connection.php' ?>


    <script>
        function validateForm() {
            var position = document.forms["myForm"]["position"].value;
            var salaryRange = document.forms["myForm"]["salaryRange"].value;
            var jobType = document.forms["myForm"]["jobType"].value;
            var address = document.forms["myForm"]["address"].value;
            var validTill = document.forms["myForm"]["validTill"].value;

            if (position == "" || salaryRange == "" || jobType == "" || address == "" || validTill == "") {
                alert("All fields are required");
                return false;
            }
        }
    </script>
</head>

<body>

    <?php include 'Component/Navbar.php' ?>
    <?php
    // Check if the user is logged in
    // Implement your authentication logic here

    // Check if user is logged in
    $isLoggedIn = isset($_SESSION['user_id']);
//     if ($isLoggedIn != 1) {
//         // Redirect the user to the login page if not logged in
// header("Location: login.php");
//         exit;
//     }

    // Get the logged-in user's ID
    $loggedInUserId = $_SESSION['user_id'];

    // Get the user ID from the URL parameter
    $userId = isset($_GET['id']) ? $_GET['id'] : $loggedInUserId;

    // Check if the logged-in user's ID matches the user ID in the URL or use the logged-in user's ID
    $isOwnProfile = $loggedInUserId == $userId;

    // Retrieve the username from the database
    // Retrieve the username from the database
    $query = "SELECT username FROM users WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // User exists, get the username
        $username = $row['username'];

        // Close the statement and result set
        $stmt->close();
        $result->close();
    } else {
        // User does not exist, show Bootstrap modal popup and redirect

        echo '<script>alert("User not found")</script>';

        header("Location: index.php");
        exit();
    }
    ?>


    <div class="container">
        <h1>Welcome, <?php echo $username; ?>!</h1>


        <?php if ($isOwnProfile) : ?>
            <div class="d-flex flex-row-reverse bd-highlight">
                <div class="p-2 bd-highlight">
                    <a href="Component/logout.php">Logout</a>
                </div>
            </div>

            <hr />

        <?php endif; ?>

        <?php if ($isOwnProfile) : ?>
            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Add Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                // Retrieve form data
                                $position = $_POST['position'];
                                $salaryRange = $_POST['salaryRange'];
                                $jobType = $_POST['jobType'];
                                $address = $_POST['address'];
                                $validTill = $_POST['validTill'];

                                // Perform database insertion
                                $insertQuery = "INSERT INTO jobs (user_id, position, salaryRange, type, address, date) VALUES ('$loggedInUserId', '$position', '$salaryRange', '$jobType', '$address', '$validTill')";
                                $insertResult = mysqli_query($connection, $insertQuery);

                                if ($insertResult) {
                                    echo '<script>alert("Form submitted successfully!");</script>';
                                } else {
                                    echo '<script>alert("Failed to submit form.");</script>';
                                }
                            }
                            ?>

                            <div class='addPost'>
                                <form name="myForm" method="POST" onsubmit="return validateForm()">
                                    <div class="mb-2">
                                        <label for="position" class="form-label">Position</label>
                                        <input type="text" name="position" class="form-control" placeholder="Position" id="position" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-2">
                                        <label for="salaryRange" class="form-label">Salary Range</label>
                                        <select name="salaryRange" class="form-select" aria-label="Default select example">
                                            <option selected>Salary Range</option>
                                            <option value="10000-50000">10000-50000</option>
                                            <option value="60000-80000">60000-80000</option>
                                            <option value="80000-100000">80000-100000</option>
                                        </select>
                                    </div>

                                    <div class="mb-2">
                                        <label for="jobType" class="form-label">Job Type</label>
                                        <select name="jobType" class="form-select" aria-label="Default select example">
                                            <option selected>Job Type</option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Part Time">Part Time</option>
                                            <option value="Online">Online</option>
                                        </select>
                                    </div>

                                    <div class="mb-2">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" placeholder="Address" id="address" aria-describedby="emailHelp">
                                    </div>

                                    <div class="mb-2">
                                        <label for="validTill" class="form-label">Valid Till</label>
                                        <input type="date" name="validTill" class="form-control" placeholder="Valid till" id="validTill" aria-describedby="emailHelp">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <div class="d-flex flex-row-reverse bd-highlight">
                <div class="p-2 bd-highlight">
                    <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Add Post</a>
                </div>
            </div>

        <?php endif; ?>

        <h2>Manage Job Posts</h2>
        <?php
        // Fetch jobs from the database for the logged-in user
        $query = "SELECT * FROM jobs WHERE user_id = '$loggedInUserId'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $position = $row['position'];
                $location = $row['address'];
                $jobType = $row['type'];
                $salaryRange = $row['salaryRange'];
                $date = $row['date'];
                $jobId = $row['id'];

        ?>

                <div class="job-item p-4 mb-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-md-8 d-flex align-items-center">
                            <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                            <div class="text-start ps-4">
                                <h5 class="mb-3"><?php echo $position; ?></h5>
                                <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo $location; ?></span>
                                <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?php echo $jobType; ?></span>
                                <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i><?php echo $salaryRange; ?></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                            <div class="d-flex mb-3">
                                <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                <!-- Show delete button for the logged-in user's own job -->
                                <a class="btn btn-danger" href="delete.php?id=<?php echo $jobId; ?>">Delete</a>
                            </div>
                            <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: <?php echo $date; ?></small>
                        </div>
                    </div>
                </div>

        <?php
            }
        } else {
            // No jobs found
            echo "<div class='text-center'>No jobs available.</div>";
        }
        ?>



        <?php if ($isOwnProfile) : ?>
            <h2>Applied Jobs</h2>

            <div class="row">
                <?php
                // Fetch applications from the database
                $query = "SELECT * FROM applications WHERE user_id = '$loggedInUserId'";
                $result = mysqli_query($connection, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $applicationId = $row['id'];
                        $jobId = $row['job_id'];
                        $status = $row['status'];

                        // Retrieve job details
                        $jobQuery = "SELECT * FROM jobs WHERE id = '$jobId'";
                        $jobResult = mysqli_query($connection, $jobQuery);
                        $jobRow = mysqli_fetch_assoc($jobResult);

                        $position = $jobRow['position'];
                        $location = $jobRow['address'];
                        $jobType = $jobRow['type'];
                        $salaryRange = $jobRow['salaryRange'];
                        $date = $jobRow['date'];

                        // Display application card
                ?>
                        <div class="col-sm-12 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $position; ?></h5>
                                    <h6 class="card-subtitle mb-3"><?php echo $location; ?></h6>
                                    <p class="card-text">
                                        <strong>Job Type:</strong> <?php echo $jobType; ?><br>
                                        <strong>Salary Range:</strong> <?php echo $salaryRange; ?><br>
                                        <strong>Date Line:</strong> <?php echo $date; ?>
                                    </p>
                                    <p class="card-text"><strong>Status:</strong> <?php echo $status; ?></p>
                                    <!-- <a href="#" class="btn btn-primary">View Details</a> -->
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    // No applications found
                    echo '<div class="alert alert-info" role="alert">No applications available.</div>';
                }
                ?>
            </div>
        <?php endif; ?>
    </div>


    <?php include 'Component/Footer.php' ?>

</body>

</html>