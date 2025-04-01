<?php
ob_start(); // Start output buffering

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include SwiftMailer autoload file
require 'swiftmailer/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Details of Complainant
    $data = '<table border="1" bordercolor="#ccc" align="center" width="650" style="width:650px;" cellpadding="10" cellspacing="0">';
    $data .= '<tr><td colspan="2" align="center" style="font-size:15px; font-weight:600;">Enquiry Details :-</td></tr>';
    $data .= '<tr><td>Name </td><td>' . htmlspecialchars($_POST['name']) . '</td></tr>';
    $data .= '<tr><td>Email </td><td>' . htmlspecialchars($_POST['email']) . '</td></tr>';
    $data .= '<tr><td>Phone No </td><td>' . htmlspecialchars($_POST['phone']) . '</td></tr>';
    $data .= '<tr><td>Phone No </td><td>' . htmlspecialchars($_POST['subject']) . '</td></tr>';
    $data .= '<tr><td>Phone No </td><td>' . htmlspecialchars($_POST['message']) . '</td></tr>';
    $data .= '</table>';

    
    // Create the Transport
    $transport = (new Swift_SmtpTransport('mail.adjewelleries.com', 587))
        ->setUsername('no-reply@adjewelleries.com')
        ->setPassword('H$B_7H$(*+d)');

    // Create the Mailer using the created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message('Contact Form Query'))
        ->setFrom(['no-reply@adjewelleries.com' => 'Contact Form Query'])
        ->setTo(['suraj.itarsia@gmail.com' => 'Contact Form Query'])
        ->setBody($data, 'text/html');

    // Send the message
    try {
        $result = $mailer->send($message);

        // Check if email sent successfully
        if ($result) {
            header('Location: success.php');
            exit; // Ensure script stops executing after redirection
        } else {
            header('Location: failed.php');
            exit; // Ensure script stops executing after redirection
        }
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ' . $e->getMessage();
        header('Location: failed.php');
        exit; // Ensure script stops executing after redirection
    }
} else {
    exit('Invalid Request!');
}

ob_end_flush(); // Flush output buffer and send it to the browser
?>
