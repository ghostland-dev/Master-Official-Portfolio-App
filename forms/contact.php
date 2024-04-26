<?php


// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'contact@example.com';

// Check if the PHP Email Form library exists
$php_email_form_path = '../assets/vendor/php-email-form/contact.php';
if (file_exists($php_email_form_path)) {
  require_once($php_email_form_path);
} else {
  die('Unable to load the "PHP Email Form" Library!');
}

// Create a new instance of PHP_Email_Form
$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'] ?? ''; // Make sure to handle cases where these values might not be set
$contact->from_email = $_POST['email'] ?? '';
$contact->subject = $_POST['subject'] ?? '';

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
/*
$contact->smtp = array(
    'host' => 'smtp.example.com',
    'username' => 'your_smtp_username',
    'password' => 'your_smtp_password',
    'port' => '587'
);
*/

$contact->add_message($_POST['name'] ?? '', 'From');
$contact->add_message($_POST['email'] ?? '', 'Email');
$contact->add_message($_POST['message'] ?? '', 'Message', 10);

// Send the email and echo the result
echo $contact->send();
