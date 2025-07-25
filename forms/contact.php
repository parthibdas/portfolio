<?php
// Simple contact form handler (no external PHP libraries needed)

// Recipient email
$to = 'pdash0064@gmail.com';

// Validate required fields
if (
  empty($_POST['name']) ||
  empty($_POST['email']) ||
  empty($_POST['subject']) ||
  empty($_POST['message']) ||
  !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
  http_response_code(400);
  echo "Please fill all fields correctly.";
  exit;
}

// Collect and sanitize input
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$subject = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);

// Build the email content
$body = "You have received a new message from your portfolio contact form.\n\n";
$body .= "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Subject: $subject\n\n";
$body .= "Message:\n$message";

// Set headers
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send the email
if (mail($to, $subject, $body, $headers)) {
  echo "OK";
} else {
  http_response_code(500);
  echo "Failed to send email.";
}
?>
