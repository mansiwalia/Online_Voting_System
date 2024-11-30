<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "voting";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn)
die(mysqli_connect_error());


session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['userdata']) || $_SESSION['userdata']['role'] != 'admin'){
    header("admin.php");  
}





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $votes = intval($_POST['votes']);

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO groups (name, photo, votes) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $target_file, $votes);
    $stmt->execute();
    $stmt->close();

    echo '<script>alert("Data inserted Successfully.");</script>';
}

// Handle delete request
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $groupId = intval($_GET['id']);
    $deleteStmt = $conn->prepare("DELETE FROM groups WHERE id = ?");
    $deleteStmt->bind_param("i", $groupId);
    $deleteStmt->execute();
    $deleteStmt->close();
}


// Fetch all groups from the database
$query = "SELECT * FROM groups";
$result = $conn->query($query);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Add Group</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        .logout-container {
    position: absolute;
    top: 20px;
    right: 50px;
    background-color: transparent; /* Ensure background is transparent */
    padding: 0; /* Remove any padding */
    margin: 0; /* Remove any margin */
}
        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="file"],
        input[type="number"],
        button {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="logout-container">
    <a href="admin_logout.php" class="btn-logout">Logout</a>
</div>

    <h2>Add New Group</h2>
    <form action="admin.php" method="POST" enctype="multipart/form-data">
        <label for="name">Group Name:</label>
        <input type="text" name="name" required>
        
        <label for="photo">Group Photo:</label>
        <input type="file" name="photo" required>

        <label for="votes">Initial Votes:</label>
        <input type="number" name="votes" value="0" required>

        <button type="submit">Add Group</button>
    </form>

    <h2>Existing Groups</h2>
    <table>
        <thead>
            <tr>
                <th>Group Name</th>
                <th>Group Photo</th>
                <th>Votes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($group = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($group['name']) . '</td>';
                    echo '<td><img src="' . htmlspecialchars($group['photo']) . '" height="50" width="50"></td>';
                    echo '<td>' . htmlspecialchars($group['votes']) . '</td>';
                    echo '<td>
                            <a href="update_group.php?id=' . $group['id'] . '"><i class="fas fa-edit"></i> Update</a> 
                            <a href="admin.php?action=delete&id=' . $group['id'] . '" onclick="return confirm(\'Are you sure you want to delete this group?\');"><i class="fas fa-trash"></i> Delete</a>
                          </td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="4">No groups available.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>