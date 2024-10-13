<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));

    // Validate form fields
    if (empty($name) || empty($phone) || empty($email)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        // Prepare the email
        $to = "	support@theadvertisingcompany.com.au"; 
        $subject = "TAC Free Consultation Form Submission";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $email_body = "
        <h2>TAC Free Consultation Form Submission</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        ";

        // Send the email
        if (mail($to, $subject, $email_body, $headers)) {
            // Redirect to the thank-you page upon successful form submission
            header("Location: https://theadvertisingcompany.com.au/thank-you.html");
            exit; // Ensure no further code is executed after the redirect
        } else {
            $error_message = "Failed to send your message. Please try again later.";
        }
    }
}
?>
