<?php
session_start();

include_once("connect.php"); // Make sure the path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Prepare and execute the query to authenticate the user
    $query = "SELECT * FROM user WHERE mobile = ? AND role = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Use 'i' for mobile (bigint) and 'i' for role (int)
    $stmt->bind_param("ii", $mobile, $role); 
    if ($stmt->execute() === false) {
        die("Error executing query: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch user data
        $userdata = $result->fetch_assoc();

        // Check password
        if ($userdata['password'] === $password) { // Check plain text password
            $_SESSION['userdata'] = $userdata;

            // Redirect based on role
            if ($userdata['role'] == 3) { // Assuming admin is role 3
                header("Location: ../admin.php");
            } else {
                header("Location: ../routes/dashboard.php");
            }
            exit();
        } else {
            echo '<script>alert("Invalid password.");</script>';
        }
    } else {
        echo "<script>alert('User Not Found!');  window.location.href = '../index.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
