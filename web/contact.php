<?php
$to = "jhpaulin@gmail.com";
$subject = "PennApps XII Contact";

if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message'])) {
    echo 'Please fill out all fields';
    die();
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$headers = 'From: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo "Thank you for contacting me. Will be in touch with you very soon.";
} else {
    echo "Message failed!";
}
?>
<meta http-equiv="refresh" content="3; url=/" />
