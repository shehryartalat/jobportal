
<?php
include 'Database/connection.php';

if (isset($_GET['id'])) {
    $jobId = $_GET['id'];

    // Check if there are any related rows in the applications table
    $checkQuery = "SELECT COUNT(*) AS count FROM applications WHERE job_id = ?";
    $stmt = mysqli_prepare($connection, $checkQuery);
    mysqli_stmt_bind_param($stmt, "i", $jobId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $applicationCount = $row['count'];

    if ($applicationCount > 0) {
        // There are related rows in the applications table, handle it as you prefer
        echo "Cannot delete job post because there are applications related to it.";
    } else {
        // No related rows in the applications table, proceed with the deletion
        $deleteQuery = "DELETE FROM jobs WHERE id = ?";
        $stmt = mysqli_prepare($connection, $deleteQuery);
        mysqli_stmt_bind_param($stmt, "i", $jobId);

        if (mysqli_stmt_execute($stmt)) {
            // Deletion successful, redirect back to profile page
            header("Location: profile.php");
            exit();
        } else {
            // Deletion failed
            echo "Failed to delete job post.";
        }
    }

    mysqli_stmt_close($stmt);
} else {
    // Invalid request, redirect back to profile page
    header("Location: profile.php");
    exit();
}
?>

