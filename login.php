<?php
session_start();
require 'firebase/config.php';

$firebase = new FirebaseConfig();
$auth = $firebase->getAuth();
$error = ""; // Inisialisasi variabel error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $user = $auth->verifyPassword($email, $password);
        $_SESSION['user_id'] = $user->uid;
        header('Location: home.php');
        exit();
    } catch (Exception $e) {
        $error = "Login failed: " . $e->getMessage();
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
    <script src="https://www.gstatic.com/firebasejs/9.x.x/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.x.x/firebase-auth.js"></script>
    <script>
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyBdDOQx-Yfl9ydoB5FIWEyn4DJrEwWjp5k",
            authDomain: "kabare-cf940.firebaseapp.com",
            projectId: "kabare-cf940",
            storageBucket: "kabare-cf940.appspot.com",
            messagingSenderId: "675057825306",
            appId: "1:675057825306:web:ebe75a0745d0971fbc43a3",
            measurementId: "G-NVK1DR5YMN" // Optional, if you are using Analytics
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        // Function to handle Google Sign-In
        function signInWithGoogle() {
            const provider = new firebase.auth.GoogleAuthProvider();
            firebase.auth().signInWithPopup(provider)
                .then((result) => {
                    // Get the user's ID token
                    result.user.getIdToken().then(token => {
                        // Send the token to your server for verification
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
    </script>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <!-- Pesan Error -->
        <?php if (!empty($error)) { echo "<div class='error'>$error</div>"; } ?>

        <!-- Form Login -->
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>

        <button class="google-signin" onclick="signInWithGoogle()">Sign in with Google</button>

        <a href="signup.php" class="signup-link">Don't have an account? Sign up here</a>
    </div>
</body>
</html>