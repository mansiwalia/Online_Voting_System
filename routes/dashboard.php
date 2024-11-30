<?php
session_start();
include_once("../api/connect.php");

// Check if userdata is set
if (!isset($_SESSION['userdata'])) {
    header("Location: ../index.php"); // Redirect to login if userdata is not set
    exit();
}

$userdata = $_SESSION['userdata'];

// Check for a message in the URL
$message = isset($_GET['message']) ? $_GET['message'] : '';

// Fetch group data from the database
$query = "SELECT * FROM groups";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">

    <style>
        #Profile {
            background-color: white;
            width: 30%;
            padding: 20px;
            margin: 10px;
            float: left;
        }
        #group {
            background-color: white;
            width: 63%;
            padding: 20px;
            margin: 10px;
            float: right;
        }
        #votebtn {
            padding: 5px;
            font-size: 15px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
        }
        @media (max-width: 767px) {
    #Profile, #group {
        width: 100%;
        float: none;
    }

    img {
        width: 100%;
        max-width: 110px;
        margin: 0 auto;
        display: block;
    }

    .btn-back, .btn-logout {
        width: 100%;
        margin-top: 10px;
    }

    #votebtn {
        width: 100%;
    }
}

@media (min-width: 768px) {
    #Profile {
        width: 30%;
        float: left;
    }

    #group {
        width: 65%;
        float: right;
    }

    img {
        float: right;
    }
}

    </style>
    
    <script>
    // Show alert if there's a message
    window.onload = function() {
        <?php if ($message): ?>
            alert("<?php echo $message; ?>");
        <?php endif; ?>
    };
    </script>
</head>
<body>
    <div id="header">
        <a href="../"><button class="btn-back">Back</button></a>
        <h1>Online Voting System</h1>
        <a href="logout.php"><button class="btn-logout">Logout</button></a>
    </div>
    <hr>
    <div id="Profile">
        <!-- Display User Profile -->
        <center><img src="../uploads/<?php echo $userdata['photo']; ?>" height="110" width="110"></center><br>
        <b>Name:</b> <?php echo $userdata['name']; ?> <br><br>
        <b>Mobile:</b> <?php echo $userdata['mobile']; ?> <br><br>
        <b>Address:</b> <?php echo $userdata['address']; ?> <br><br>
        <b>Status:</b> <b style="color: <?php echo $userdata['status'] ? 'green' : 'red'; ?>"><?php echo $userdata['status'] ? 'Voted' : 'Not Voted'; ?></b><br><br>
    </div>
    <div id="group">
    <?php
    if ($result->num_rows > 0) {
        while ($group = $result->fetch_assoc()) {
            $image_path = "../" . $group['photo']; // Path to the group photo

            // Check if the image file exists
            if (file_exists($image_path)) {
                $image_tag = '<img style="float:right" src="' . $image_path . '" height="110" width="110">';
            } else {
                $image_tag = '<span style="float:right;color:red;">Image not found</span>';
            }
            ?>
            <div>
                <?php echo $image_tag; ?>
                <b>Group Name:</b> <?php echo htmlspecialchars($group['name']); ?> <br><br>
                <b>Votes:</b> <?php echo htmlspecialchars($group['votes']); ?> <br><br>

                <form action="../api/vote.php" method="POST" autocomplete="off">
    <input type="hidden" name="gvotes" value="<?php echo $group['votes']; ?>">
    <input type="hidden" name="gid" value="<?php echo $group['id']; ?>">
    <input type="submit" name="votebtn" value="Vote" id="votebtn">
</form>

            </div>
            <hr>
            <?php
        }
    } else {
        echo "No groups available.";
    }
    ?>
    </div>
</body>
</html>
