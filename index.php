<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Login</title>
    
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #cce6cc; /* Light green background similar to the image */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #f5f5f5; /* Light grey background for the form */
        padding: 40px; /* Sufficient padding inside the form */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* More prominent shadow for depth */
        width: 400px; /* Width matches the form in the image */
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 10px; /* Reduced space below the heading */
    }

    h3 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    input[type="number"], input[type="password"], select {
        width: 100%; /* Full width for input fields */
        padding: 12px; /* Consistent padding for input fields */
        margin: 8px 0; /* Smaller margin for tighter spacing */
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .btn {
        background-color: #4CAF50; /* Green login button */
        color: white;
        border: none;
        padding: 12px;
        cursor: pointer;
        width: 100%; /* Full width for the button */
        border-radius: 5px;
        font-size: 16px;
    }

    .btn:hover {
        background-color: #45a049; /* Slightly darker green on hover */
    }

    p {
        text-align: center;
        margin-top: 15px;
    }

    a {
        color: #3498db;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    </style>
</head>
<body>
    <div class="container">
        <h1>Online Voting System</h1>
        <div class="login">
            <form action="api/login.php" method="POST">
                <h3>Login</h3>
                <input type="number" name="mobile" placeholder="Enter mobile" autocomplete="off" required>
                <input type="password" name="password" placeholder="Enter password" autocomplete="off" required>
                
                <div class="role">
                    <select name="role" id="dropbox">
                        <option value="1">Voter</option>
                        <option value="2">Group</option>
                        <option value="3">Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn">Login</button>
                <p>New user? <a href="routes/register.php">Register here</a></p>
            </form>
        </div>
    </div>
</body>
</html>
