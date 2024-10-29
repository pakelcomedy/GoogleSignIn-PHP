<?php
session_start(); // Start the session at the beginning of the script
require 'firebase/config.php';

$firebase = new FirebaseConfig();
$auth = $firebase->getAuth();

// Get the JSON input from the request
$input = json_decode(file_get_contents('php://input'), true);
$token = $input['token'] ?? '';

try {
    // Verify the ID token received from the client
    $verifiedIdToken = $auth->verifyIdToken($token);
    
    // Store the user ID in the session
    $_SESSION['user_id'] = $verifiedIdToken->getClaim('sub');
    
    // Optionally, store other claims if needed
    $_SESSION['email'] = $verifiedIdToken->getClaim('email'); // Store email if necessary

    // Return a success response
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Log the error message (optional, for debugging)
    error_log('Token verification failed: ' . $e->getMessage());
    
    // Return a failure response
    echo json_encode(['success' => false, 'message' => 'Token verification failed.']);
}
?>
