<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9FD69A; /* Light green background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color:  #f5f5f5;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 450px; /* Fixed width for the container */
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
        }

        h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .row input {
            width: 48%; /* Adjust width of each input field in the row */
        }

        input[type="text"], input[type="password"], input[type="number"], input[type="file"], input[type="email"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn {
            background-color: #5CBA47;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size:15px;
            width: 100%;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #489E36;
        }

        label {
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Online Voting System</h1>
        <div class="register">
            <form action="../api/registration.php" method="post" enctype="multipart/form-data">
                <h3>Registration</h3>
                
                <!-- Row for Name and Mobile -->
                <div class="row">
                    <input type="text" name="name" placeholder="Name" autocomplete="off" required>
                    <input type="number" name="mobile" placeholder="Mobile" autocomplete="off" required>
                </div>

                <!-- Row for Password and Confirm Password -->
                <div class="row">
                    <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                    <input type="password" name="cpassword" placeholder="Confirm Password" autocomplete="off" required>
                </div>

                <!-- Address Field -->
                <input type="text" name="address" placeholder="Address" autocomplete="off" required>

                <!-- Upload Image -->
                <label for="image">Upload image:</label>
                <input type="file" name="image" id="image" autocomplete="off" required>

                <!-- Role Selection -->
                <label for="role">Select your role:</label>
                <select name="role" id="role">
                    <option value="1">Voter</option>
                    <option value="2">Group</option>
                </select>

                <!-- Register Button -->
                <button type="submit" class="btn">Register</button>
                
                <!-- Link to Login -->
                <p>Already a user? <a href="../index.php">Login here</a></p>

            </form>
        </div>
    </div>
</body>
</html>
