<?php
// Enable error reporting for troubleshooting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering to prevent any unexpected output
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate form fields
    if (empty($name) || empty($phone) || empty($email) || empty($message)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        // Prepare the email
        $to = "support@theadvertisingcompany.com.au";
        $subject = "TAC New Contact Form Submission";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $email_body = "
        <h2>TAC New Contact Form Submission</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Message:</strong> {$message}</p>
        ";

        // Send the email
        if (mail($to, $subject, $email_body, $headers)) {
            // Redirect to the thank-you page upon successful form submission
            header("Location: https://theadvertisingcompany.com.au/thank-you.html");
            ob_end_flush(); // End output buffering here
            exit(); // Ensure no further code is executed after the redirect
        } else {
            $error_message = "Failed to send your message. Please try again later.";
        }
    }
}

// Flush and send output buffer
ob_end_flush();
?>
