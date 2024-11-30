<?php
session_start();
if (!isset($_SESSION['userdata']) || $_SESSION['userdata']['role'] != 'admin'){
    header("admin.php"); 
}

include_once("api\connect.php");


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
            text-align: center;
        }
        .logout-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
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
        .links-container {
            text-align: center;
            margin-top: 20px;
        }
        .links-container a {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            margin: 5px;
            display: inline-block;
        }
        .links-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="logout-container">
    <a href="admin_logout.php" class="btn-logout">Logout</a>
</div>

<div class="container">
    <h2>Add New Group</h2>
    <form action="admin.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <label for="name">Group Name:</label>
        <input type="text" name="name" required>
        
        <label for="photo">Group Photo:</label>
        <input type="file" name="photo" required>

        <label for="votes">Initial Votes:</label>
        <input type="number" name="votes" value="0" required>

        <button type="submit">Add Group</button>
    </form>

    <div class="links-container">
        <a href="view_groups.php">View Groups</a>
        <a href="view_users.php">View Users</a>
    </div>
</div>

</body>
</html>
