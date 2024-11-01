<?php
session_start();
$error = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']); // Clear the message after displaying it

require 'firebase/config.php';

$firebase = new FirebaseConfig();
$auth = $firebase->getAuth();
$error = ""; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan data POST memiliki `email` dan `password`
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            // Authenticate user with email and password
            $user = $auth->getUserByEmail($email); // Check if the user exists
            $signInResult = $auth->verifyPassword($email, $password);
            $_SESSION['user_id'] = $signInResult->uid; // Store user ID in session
            header('Location: home.php');
            exit();
        } catch (Exception $e) {
            $error = "Login failed: " . $e->getMessage();
        }
    } else {
        $error = "Please enter both email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Your existing CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            width: 300px;
            padding: 20px;
            background: white;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: #D8000C;
            background-color: #FFD2D2;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #D8000C;
            border-radius: 4px;
        }
        .signup-link {
            display: block;
            margin-top: 15px;
            color: #0066cc;
            text-decoration: none;
        }
        .google-signin {
            background-color: #4285F4;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
    <script type="module">
        // Import Firebase modules
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.0/firebase-app.js";
        import { getAuth, GoogleAuthProvider, signInWithPopup } from "https://www.gstatic.com/firebasejs/9.22.0/firebase-auth.js";

        // Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBdDOQx-Yfl9ydoB5FIWEyn4DJrEwWjp5k",
            authDomain: "kabare-cf940.firebaseapp.com",
            projectId: "kabare-cf940",
            storageBucket: "kabare-cf940.appspot.com",
            messagingSenderId: "675057825306",
            appId: "1:675057825306:web:ebe75a0745d0971fbc43a3",
            measurementId: "G-NVK1DR5YMN"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

        // Function to handle Google Sign-In
        window.signInWithGoogle = function() {
            console.log("Attempting to sign in with Google...");
            const provider = new GoogleAuthProvider();

            signInWithPopup(auth, provider)
                .then((result) => {
                    return result.user.getIdToken(); // Get the ID token
                })
                .then((token) => {
                    console.log("ID Token:", token); // Log the token to check its value

                    // Display the ID token on the page
                    document.getElementById("id-token-display").innerText = token;

                    // Optionally, send token to the server
                    return fetch('verify_token.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ token }) // Make sure token is sent here
                    });
                })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Server responded with an error: ' + response.status);
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.success) {
                        window.location.href = 'home.php'; // Redirect to index on success
                    } else {
                        console.error('Token verification failed:', data.message);
                        alert('Token verification failed. Please try again.');
                    }
                })
                .catch((error) => {
                    console.error('Google Sign-In error:', error);
                    alert('An error occurred during Google Sign-In. Please try again: ' + error.message);
                });
        };
    </script>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <!-- Error Message -->
        <?php if (!empty($error)) { echo "<div class='error'>$error</div>"; } ?>

        <!-- Login Form -->
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form> 

        <button class="google-signin" onclick="signInWithGoogle()">Sign in with Google</button>

        <!-- Display the ID token here -->
        <div id="id-token-display" style="margin-top: 20px; color: green;"></div>

        <a href="signup.php" class="signup-link">Don't have an account? Sign up here</a>
    </div>
</body>
</html>
