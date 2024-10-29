<?php
session_start();
require 'firebase/config.php';

$firebase = new FirebaseConfig();
$auth = $firebase->getAuth();

$error = ''; // Initialize an error variable to capture error messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Create a new user with email and password
        $user = $auth->createUserWithEmailAndPassword($email, $password);
        $_SESSION['user_id'] = $user->uid;
        header('Location: home.php'); // Redirect to home page
        exit();
    } catch (Exception $e) {
        $error = "Sign-up failed: " . $e->getMessage(); // Capture error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
        .signup-container {
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
        .login-link {
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
            width: 100%;
        }
    </style>
    <script src="https://www.gstatic.com/firebasejs/9.x.x/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.x.x/firebase-auth.js"></script>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <?php if (!empty($error)) { echo "<div class='error'>$error</div>"; } ?>

        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Sign Up</button>
        </form>

        <br>
        <a href="login.php" class="login-link">Already have an account? Login here</a>

        <button id="googleSignInBtn" class="google-signin">Sign in with Google</button>

        <script>
            // Your Firebase configuration
            const firebaseConfig = {
                apiKey: "AIzaSyBdDOQx-Yfl9ydoB5FIWEyn4DJrEwWjp5k",
                authDomain: "kabare-cf940.firebaseapp.com",
                projectId: "kabare-cf940",
                storageBucket: "kabare-cf940.appspot.com",
                messagingSenderId: "675057825306",
                appId: "1:675057825306:web:ebe75a0745d0971fbc43a3",
                measurementId: "G-NVK1DR5YMN" // Optional, for Analytics
            };

            // Initialize Firebase
            const app = firebase.initializeApp(firebaseConfig);
            const auth = firebase.auth(); // Initialize Firebase Authentication

            // Function for Google Sign-In
            function signInWithGoogle() {
                const provider = new firebase.auth.GoogleAuthProvider();
                auth.signInWithPopup(provider)
                    .then((result) => {
                        // Get the user's ID token and send it to the server
                        result.user.getIdToken().then(token => {
                            fetch('verify_token.php', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ token })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.location.href = 'home.php'; // Redirect to home on success
                                } else {
                                    console.error('Token verification failed:', data.message);
                                }
                            });
                        });
                    })
                    .catch((error) => {
                        console.error('Google Sign-In error:', error.message);
                    });
            }

            // Event listener for Google Sign-In button
            document.getElementById('googleSignInBtn').addEventListener('click', signInWithGoogle);
        </script>
    </div>
</body>
</html>