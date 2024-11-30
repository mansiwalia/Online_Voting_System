<?php

include_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['address'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $role = $_POST['role'];

    // Check if the mobile number already exists
    $checkMobileQuery = "SELECT * FROM user WHERE mobile = ?";
    $stmt = $conn->prepare($checkMobileQuery);
    if ($stmt) {
        $stmt->bind_param("s", $mobile);
        $stmt->execute();
        $mobileResult = $stmt->get_result();

        if ($mobileResult->num_rows > 0) {
            echo '<script>
                alert("User Already Exists");
                window.location = "../routes/register.php";
                </script>';
        } else {
            // Check if passwords match
            if ($password == $cpassword) {
                move_uploaded_file($tmp_name, "../uploads/$image");

                // Insert the new user into the database
                $insertQuery = "INSERT INTO user (name, mobile, address, password, photo, role, status, votes) VALUES (?, ?, ?, ?, ?, ?, '0', '0')";
                $stmt = $conn->prepare($insertQuery);
                if ($stmt) {
                    $stmt->bind_param("ssssss", $name, $mobile, $address, $password, $image, $role);
                    $insert = $stmt->execute();

                    if ($insert) {
                        echo '<script>
                        alert("Registration Successful");
                        window.location = "../index.php";
                        </script>';
                    } else {
                        echo '<script>
                        alert("Some error occurred");
                        window.location = "../routes/register.php";
                        </script>';
                    }
                } else {
                    echo '<script>
                    alert("Database error: Could not prepare statement");
                    window.location = "../routes/register.php";
                    </script>';
                }
            } else {
                echo '<script>
                alert("Password & Confirm password do not match");
                window.location = "../routes/register.php";
                </script>';
            }
        }

        $stmt->close();
    } else {
        echo '<script>
        alert("Database error: Could not prepare statement");
        window.location = "../routes/register.php";
        </script>';
    }
}

$conn->close();
?>
