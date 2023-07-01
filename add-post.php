<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobEntry - Job Portal</title>
    <link href="css/style.css" rel="stylesheet">
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
    <?php
    include 'Database/connection.php';
    include 'Component/Navbar.php';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $position = $_POST['position'];
        $salaryRange = $_POST['salaryRange'];
        $jobType = $_POST['jobType'];
        $address = $_POST['address'];
        $validTill = $_POST['validTill'];

        // Perform database insertion
        $insertQuery = "INSERT INTO job (position, salaryRange, type, address, date) VALUES ('$position', '$salaryRange', '$jobType', '$address', '$validTill')";
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
    
    <?php
    include 'Component/Footer.php'
    ?>
</body>

</html>
