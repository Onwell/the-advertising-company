<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

    // Check if the required fields are filled
    if (!$name || !$email || !$phone) {
        echo "All fields are required. Please fill in all fields correctly.";
        exit;
    }

    // Set email details
    $to = 'o.masaraure@gmail.com'; // Replace with your email address
    $subject = 'New Free Consultation Request';
    $message = "You have received a new consultation request.\n\n" .
               "Name: $name\n" .
               "Email: $email\n" .
               "Phone Number: $phone\n";

    // Set email headers
    $headers = "From: noreply@example.com\r\n" . // Replace with your domain email
               "Reply-To: $email\r\n" .
               "Content-Type: text/plain; charset=utf-8\r\n";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "Thank you for your request. We will get back to you soon.";
    } else {
        echo "Sorry, there was an error sending your request. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
?>
