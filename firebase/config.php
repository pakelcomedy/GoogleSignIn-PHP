<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class FirebaseConfig {
    private $auth;

    public function __construct() {
        // Update jalur ke file JSON service account yang benar
        $serviceAccountPath = __DIR__ . '/kabare-cf940-firebase-adminsdk-8qu0w-017b632945.json';

        // Menginisialisasi Firebase dengan file service account
        $factory = (new Factory)
            ->withServiceAccount($serviceAccountPath);

        // Mendapatkan instance dari Auth
        $this->auth = $factory->createAuth();
    }

    public function getAuth() {
        return $this->auth;
    }
}
