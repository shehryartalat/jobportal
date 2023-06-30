<?php
 include 'Database/connection.php';

    if (isset($_GET['id'])) {
        $jobId = $_GET['id'];
        
        // Perform deletion query
        $deleteQuery = "DELETE FROM jobs WHERE id = '$jobId'";
        $deleteResult = mysqli_query($connection, $deleteQuery);
        
        if ($deleteResult) {
            // Deletion successful, redirect back to profile page
            header("Location: profile.php");
            exit();
        } else {
            // Deletion failed
            echo "Failed to delete job post.";
        }
    } else {
        // Invalid request, redirect back to profile page
        header("Location: profile.php");
        exit();
    }
?>
