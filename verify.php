<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $recaptchaSecret = "YOUR_SECRET_KEY"; // Replace with your actual secret key from Google
    $recaptchaResponse = $_POST["g-recaptcha-response"];

    // Validate if reCAPTCHA was completed
    if (!$recaptchaResponse) {
        echo "Wrong: Please complete the CAPTCHA.";
        exit;
    }

    // Send verification request to Google
    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($verifyUrl . "?secret=" . $recaptchaSecret . "&response=" . $recaptchaResponse);
    $responseKeys = json_decode($response, true);

    // Check if verification was successful
    if ($responseKeys["success"]) {
        echo "Correct: CAPTCHA verified successfully!";
    } else {
        echo "Wrong: CAPTCHA verification failed.";
    }
}
?>
