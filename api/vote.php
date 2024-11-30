<?php
session_start();
include("connect.php"); // Make sure the correct path is used

// Check if userdata is set
if (!isset($_SESSION['userdata'])) {
    header("Location: ../index.php"); // Redirect to login if userdata is not set
    exit();
}

$userdata = $_SESSION['userdata'];

// Check if vote data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gvotes']) && isset($_POST['gid'])) {
    $votes = intval($_POST['gvotes']);
    $gid = intval($_POST['gid']); // Ensure gid is an integer

    // Check if the user has already voted
    if ($userdata['status'] == 0) {
        // Increment votes for the selected group
        $newVotes = $votes + 1;

        // Update votes in the database
        $updateVotesQuery = "UPDATE groups SET votes=? WHERE id=?";
        $stmt = $conn->prepare($updateVotesQuery);
        $stmt->bind_param("ii", $newVotes, $gid); // Bind parameters
        $stmt->execute();

        // Update user status to 'Voted'
        $updateUserStatusQuery = "UPDATE user SET status=1 WHERE id=?";
        $userId = $userdata['id'];
        $stmt = $conn->prepare($updateUserStatusQuery);
        $stmt->bind_param("i", $userId); // Bind user ID
        $stmt->execute();

        // Update session to reflect the new status
        $_SESSION['userdata']['status'] = 1;

        // Redirect back to dashboard with success message
        header("Location: ../routes/dashboard.php?message=Vote Successful");
        exit();
    } else {
        // If the user already voted, redirect with a message
        header("Location: ../routes/dashboard.php?message=You have already voted!");
        exit();

    }
} else {
    // Redirect if vote data is not set
    header("../routes/dashboard.php?message=Invalid request.");
    exit();
}
?>
