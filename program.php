<?php
if(isset($_POST['email'])) {

    $email_to = "nitishtripathi26@gmail.com";
    $email_subject = "Enquiry from Digital Library Website";

    function died($error) {
        echo '<div class="error-message">'.$error.'</div>';
        die();
    }

    // validation
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('Sorry, there seems to be a problem with the form you submitted.');
    }

    $name = $_POST['name'];
    $email_from = $_POST['email'];
    $message = $_POST['message'];

    $error_message = "";
    if(strlen($name) < 2) {
        $error_message .= 'Please enter a valid name.<br />';
    }
    if(!filter_var($email_from, FILTER_VALIDATE_EMAIL)) {
        $error_message .= 'Please enter a valid email address.<br />';
    }
    if(strlen($message) < 10) {
        $error_message .= 'Please enter a message of at least 10 characters.<br />';
    }

    if(strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Enquiry details:\n\n";
    $email_message .= "Name: ".$name."\n";
    $email_message .= "Email: ".$email_from."\n";
    $email_message .= "Message:\n".$message."\n";


    // create email headers
    $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

    // send email
    if(mail($email_to, $email_subject, $email_message, $headers)) {
        echo '<div class="success-message">Thank you for your enquiry. We will get back to you shortly.</div>';
    } else {
        echo '<div class="error-message">Sorry, there was an error sending your message. Please try again later.</div>';
    }

}
?>
