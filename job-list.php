<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    include 'Database/connection.php';
    ?>
    <meta charset="utf-8">
    <title>JobEntry - Job Portal Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <?php include 'Component/Navbar.php'  ?>
        <!-- Navbar End -->


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Job List</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Job List</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Header End -->



        <!-- Jobs Start -->
        <div class="container-xxl py-5">

            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listing</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                                <h6 class="mt-n1 mb-0">Featured</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                                <h6 class="mt-n1 mb-0">Full Time</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                                <h6 class="mt-n1 mb-0">Part Time</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <?php
                            // Fetch job records from the database
                            $query = "SELECT * FROM jobs";
                            $result = mysqli_query($connection, $query);

                            // Iterate over each job record
                            while ($row = mysqli_fetch_assoc($result)) {
                                $position = $row['position'];
                                $location = $row['address'];
                                $jobType = $row['type'];
                                $salaryRange = $row['salaryRange'];
                                $date = $row['date'];
                                $jobId = $row['id']
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
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal<?php echo $jobId; ?>">Apply Now</button>
                                            </div>
                                            <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: <?php echo $date; ?></small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Apply Modal -->
                                <div class="modal fade" id="applyModal<?php echo $jobId; ?>" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="applyModalLabel">Apply for <?php echo $position; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                if (isset($_POST['submitApplication'])) {
                                                    // Enable error reporting and display errors
                                                    error_reporting(E_ALL);
                                                    ini_set('display_errors', 1);

                                                    // Retrieve form data

                                                    // Insert application data into the database
                                                    $query = "INSERT INTO applications (user_id, job_id, status) VALUES ($isLoggedIn, $jobId, 'Padding')";

                                                    // Debugging: Display the query
                                                    // echo "Query: $query<br>";

                                                    if (mysqli_query($connection, $query)) {
                                                        echo '<script>alert("Form submitted successfully!");</script>';
                                                    } else {
                                                        $error = mysqli_error($connection);
                                                        echo "<script>alert('Failed to submit form. Error: $error');</script>";
                                                    }
                                                }

                                                ?>

                                                <form method="post">
                                                    <button type="submit" name="submitApplication" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php
                            }
                            ?>


                        </div>

                        <div id="tab-2" class="tab-pane fade show p-0 ">
                            <?php
                            // Fetch job records from the database
                            $query = "SELECT * FROM jobs where type='Full Time'";
                            $result = mysqli_query($connection, $query);

                            // Iterate over each job record
                            while ($row = mysqli_fetch_assoc($result)) {
                                $position = $row['position'];
                                $location = $row['address'];
                                $jobType = $row['type'];
                                $salaryRange = $row['salaryRange'];
                                $date = $row['date'];
                                $jobId = $row['id']
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
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal<?php echo $jobId; ?>">Apply Now</button>
                                            </div>
                                            <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: <?php echo $date; ?></small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Apply Modal -->
                                <div class="modal fade" id="applyModal<?php echo $jobId; ?>" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="applyModalLabel">Apply for <?php echo $position; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                if (isset($_POST['submitApplication'])) {
                                                    // Enable error reporting and display errors
                                                    error_reporting(E_ALL);
                                                    ini_set('display_errors', 1);

                                                    // Retrieve form data

                                                    // Insert application data into the database
                                                    $query = "INSERT INTO applications (user_id, job_id, status) VALUES ($isLoggedIn, $jobId, 'Padding')";

                                                    // Debugging: Display the query
                                                    // echo "Query: $query<br>";

                                                    if (mysqli_query($connection, $query)) {
                                                        echo '<script>alert("Form submitted successfully!");</script>';
                                                    } else {
                                                        $error = mysqli_error($connection);
                                                        echo "<script>alert('Failed to submit form. Error: $error');</script>";
                                                    }
                                                }

                                                ?>

                                                <form method="post">
                                                    <button type="submit" name="submitApplication" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php
                            }
                            ?>


                        </div>

                        <div id="tab-3" class="tab-pane fade show p-0 ">
                            <?php
                            // Fetch job records from the database
                            $query = "SELECT * FROM jobs where type='Part Time'";
                            $result = mysqli_query($connection, $query);

                            // Iterate over each job record
                            while ($row = mysqli_fetch_assoc($result)) {
                                $position = $row['position'];
                                $location = $row['address'];
                                $jobType = $row['type'];
                                $salaryRange = $row['salaryRange'];
                                $date = $row['date'];
                                $jobId = $row['id']
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
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal<?php echo $jobId; ?>">Apply Now</button>
                                            </div>
                                            <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: <?php echo $date; ?></small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Apply Modal -->
                                <div class="modal fade" id="applyModal<?php echo $jobId; ?>" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="applyModalLabel">Apply for <?php echo $position; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                if (isset($_POST['submitApplication'])) {
                                                    // Enable error reporting and display errors
                                                    error_reporting(E_ALL);
                                                    ini_set('display_errors', 1);

                                                    // Retrieve form data

                                                    // Insert application data into the database
                                                    $query = "INSERT INTO applications (user_id, job_id, status) VALUES ($isLoggedIn, $jobId, 'Padding')";

                                                    // Debugging: Display the query
                                                    // echo "Query: $query<br>";

                                                    if (mysqli_query($connection, $query)) {
                                                        echo '<script>alert("Form submitted successfully!");</script>';
                                                    } else {
                                                        $error = mysqli_error($connection);
                                                        echo "<script>alert('Failed to submit form. Error: $error');</script>";
                                                    }
                                                }

                                                ?>

                                                <form method="post">
                                                    <button type="submit" name="submitApplication" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php
                            }
                            ?>


                        </div>



                    </div>

                </div>
            </div>
        </div>
        <!-- Jobs End -->


        <!-- Footer Start -->
<?php include 'Component/Footer.php';?>
        
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>