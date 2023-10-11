$recaptchaSecret = 'YOUR_SECRET_KEY';
$recaptchaResponse = $_POST['g-recaptcha-response'];
$verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';

$data = array(
    'secret' => $recaptchaSecret,
    'response' => $recaptchaResponse
);

$options = array(
    'http' => array (
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($verifyUrl, false, $context);
$responseKeys = json_decode($result, true);

if (intval($responseKeys["success"]) !== 1) {
    // reCAPTCHA verification failed
    // Handle the case where the user is considered a robot
} else {
    // reCAPTCHA verification passed
    // Proceed with your form processing
}
