<?php
if (isset($_POST['submit'])) {
    // Get the form fields and remove whitespace
    $name = strip_tags(trim($_POST['bb-name']));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST['bb-email']), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST['bb-phone']);
    $time = trim($_POST['bb-time']);
    $branch = trim($_POST['bb-branch']);
    $date = trim($_POST['bb-date']);
    $number = trim($_POST['bb-number']);
    $message = trim($_POST['bb-message']);

    // Check if name, email and message are provided
    if (empty($name) || empty($email) || empty($message)) {
        http_response_code(400);
        echo 'Please fill in all the required fields and try again.';
        exit;
    }

    // Set the recipient email address
    $to = 'anzarshah43@gmail.com';

    // Set the email subject
    $subject = 'New booking request from ' . $name;

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Time: $time\n";
    $email_content .= "Branch: $branch\n";
    $email_content .= "Date: $date\n";
    $email_content .= "Number of People: $number\n";
    $email_content .= "Message: $message\n";

    // Build the email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo 'Thank you! Your booking request has been submitted.';
    } else {
        http_response_code(500);
        echo 'Oops! Something went wrong and we couldn\'t submit your request. Please try again later.';
    }
} else {
    http_response_code(400);
    echo 'Please submit the form and try again.';
}
?>
