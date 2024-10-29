<?php
session_start();

// Redirect to home page if user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 300px;
            padding: 20px;
            background: white;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        p {
            color: #555;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-signup {
            background-color: #28a745;
        }
        .btn-signup:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome!</h1>
        <p>Please log in or sign up to continue.</p>
        <a href="login.php" class="btn" role="button" aria-label="Log In">Log In</a>
        <a href="signup.php" class="btn btn-signup" role="button" aria-label="Sign Up">Sign Up</a>
    </div>
</body>
</html>