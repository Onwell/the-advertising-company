<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);

    // Set the recipient email address
    $to = 'support@theadvertisingcompany.com';  // Replace with your email address

    // Set the email subject
    $subject = 'New Contact Form Submission';

    // Construct the email body
    $body = "Email: $email\nPhone: $phone\nSubject: $subject";

    // Set the email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for contacting us. We will get back to you shortly.";
    } else {
        echo "Thank you for contacting us. We will get back to you shortly.";
    }
} else {
    echo "Invalid request.";
}
?>
